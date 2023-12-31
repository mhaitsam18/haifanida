<?php

use App\Http\Controllers\AdminAdminController;
use App\Http\Controllers\AdminAgenController;
use App\Http\Controllers\AdminAuthorController;
use App\Http\Controllers\AdminBusJemaahController;
use App\Http\Controllers\AdminCabangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\AdminGrupController;
use App\Http\Controllers\AdminHotelController;
use App\Http\Controllers\AdminIsuPerjalananController;
use App\Http\Controllers\AdminJadwalController;
use App\Http\Controllers\AdminJemaahController;
use App\Http\Controllers\AdminKamarJemaahController;
use App\Http\Controllers\AdminKantorController;
use App\Http\Controllers\AdminKontenController;
use App\Http\Controllers\AdminMaskapaiController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPaketController;
use App\Http\Controllers\AdminPerwakilanController;
use App\Http\Controllers\AdminPesanController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminSubMenuController;
use App\Http\Controllers\AgenController;
use App\Http\Controllers\AgenGrupController;
use App\Http\Controllers\AgenJemaahController;
use App\Http\Controllers\AgenPoinController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorArtikelController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthorKajianController;
use App\Http\Controllers\AuthorKontenController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JemaahController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\VerificationController;
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

Route::post('/send-verification-email', [VerificationController::class, 'sendVerificationEmail'])->name('verification.send');
Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->name('verification.verify');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/login-admin', [AuthController::class, 'loginAdmin'])->name('login-admin');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
    Route::get('/admin/forgot-password', [ForgotPasswordController::class, 'admin'])->name('admin.forgot-password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendForgotPasswordEmail'])->name('forgot-password');
    Route::get('/reset-password/{token}/{email}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password/{user}', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');


    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});


Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin.index');
            Route::get('/index', [AdminController::class, 'index'])->name('superadmin.index');
            Route::middleware('superadmin')->group(function () {
                Route::resource('user-admin', AdminAdminController::class)->parameters([
                    'user-admin' => 'admin'
                ]);
                Route::resource('author', AdminAuthorController::class)->parameters([
                    'author' => 'author'
                ]);;
                Route::resource('member', AdminMemberController::class)->parameters([
                    'member' => 'member'
                ]);;
                Route::resource('agen', AdminAgenController::class)->parameters([
                    'agen' => 'agen'
                ]);;
                Route::resource('role', AdminRoleController::class)->parameters([
                    'role' => 'role'
                ]);;
                Route::resource('menu', AdminMenuController::class)->parameters([
                    'menu' => 'menu'
                ]);;
                Route::resource('sub-menu', AdminSubMenuController::class)->parameters([
                    'sub-menu' => 'sub_menu'
                ]);;
                Route::resource('konten', AdminKontenController::class)->parameters([
                    'konten' => 'konten'
                ]);;
                Route::resource('kantor', AdminKantorController::class)->parameters([
                    'kantor' => 'kantor'
                ]);;
                Route::resource('perwakilan', AdminPerwakilanController::class)->parameters([
                    'perwakilan' => 'perwakilan'
                ]);;
                Route::resource('cabang', AdminCabangController::class)->parameters([
                    'cabang' => 'cabang'
                ]);;
                Route::resource('hotel', AdminHotelController::class)->parameters([
                    'hotel' => 'hotel'
                ]);;
                Route::resource('maskapai', AdminMaskapaiController::class)->parameters([
                    'maskapai' => 'maskapai'
                ]);;
                Route::resource('pesan', AdminPesanController::class)->parameters([
                    'pesan' => 'pesan'
                ]);;
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
                Route::resource('paket', AdminPaketController::class)->parameters([
                    'paket' => 'paket'
                ]);;
                Route::resource('galeri', AdminGaleriController::class)->parameters([
                    'galeri' => 'galeri'
                ]);;
                Route::resource('isu-perjalanan', AdminIsuPerjalananController::class)->parameters([
                    'isu-perjalanan' => 'isu_perjalanan'
                ]);;
                Route::resource('jadwal', AdminJadwalController::class)->parameters([
                    'jadwal' => 'jadwal'
                ]);;
                Route::resource('jemaah', AdminJemaahController::class)->parameters([
                    'jemaah' => 'jemaah'
                ]);;
                Route::resource('kamar-jemaah', AdminKamarJemaahController::class)->parameters([
                    'kamar-jemaah' => 'kamar_jemaah'
                ]);;
                Route::resource('bus-jemaah', AdminBusJemaahController::class)->parameters([
                    'bus-jemaah' => 'bus_jemaah'
                ]);;
                Route::prefix('bus-jemaah')->group(function () {
                });
                Route::resource('grup', AdminGrupController::class)->parameters([
                    'grup' => 'grup'
                ]);;
                Route::prefix('grup')->group(function () {
                });
                Route::prefix('pelayanan')->group(function () {
                });
            });
        });
    });
    Route::middleware('author')->group(function () {
        Route::prefix('author')->group(function () {
            Route::get('/', [AuthorController::class, 'index'])->name('author');
            Route::get('/index', [AuthorController::class, 'index'])->name('author.index');
            Route::resource('kajian', AuthorKajianController::class)->parameters([
                'kajian' => 'kajian'
            ]);;
            Route::resource('artikel', AuthorArtikelController::class)->parameters([
                'artikel' => 'artikel'
            ]);;
            Route::resource('konten', AuthorKontenController::class)->parameters([
                'konten' => 'konten'
            ]);;
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
            Route::resource('grup', AgenGrupController::class)->parameters([
                'grup' => 'grup'
            ]);;
            Route::resource('jemaah', AgenJemaahController::class)->parameters([
                'jemaah' => 'jemaah'
            ]);;
            Route::resource('poin', AgenPoinController::class)->parameters([
                'poin' => 'poin'
            ]);;
        });
    });
});
