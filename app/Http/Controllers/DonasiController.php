<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\AdminNotification;
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
        $request->validate([
            'email_donatur' => 'required|email',
            'jumlah_donasi' => 'required|numeric',
            'nomor_telepon' => 'required',
        ]);

        $donasi = Donasi::create([
            'nama_donatur'  => $request->nama_donatur ?? 'Anonim',
            'email_donatur' => $request->email_donatur,
            'jumlah_donasi' => $request->jumlah_donasi,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        //buat notifikasi untuk admin setiap ada donasi baru
        AdminNotification::create([
            'nama_donatur'  => $donasi->nama_donatur,
            'jumlah_donasi' => $donasi->jumlah_donasi,
            'donasi_id'     => $donasi->id,
        ]);

        return redirect()->back()->with('success', 'Data donasi berhasil ditambahkan.');
    }
}