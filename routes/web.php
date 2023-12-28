<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JemaahController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\SuperAdminController;
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
// Route::get('/coba', [AuthController::class, 'coba'])->name('coba');


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/logout', [AuthController::class, 'logout'])->name('get.logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/check-username/{username}', [AuthController::class, 'checkUsernameAvailability']);
Route::get('/check-email/{email}', [AuthController::class, 'checkEmailAvailability']);


// Rute untuk mengirimkan email verifikasi
Route::post('/send-verification-email', [AuthController::class, 'sendVerificationEmail'])->name('verification.send');
// Rute untuk verifikasi email
Route::get('/verify-email/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
// Rute untuk verifikasi email
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verify');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'sendForgotPasswordEmail'])->name('forgot-password');



    Route::get('/reset-password/{token}/{email}', [AuthController::class, 'showResetForm'])->name('password.reset');

    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});


Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin.index');
            Route::middleware('superadmin')->group(function () {
                Route::get('/index', [SuperAdminController::class, 'index'])->name('superadmin.index');
            });
            Route::middleware('adminkantor')->group(function () {
                Route::middleware('pusat')->group(function () {
                    Route::get('/', [AdminController::class, 'pusat'])->name('admin.pusat');
                });
                Route::middleware('perwakilan')->group(function () {
                    Route::get('/', [AdminController::class, 'perwakilan'])->name('perwakilan');
                });
                Route::middleware('cabang')->group(function () {
                    Route::get('/', [AdminController::class, 'cabang'])->name('cabang');
                });
            });
        });
    });
    Route::middleware('author')->group(function () {
        Route::prefix('author')->group(function () {
            Route::get('/', [AuthorController::class, 'index'])->name('author');
            Route::get('/index', [AuthorController::class, 'index'])->name('author.index');
        });
    });
    Route::middleware('member')->group(function () {
        Route::prefix('member')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('member');
            Route::get('/index', [MemberController::class, 'index'])->name('member.index');
        });
        Route::prefix('jemaah')->group(function () {
            Route::middleware('jemaah')->group(function () {
                Route::get('/', [JemaahController::class, 'index'])->name('jemaah');
                Route::get('/index', [JemaahController::class, 'index'])->name('jemaah.index');
            });
        });
    });
    Route::middleware('agen')->group(function () {
        Route::prefix('agen')->group(function () {
            Route::get('/', [AgenController::class, 'index'])->name('agen');
            Route::get('/index', [AgenController::class, 'index'])->name('agen');
        });
    });
});
