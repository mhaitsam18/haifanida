<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProvinsiController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('maintenance', [
//         'title' => 'Haifa Nida Wisata',
//         'page' => 'maintenance',
//         'judul' => 'Coming Soon',
//         'pesan' => 'Kami akan segera hadir untuk Anda! :)',
//     ]);
// });

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/logout', [AuthController::class, 'logout'])->name('get.logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');

    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});


Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::middleware('superadmin')->group(function () {
            });
            Route::middleware('adminkantor')->group(function () {
                Route::middleware('pusat')->group(function () {
                });
                Route::middleware('perwakilan')->group(function () {
                });
                Route::middleware('cabang')->group(function () {
                });
            });
        });
    });
    Route::middleware('author')->group(function () {
        Route::prefix('author')->group(function () {
        });
    });
    Route::middleware('member')->group(function () {
        Route::prefix('member')->group(function () {
        });
        Route::prefix('jemaah')->group(function () {
            Route::middleware('jemaah')->group(function () {
            });
        });
    });
    Route::middleware('agen')->group(function () {
        Route::prefix('agen')->group(function () {
        });
    });
});
