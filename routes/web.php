<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFaqController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganPaketController;
use App\Http\Controllers\PelangganPesananController;
use App\Http\Controllers\PelangganTestimoniController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|----------------------
| Route Landing Page
|----------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/paket', [PaketController::class, 'index'])->name('daftar-paket');
Route::get('/paket/{paket}', [PaketController::class, 'show'])->name('paket');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

Auth::routes();

Route::middleware('auth')->group(function () {
    /*
    |----------------------
    | Route Pelanggan
    |----------------------
    */
    Route::middleware('pelanggan')->group(function () {
        /*
        |----------------------
        | landing page
        |----------------------
        */
        Route::get('pesan/{paket}', [PelangganPaketController::class, 'create'])->name('pelanggan.paket');
        Route::post('pesan', [PelangganPaketController::class, 'store'])->name('pelanggan.paket.store');

        /*
        |----------------------
        | dashboard
        |----------------------
        */
        Route::prefix('pelanggan')->group(function () {
            Route::get('/', [PelangganController::class, 'index'])->name('dashboard.pelanggan');
            Route::get('/kontak-admin', [PelangganController::class, 'kontak'])->name('pelanggan.kontak');

            Route::prefix('pesanan')->group(function () {
                Route::get('/', [PelangganPesananController::class, 'index'])->name('pelanggan.pesanan');
                Route::get('/{pesanan}', [PelangganPesananController::class, 'show'])->name('pelanggan.pesanan.show');
            });

            Route::prefix('testimoni')->group(function () {
                Route::get('/', [PelangganTestimoniController::class, 'index'])->name('pelanggan.testimoni');
                Route::get('/{pesanan}', [PelangganTestimoniController::class, 'create'])->name('pelanggan.testimoni.create');
                Route::post('/', [PelangganTestimoniController::class, 'store'])->name('pelanggan.testimoni.store');
            });
        });
    });

    /*
    |----------------------
    | Route Admin
    |----------------------
    */
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('dashboard');

            Route::resource('faq', AdminFaqController::class);

    });
});
