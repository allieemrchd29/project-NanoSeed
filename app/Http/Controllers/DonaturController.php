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
        // ini untuk menangkap kata kunci search bar
        $keyword = trim ($request->input('keyword'));
        // ini query awal yang memastikan menampilkan kampanye yang sedang aktif
        $query = \App\Models\Kampanye::where('status_kampanye', 'aktif')->latest();
        // logika search
        if ($keyword) {
        $query->where(function($q) use ($keyword) {
            $q->where('nama_kampanye', 'LIKE', "%{$keyword}%")
              ->orWhere('deskripsi', 'LIKE', "%{$keyword}%");
        });
        }
        $kampanye = $query->paginate(9);
        $kampanye->appends(['keyword' => $keyword]);
        $dokumentasi = \App\Models\Dokumentasi::with('fotos')->latest()->take(3)->get();

         // Ambil 2 data dampak terbaru 
        $dampaks = Dampak::latest()->take(2)->get(); 
        
        return view('donatur.dashboard', compact('kampanye', 'dokumentasi', 'dampaks'));
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