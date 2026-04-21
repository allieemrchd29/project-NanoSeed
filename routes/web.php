<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\KampanyeController;

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

        Route::resource('kampanye', KampanyeController::class)->except(['show']);
    });

});

// NAVBAR ADMIN


// Donasi
Route::get('/admin/donasi', function () {
    return view('admin.donasi');
})->name('views.admin.donasi');

// Dampak
Route::get('/admin/dampak', function () {
    return view('admin.dampak');
})->name('views.admin.dampak');

// Dokumentasi
Route::get('/admin/dokumentasi', function () {
    return view('admin.dokumentasi');
})->name('views.admin.dokumentasi');
