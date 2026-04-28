<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kampanye;
use App\Models\Dampak;       
use App\Models\Dokumentasi;  

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $kampanye = Kampanye::where('nama_kampanye', 'LIKE', "%{$query}%")
                        ->orWhere('deskripsi', 'LIKE', "%{$query}%")
                        ->get();

        $dokumentasi = Dokumentasi::where('keterangan', 'LIKE', "%{$query}%")
                        ->orWhereHas('kampanye', function($q) use ($query) {
                            $q->where('nama_kampanye', 'LIKE', "%{$query}%");
                        })
                        ->with('kampanye') // eager load relasi kampanye
                        ->get();

        return view('admin.search', compact('kampanye', 'dokumentasi', 'query'));
    }
}