<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\AdminNotification;
use App\Mail\DonationSuccess;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class DonationController extends Controller
{
    // Halaman tabel donasi admin
    public function index()
    {
        $semuaDonasi = Donasi::latest()->get();
        return view('admin.donasi', compact('semuaDonasi'));
    }

    // API untuk auto refresh AJAX 
    public function latest()
    {
        // hanya admin yang bisa akses
        if (!session('admin_logged_in') && !auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $donasi = Donasi::latest()->get();
        return response()->json($donasi);
    }

    // Hapus data donasi
    public function destroy($id)
    {
        Donasi::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data donasi berhasil dihapus.');
    }

    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    // =========================================================
    // 1: Menerima data form donatur lalu buat Snap Token
    // =========================================================
    public function createPayment(Request $request)
    {
        $request->validate([
            'nama_donatur'  => 'required|string|max:255',
            'email_donatur' => 'required|email',
            'nomor_telepon' => 'required|string|max:20',
            'jumlah_donasi' => 'required|integer|min:10000',
        ]);

        $orderId     = 'NANO-' . time() . '-' . rand(100, 999);
        $jumlahPohon = (int) floor($request->jumlah_donasi / 50000); // 1 pohon = Rp50.000

        // Simpan ke tabel donasis dengan status pending
        $donasi = Donasi::create([
            'nama_donatur'  => $request->nama_donatur,
            'email_donatur' => $request->email_donatur,
            'nomor_telepon' => $request->nomor_telepon,
            'jumlah_donasi' => $request->jumlah_donasi,
            'order_id'      => $orderId,
            'status'        => 'pending',
        ]);

        // Parameter untuk Midtrans Snap
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $request->jumlah_donasi,
            ],
            'customer_details' => [
                'first_name' => $request->nama_donatur,
                'email'      => $request->email_donatur,
                'phone'      => $request->nomor_telepon,
            ],
            'item_details' => [[
                'id'       => 'POHON-001',
                'price'    => (int) $request->jumlah_donasi,
                'quantity' => 1,
                'name'     => "Donasi {$jumlahPohon} Pohon - NanoSeed",
            ]],
           'callbacks' => [
                'finish' => url('/donation/payment') . '?order_id=' . $orderId,
            ],
        ];

        // Ambil Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Simpan snap_token ke database
        $donasi->update(['snap_token' => $snapToken]);

        // Simpan ke session untuk dipakai di halaman payment
        session([
            'snap_token'    => $snapToken,
            'order_id'      => $orderId,
            'jumlah_donasi' => $request->jumlah_donasi,
            'jumlah_pohon'  => $jumlahPohon,
            'nama_donatur'  => $request->nama_donatur,
        ]);

        return redirect()->route('donation.payment-page');
    }

    // =========================================================
    // 2: Tampilkan halaman payment (Snap popup di sini)
    // =========================================================
        public function paymentPage(Request $request)
        {
            $orderId           = session('order_id') ?? $request->query('order_id');
            $snapToken         = session('snap_token');
            $transactionStatus = $request->query('transaction_status');
            $statusCode        = $request->query('status_code');

            // Kondisi sukses — dari redirect Midtrans
            if ($orderId && ($transactionStatus === 'capture' || $transactionStatus === 'settlement' || $statusCode === '200')) {
                $donasi = \App\Models\Donasi::where('order_id', $orderId)->first();

                if ($donasi) {
                    $sudahAda = \App\Models\AdminNotification::where('donasi_id', $donasi->id)->exists();
                    
                    if (!$sudahAda) {
                        $donasi->update(['status' => 'success']);
                        
                        \App\Models\AdminNotification::create([
                            'nama_donatur'  => $donasi->nama_donatur,
                            'jumlah_donasi' => $donasi->jumlah_donasi,
                            'donasi_id'     => $donasi->id,
                        ]);

                        // Kirim email
                        \Illuminate\Support\Facades\Mail::to($donasi->email_donatur)
                            ->send(new \App\Mail\DonationSuccess($donasi));
                    }
                }

                return view('donatur.payment-success', compact('donasi'));
            }

        // Tidak ada session & tidak ada query string → redirect balik
        if (!$snapToken && !$orderId) {
            return redirect()->route('views.donatur.donasi')
                            ->with('error', 'Sesi habis. Silakan isi form kembali.');
        }

        return view('donatur.payment');
    }

    // =========================================================
    // 3: Webhook dari Midtrans (otomatis dipanggil Midtrans)
    // =========================================================
    public function handleNotification(Request $request)
    {
        $notif       = new Notification();
        $orderId     = $notif->order_id;
        $statusCode  = $notif->status_code;
        $grossAmount = $notif->gross_amount;

        // Validasi signature key — memastikan request benar dari Midtrans
        $signatureKey = hash(
            'sha512',
            $orderId . $statusCode . $grossAmount . config('midtrans.server_key')
        );

        if ($signatureKey !== $notif->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $donasi            = Donasi::where('order_id', $orderId)->firstOrFail();
        $transactionStatus = $notif->transaction_status;
        $fraudStatus       = $notif->fraud_status ?? null;

        // Tentukan status baru
        if ($transactionStatus === 'capture') {
            $newStatus = ($fraudStatus === 'accept') ? 'success' : 'pending';
        } elseif ($transactionStatus === 'settlement') {
            $newStatus = 'success';
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $newStatus = 'failed';
        } else {
            $newStatus = 'pending';
        }

        $donasi->update(['status' => $newStatus]);

        // Jika berhasil => kirim email + buat notifikasi admin
        if ($newStatus === 'success') {
            // Email ke donatur
            Mail::to($donasi->email_donatur)->send(new DonationSuccess($donasi));

            // Notifikasi admin (sistem temanmu)
            AdminNotification::create([
                'nama_donatur'  => $donasi->nama_donatur,
                'jumlah_donasi' => $donasi->jumlah_donasi,
                'donasi_id'     => $donasi->id,
            ]);
        }

        return response()->json(['message' => 'OK']);
    }

    // =========================================================
    // 4: Cek status transaksi (dipanggil dari popup konfirmasi)
    // =========================================================
    public function checkStatus($orderId)
    {
        $donasi = Donasi::where('order_id', $orderId)->firstOrFail();

        return response()->json([
            'status'        => $donasi->status,
            'jumlah_donasi' => $donasi->jumlah_donasi,
            'jumlah_pohon'  => (int) floor($donasi->jumlah_donasi / 50000),
        ]);
    }

    // Export PDF
    public function exportPdf()
    {
        $semuaDonasi = Donasi::latest()->get();
        
        $pdf = Pdf::loadView('admin.donasi-pdf', compact('semuaDonasi'))
                ->setPaper('a4', 'landscape');

        return $pdf->download('transaksi-donasi-' . date('d-m-Y') . '.pdf');
    }
    
}