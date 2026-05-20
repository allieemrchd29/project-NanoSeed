<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\KampanyeController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\DampakController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\Admin\DashboardController;


//redirect ke halaman login
Route::get('/loginAdmin', function () {
    return redirect()->route('admin.login');
});

// Route untuk halaman donatur
Route::get('/', [DonaturController::class, 'index'])->name('donatur.dashboard');

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

        //notifikasi
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/',          [NotificationController::class, 'index'])      ->name('index');
            Route::post('/mark-all', [NotificationController::class, 'markAllRead'])->name('mark-all');
            Route::patch('/mark-all', [NotificationController::class, 'markAllRead'])->name('readAll');            
            Route::patch('/{id}/read',[NotificationController::class, 'markRead'])->name('read');            
            Route::delete('/{id}',   [NotificationController::class, 'destroy'])    ->name('destroy');
        
            // API untuk AJAX polling (dipanggil JavaScript di navbar)
            Route::get('/api/count',  [NotificationController::class, 'unreadCount'])->name('api.count');
            Route::get('/api/latest', [NotificationController::class, 'latest'])     ->name('api.latest');
        });
    });

});

    // NAVBAR ADMIN
    // Donasi
    // tabel rekapitulasi (Data dari Database)
    Route::get('/admin/donasi', [DonationController::class, 'index'])->name('views.admin.donasi');
    // tabel rekapitulasi terbaru
    Route::get('/admin/donasi/latest', [DonationController::class, 'latest'])->name('admin.donasi.latest');
    //export pdf
    Route::get('/admin/donasi/export-pdf', [DonationController::class, 'exportPdf'])->name('admin.donasi.export-pdf');
    // Menghapus data donatur
    Route::delete('/admin/donasi/{id}', [DonationController::class, 'destroy'])->name('admin.donasi.destroy');
    // // Menyimpan data (Akan digunakan oleh form donatur nanti)
    // Route::post('/admin/donasi', [DonationController::class, 'store'])->name('admin.donasi.store');
    // Route untuk Donatur kirim form
    Route::post('/donatur/donasi/simpan', [DonationController::class, 'store'])->name('donatur.donasi.store');
    //Route manggil dahsboard admin
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Dampak
    Route::get('/donatur/dampak', function () {
    $dampaks = \App\Models\Dampak::latest()->get();
    return view('donatur.dampak', compact('dampaks'));
    })->name('views.donatur.dampak');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('dampak', DampakController::class)->except(['show']);
    });

    // donatur
    Route::get('/donatur/dampak', function () {
        $dampaks = \App\Models\Dampak::latest()->get();
        return view('donatur.dampak', compact('dampaks'));
    })->name('views.donatur.dampak');
    Route::get('/donatur/dokumentasi', [DonaturController::class, 'dokumentasi'])->name('views.donatur.dokumentasi');
    Route::get('/donatur/dokumentasi/{id}', [DonaturController::class, 'detailDokumentasi'])->name('views.donatur.dokumentasi.detail');
    Route::get('/donatur/donasi', function () {return view('donatur.donasi');})->name('views.donatur.donasi');
    Route::get('/donatur/kampanye', [DonaturController::class, 'kampanye'])->name('views.donatur.kampanye');
    Route::get('/donatur/kampanye/{id}', [DonaturController::class, 'detail'])->name('views.donatur.kampanye.detail');
    Route::get('/donatur/aboutus', function () {return view('donatur.aboutus');})->name('views.donatur.aboutus');
    Route::get('/donatur/search', function () {return view('donatur.search');})->name('views.donatur.search');

    // about us
    Route::get('/donatur/about-us', function () {return view('donatur.aboutus');})->name('donatur.aboutus');

    // Route Payment Midtrans
    Route::post('/donation/pay',          [DonationController::class, 'createPayment'])    ->name('donation.pay');
    Route::get('/donation/payment',       [DonationController::class, 'paymentPage'])      ->name('donation.payment-page');
    Route::post('/donation/notification', [DonationController::class, 'handleNotification'])->name('donation.notification');
    Route::get('/donation/status/{orderId}', [DonationController::class, 'checkStatus'])   ->name('donation.status');



