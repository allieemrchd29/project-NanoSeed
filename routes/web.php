<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\KampanyeController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\SearchController;

//redirect ke halaman login
Route::get('/', function () {
    return redirect()->route('admin.login');
});

//Route admin
Route::prefix('admin')->name('admin.')->group(function (){
    //kalo guest (belum login)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    //protected(haruslogin)
    Route::middleware('admin.auth')->group(function(){
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/search', [SearchController::class, 'index'])->name('search');
        Route::post('/logout', [AuthController::class,'logout' ])->name('logout');

        //update profil
        Route::get('profil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profil', [ProfileController::class, 'update'])->name('profile.update');
      
        Route::resource('kampanye', KampanyeController::class)->except(['show']);
        Route::resource('dokumentasi', DokumentasiController::class)->except(['show']);
        Route::delete('dokumentasi-foto/{foto}', [DokumentasiController::class, 'destroyFoto'])->name('dokumentasi.foto.destroy');
    });

});

// NAVBAR ADMIN


// Donasi
// tabel rekapitulasi (Data dari Database)
Route::get('/admin/donasi', [DonasiController::class, 'index'])->name('views.admin.donasi');
// Menghapus data donatur
Route::delete('/admin/donasi/{id}', [DonasiController::class, 'destroy'])->name('admin.donasi.destroy');
// Menyimpan data (Akan digunakan oleh form donatur nanti)
Route::post('/admin/donasi', [DonasiController::class, 'store'])->name('admin.donasi.store');

// Dampak
Route::get('/admin/dampak', function () {
    return view('admin.dampak');
})->name('views.admin.dampak');
