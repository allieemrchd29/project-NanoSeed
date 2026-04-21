<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\FotoDokumentasi;
use App\Models\Kampanye;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::with('kampanye', 'fotos')->latest()->paginate(10);
        return view('admin.dokumentasi.index', compact('dokumentasi'));
    }

    public function create()
    {
        $kampanye = Kampanye::all();
        return view('admin.dokumentasi.create', compact('kampanye'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kampanye'         => 'required|exists:kampanye,id',
            'keterangan'          => 'nullable|string|max:255',
            'tanggal_dokumentasi' => 'required|date',
            'fotos.*'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dokumentasi = Dokumentasi::create([
            'id_kampanye'         => $request->id_kampanye,
            'keterangan'          => $request->keterangan,
            'tanggal_dokumentasi' => $request->tanggal_dokumentasi,
        ]);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('dokumentasi', 'public');
                FotoDokumentasi::create([
                    'id_dokumentasi' => $dokumentasi->id_dokumentasi,
                    'foto'           => $path,
                ]);
            }
        }
        // dd($request->allFiles());

        return redirect()->route('admin.dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function edit(Dokumentasi $dokumentasi)
    {
        $kampanye = Kampanye::all();
        $dokumentasi->load('fotos');
        return view('admin.dokumentasi.edit', compact('dokumentasi', 'kampanye'));
    }

    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        $request->validate([
            'id_kampanye'         => 'required|exists:kampanye,id',
            'keterangan'          => 'nullable|string|max:255',
            'tanggal_dokumentasi' => 'required|date',
            'fotos.*'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dokumentasi->update([
            'id_kampanye'         => $request->id_kampanye,
            'keterangan'          => $request->keterangan,
            'tanggal_dokumentasi' => $request->tanggal_dokumentasi,
        ]);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('dokumentasi', 'public');
                FotoDokumentasi::create([
                    'id_dokumentasi' => $dokumentasi->id_dokumentasi,
                    'foto'           => $path,
                ]);
            }
        }

        return redirect()->route('admin.dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil diperbarui!');
    }

    public function destroy(Dokumentasi $dokumentasi)
    {
        // Hapus semua foto
        foreach ($dokumentasi->fotos as $foto) {
            Storage::disk('public')->delete($foto->foto);
        }

        $dokumentasi->delete();

        return redirect()->route('admin.dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil dihapus!');
    }

    // Hapus satu foto saja
    public function destroyFoto(FotoDokumentasi $foto)
    {
        Storage::disk('public')->delete($foto->foto);
        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }
}