<?php

namespace App\Http\Controllers;

use App\Models\Kampanye;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KampanyeController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $kampanye = Kampanye::latest()->paginate(10);
        return view('admin.kampanye.index', compact('kampanye'));
    }

    // Form tambah data
    public function create()
    {
        return view('admin.kampanye.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kampanye'   => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'status_kampanye' => 'required|in:aktif,nonaktif,selesai',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'gambar_kampanye' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('gambar_kampanye');

        if ($request->hasFile('gambar_kampanye')) {
            $data['gambar_kampanye'] = $request->file('gambar_kampanye')
                ->store('kampanye', 'public');
        }

        Kampanye::create($data);

        return redirect()->route('admin.kampanye.index')
            ->with('success', 'Kampanye berhasil ditambahkan!');
    }

    // Form edit data
    public function edit(Kampanye $kampanye)
    {
        return view('admin.kampanye.edit', compact('kampanye'));
    }

    // Update data
    public function update(Request $request, Kampanye $kampanye)
    {
        $request->validate([
            'nama_kampanye'   => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'status_kampanye' => 'required|in:aktif,nonaktif,selesai',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'gambar_kampanye' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('gambar_kampanye');

        if ($request->hasFile('gambar_kampanye')) {
            // Hapus gambar lama kalau ada
            if ($kampanye->gambar_kampanye) {
                Storage::disk('public')->delete($kampanye->gambar_kampanye);
            }
            $data['gambar_kampanye'] = $request->file('gambar_kampanye')
                ->store('kampanye', 'public');
        }

        $kampanye->update($data);

        return redirect()->route('admin.kampanye.index')
            ->with('success', 'Kampanye berhasil diperbarui!');
    }

    // Hapus data
    public function destroy(Kampanye $kampanye)
    {
        if ($kampanye->gambar_kampanye) {
            Storage::disk('public')->delete($kampanye->gambar_kampanye);
        }

        $kampanye->delete();

        return redirect()->route('admin.kampanye.index')
            ->with('success', 'Kampanye berhasil dihapus!');
    }
}