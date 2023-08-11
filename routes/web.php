<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganPaketController;

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

Auth::routes();


Route::middleware('auth')->group(function() {
    Route::middleware('pelanggan')->group(function() {
        Route::get('pesan/{paket}', [PelangganPaketController::class, 'create'])->name('pelanggan.paket');
        Route::post('pesan', [PelangganPaketController::class, 'store'])->name('pelanggan.paket.store');
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
