<?php

namespace App\Http\Controllers\Admin;
use App\Models\Dampak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DampakController extends Controller
{
    public function index()
    {
        $dampaks = Dampak::latest()->get();
        return view('admin.dampak.index', compact('dampaks'));
    }

    public function create()
    {
        return view('admin.dampak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'icon'      => 'required|string|max:100',
            'deskripsi' => 'required|string',
        ]);

        Dampak::create($request->only('judul', 'icon', 'deskripsi'));

        return redirect()->route('admin.dampak.index')
                         ->with('success', 'Dampak berhasil ditambahkan.');
    }

    public function edit(Dampak $dampak)
    {
        return view('admin.dampak.edit', compact('dampak'));
    }

    public function update(Request $request, Dampak $dampak)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'icon'      => 'required|string|max:100',
            'deskripsi' => 'required|string',
        ]);

        $dampak->update([
        'judul'     => $request->judul,
        'icon'      => $request->icon,
        'deskripsi' => $request->deskripsi,
    ]);

        return redirect()->route('admin.dampak.index')
                         ->with('success', 'Dampak berhasil diperbarui.');
    }

    public function destroy(Dampak $dampak)
    {
        $dampak->delete();

        return redirect()->route('admin.dampak.index')
                         ->with('success', 'Dampak berhasil dihapus.');
    }
}