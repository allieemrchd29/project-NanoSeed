<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile'); 
    }

    public function update(Request $request)
    {
        $admin = auth('admin')->user();
        $request->validate([
            'name'     => 'required|string|max:255',
            'profile'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'password' => 'nullable|min:8|confirmed', 
        ]);

        //ganti usn
        $admin->name = $request->name;

        //update foto
        if ($request->hasFile('profile')) {
            // Kalau sebelumnya udah punya foto, foto lama bakal kehapus
            if ($admin->profile) {
                Storage::disk('public')->delete($admin->profile);            }
            // Simpan foto baru ke folder 'profil' 
            $path = $request->file('profile')->store('profiles', 'public');
            $admin->profile = $path; 
        }

        // ganti pw
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
    public function logout(Request $request)
    {
        auth('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}