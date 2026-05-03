<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
// use App\Models\AdminNotification;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index()
    {
        $semuaDonasi = Donasi::latest()->get();
        return view('admin.donasi', compact('semuaDonasi'));
    }

    public function destroy($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->delete();

        return redirect()->back()->with('success', 'Data donasi berhasil dihapus dari sistem.');
    }

    public function store(Request $request)
    {
        // 1. Sesuaikan validasi  (email & numerik)
        $request->validate([
            'nama_donatur'  => 'required|string|max:255',
            'email_donatur' => 'required|email',
            'jumlah_donasi' => 'required|numeric', 
            'nomor_telepon' => 'required|numeric', // Pakai numeric biar cuma angka
        ]);

        // 2. Simpan data ke database
        $donasi = Donasi::create([
            'nama_donatur'  => $request->nama_donatur,
            'email_donatur' => $request->email_donatur,
            'jumlah_donasi' => $request->jumlah_donasi,
            'nomor_telepon' => $request->nomor_telepon,
            'tanggal'       => now(), // Isi kolom tanggal otomatis
        ]);

        // // 3. Notifikasi admin tetep dipertahanin
        // AdminNotification::create([
        //     'nama_donatur'  => $donasi->nama_donatur,
        //     'jumlah_donasi' => $donasi->jumlah_donasi,
        //     'donasi_id'     => $donasi->id,
        // ]);

        // 4. Balik ke halaman formulir donasi
        return redirect()->route('views.donatur.donasi')->with('success', 'Data donasi berhasil ditambahkan.');
    }
}