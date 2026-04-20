<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\DonasiController;

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
        Route::post('/logout', [AuthController::class,'logout' ])->name('logout');
    });


});

// NAVBAR ADMIN

// Kampanye
Route::get('/admin/kampanye', function () {
    return view('admin.kampanye'); 
})->name('views.admin.kampanye');

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

// Dokumentasi
Route::get('/admin/dokumentasi', function () {
    return view('admin.dokumentasi');
})->name('views.admin.dokumentasi');