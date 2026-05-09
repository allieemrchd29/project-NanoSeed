<?php

namespace App\Http\Controllers;

use App\Models\Kampanye;
use App\Models\Dokumentasi;
use App\Models\Dampak;
use Illuminate\Http\Request;

class DonaturController extends Controller
{
    public function index(Request $request)
{
    $keyword = trim($request->input('keyword'));
    $query = \App\Models\Kampanye::where('status_kampanye', 'aktif')->latest();

    if ($keyword) {
        $query->where(function($q) use ($keyword) {
            $q->where('nama_kampanye', 'LIKE', "%{$keyword}%")
              ->orWhere('deskripsi', 'LIKE', "%{$keyword}%");
        });

        // ← TAMBAHAN: query dampak & dokumentasi saat search
        $dampak = Dampak::where('judul', 'LIKE', "%{$keyword}%")
                        ->orWhere('deskripsi', 'LIKE', "%{$keyword}%")
                        ->get();

        $dokumentasi = Dokumentasi::with('fotos', 'kampanye')
                        ->where('keterangan', 'LIKE', "%{$keyword}%")
                        ->get();
    } else {
        // kalau ga ada keyword, kosongkan aja
        $dampak = collect();
        $dokumentasi = collect();
    }

    $kampanye = $query->paginate(9);
    $kampanye->appends(['keyword' => $keyword]);

    // dokumentasi & dampaks untuk dashboard normal (take 3 & take 2)
    $dokumentasiDashboard = \App\Models\Dokumentasi::with('fotos')->latest()->take(3)->get();
    $dampaks = Dampak::latest()->take(2)->get();

    return view('donatur.dashboard', compact(
        'kampanye', 
        'dokumentasi',      // hasil search dokumentasi
        'dampak',           // hasil search dampak
        'dokumentasiDashboard', // untuk section dokumentasi dashboard normal
        'dampaks'           // untuk section dampak dashboard normal
    ));
}
    
    public function kampanye()
    {
        $kampanye = Kampanye::where('status_kampanye', 'aktif')->latest()->get();
        return view('donatur.kampanye', compact('kampanye'));
    }

    public function detail($id)
    {
        $kampanye = Kampanye::findOrFail($id);
        return view('donatur.kampanye-detail', compact('kampanye'));
    }

    public function dokumentasi()
    {
        $dokumentasi = Dokumentasi::with('fotos', 'kampanye')->latest()->get();
        return view('donatur.dokumentasi', compact('dokumentasi'));
    }

    public function detailDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::with('fotos', 'kampanye')->findOrFail($id);
        return view('donatur.dokumentasi-detail', compact('dokumentasi'));
    }
}