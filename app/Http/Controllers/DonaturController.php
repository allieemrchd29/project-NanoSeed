<?php

namespace App\Http\Controllers;

use App\Models\Kampanye;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;

class DonaturController extends Controller
{
    public function index()
    {
        $kampanye = Kampanye::where('status_kampanye', 'aktif')->latest()->take(3)->get();
        $dokumentasi = Dokumentasi::with('fotos')->latest()->take(3)->get();
        return view('donatur.dashboard', compact('kampanye', 'dokumentasi'));
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