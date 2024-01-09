<?php

use App\Http\Controllers\AdminAdminController;
use App\Http\Controllers\AdminAgenController;
use App\Http\Controllers\AdminAuthorController;
use App\Http\Controllers\AdminBerkasController;
use App\Http\Controllers\AdminBusController;
use App\Http\Controllers\AdminBusJemaahController;
use App\Http\Controllers\AdminCabangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEkstraController;
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
use App\Http\Controllers\AdminPemesananController;
use App\Http\Controllers\AdminPenerbanganController;
use App\Http\Controllers\AdminPenginapanController;
use App\Http\Controllers\AdminPenumpangController;
use App\Http\Controllers\AdminPerwakilanController;
use App\Http\Controllers\AdminPesanController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminSubMenuController;
use App\Http\Controllers\AdminUserController;
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
use App\Http\Controllers\HomeArtikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeGaleriController;
use App\Http\Controllers\HomeKajianController;
use App\Http\Controllers\JemaahController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MenuRoleController;
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



//untuk semua user
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');


Route::get('/umroh', [HomeController::class, 'umroh'])->name('home.umroh');
Route::get('/haji', [HomeController::class, 'haji'])->name('home.haji');
Route::get('/wisata-halal', [HomeController::class, 'wisataHalal'])->name('home.wisata-halal');

Route::get('/galeri', [HomeGaleriController::class, 'index'])->name('home.galeri');
Route::get('/artikel', [HomeArtikelController::class, 'index'])->name('home.artikel');
Route::get('/kajian', [HomeKajianController::class, 'index'])->name('home.kajian');

Route::get('/profil', [HomeController::class, 'profil'])->name('home.profil');
Route::get('/visi-misi', [HomeController::class, 'visiMisi'])->name('home.visi-misi');
Route::get('/kantor-kami', [HomeController::class, 'kantorKami'])->name('home.kantor-kami');

Route::get('/kontak-kami', [HomeController::class, 'kontakKami'])->name('home.kontak-kami');
Route::post('/kontak-kami', [HomeController::class, 'kirimPesan'])->name('home.kirim-pesan');
Route::get('/faq', [HomeController::class, 'faq'])->name('home.faq');
Route::get('/panduan', [HomeController::class, 'panduan'])->name('home.panduan');
Route::get('/syarat-ketentuan', [HomeController::class, 'syaratKetentuan'])->name('home.syarat-ketentuanZ');
Route::get('/kebijakan-privasi', [HomeController::class, 'kebijakanPrivasi'])->name('home.syarat-ketentuanZ');


Route::post('/get-kabupaten', [KabupatenController::class, 'getKabupaten'])->name('get-kabupaten');


Route::get('/logout', [AuthController::class, 'logout'])->name('get.logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/check-username/{username}', [AuthController::class, 'checkUsernameAvailability']);
Route::get('/check-email/{email}', [AuthController::class, 'checkEmailAvailability']);

Route::post('/send-verification-email', [VerificationController::class, 'sendVerificationEmail'])->name('verification.send');
Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->name('verification.verify');




//untuk User yang belum terautentikasi
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



//untuk User yang sudah terautentikasi
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin');
            Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
            Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
            Route::put('/profile/{user}', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
            Route::put('/password/{user}', [AdminController::class, 'passwordUpdate'])->name('admin.password.update');
            Route::middleware('superadmin')->group(function () {
                Route::resource('role', AdminRoleController::class)->parameters([
                    'role' => 'role'
                ]);
                Route::resource('user', AdminUserController::class)->parameters([
                    'user' => 'user'
                ]);
                Route::resource('user-admin', AdminAdminController::class)->parameters([
                    'user-admin' => 'admin'
                ]);
                Route::resource('author', AdminAuthorController::class)->parameters([
                    'author' => 'author'
                ]);
                Route::resource('member', AdminMemberController::class)->parameters([
                    'member' => 'member'
                ]);
                Route::resource('agen', AdminAgenController::class)->parameters([
                    'agen' => 'agen'
                ]);
                Route::resource('menu', AdminMenuController::class)->parameters([
                    'menu' => 'menu'
                ]);
                Route::post('/menu_roles/store', [MenuRoleController::class, 'store'])->name('menu_roles.store');
                Route::resource('sub-menu', AdminSubMenuController::class)->parameters([
                    'sub-menu' => 'sub_menu'
                ]);
                Route::resource('konten', AdminKontenController::class)->parameters([
                    'konten' => 'konten'
                ]);
                Route::resource('kantor', AdminKantorController::class)->parameters([
                    'kantor' => 'kantor'
                ]);
                Route::resource('perwakilan', AdminPerwakilanController::class)->parameters([
                    'perwakilan' => 'perwakilan'
                ]);
                Route::resource('cabang', AdminCabangController::class)->parameters([
                    'cabang' => 'cabang'
                ]);
                Route::resource('hotel', AdminHotelController::class)->parameters([
                    'hotel' => 'hotel'
                ]);
                Route::resource('maskapai', AdminMaskapaiController::class)->parameters([
                    'maskapai' => 'maskapai'
                ]);
                Route::resource('berkas', AdminBerkasController::class)->parameters([
                    'berkas' => 'berkas'
                ]);
                Route::resource('ekstra', AdminEkstraController::class)->parameters([
                    'ekstra' => 'ekstra'
                ]);
                Route::resource('pesan', AdminPesanController::class)->parameters([
                    'pesan' => 'pesan'
                ]);
                Route::post('pesan/kirim-email', [AdminPesanController::class, 'kirimEmail'])->name('admin.pesan.kirim-email');
            });
            Route::middleware('adminkantor')->group(function () {
                Route::get('/kantor-saya', [AdminKantorController::class, 'kantorSaya'])->name('admin.kantor-saya');
                Route::middleware('pusat')->group(function () {
                    Route::get('/', [AdminController::class, 'pusat'])->name('admin.pusat');
                });
                Route::middleware('perwakilan')->group(function () {
                    Route::get('/', [AdminController::class, 'perwakilan'])->name('perwakilan');
                });
                Route::middleware('cabang')->group(function () {
                    Route::get('/', [AdminController::class, 'cabang'])->name('cabang');
                });


                Route::prefix('paket/{paket}')->group(function () {
                    Route::prefix('pemesanan')->group(function () {
                        Route::get('/', [AdminPemesananController::class, 'index'])->name('admin.paket.pemesanan.index');
                        Route::get('/create', [AdminPemesananController::class, 'create'])->name('admin.paket.pemesanan.create');
                    });
                    Route::prefix('grup')->group(function () {
                        Route::get('/', [AdminGrupController::class, 'index'])->name('admin.paket.grup.index');
                        Route::get('/create', [AdminGrupController::class, 'create'])->name('admin.paket.grup.create');
                    });
                    Route::prefix('penginapan')->group(function () {
                        Route::get('/', [AdminPenginapanController::class, 'index'])->name('admin.paket.penginapan.index');
                        Route::get('/create', [AdminPenginapanController::class, 'create'])->name('admin.paket.penginapan.create');
                    });
                    Route::prefix('penerbangan')->group(function () {
                        Route::get('/', [AdminPenerbanganController::class, 'index'])->name('admin.paket.penerbangan.index');
                        Route::get('/create', [AdminPenerbanganController::class, 'create'])->name('admin.paket.penerbangan.create');
                    });
                    Route::prefix('bus')->group(function () {
                        Route::get('/', [AdminBusController::class, 'index'])->name('admin.paket.bus.index');
                        Route::get('/create', [AdminBusController::class, 'create'])->name('admin.paket.bus.create');
                    });
                    Route::prefix('galeri')->group(function () {
                        Route::get('/', [AdminGaleriController::class, 'index'])->name('admin.paket.galeri.index');
                        Route::get('/create', [AdminGaleriController::class, 'create'])->name('admin.paket.galeri.create');
                    });
                });
                Route::prefix('bus/{bus}')->group(function () {
                    Route::prefix('penumpang')->group(function () {
                        Route::get('/', [AdminPenumpangController::class, 'index'])->name('admin.paket.penumpang.index');
                        Route::get('/create', [AdminPenumpangController::class, 'create'])->name('admin.paket.penumpang.create');
                    });
                });

                Route::resource('paket', AdminPaketController::class)->parameters([
                    'paket' => 'paket'
                ]);
                Route::resource('penerbangan', AdminPenerbanganController::class)->parameters([
                    'penerbangan' => 'paket_maskapai'
                ]);
                Route::resource('penginapan', AdminPenginapanController::class)->parameters([
                    'penginapan' => 'paket_hotel'
                ]);
                Route::resource('galeri', AdminGaleriController::class)->parameters([
                    'galeri' => 'galeri'
                ]);
                Route::resource('bus', AdminBusController::class)->parameters([
                    'bus' => 'bus'
                ]);
                Route::resource('penumpang', AdminPenumpangController::class)->parameters([
                    'penumpang' => 'bus_jemaah'
                ]);

                Route::resource('isu-perjalanan', AdminIsuPerjalananController::class)->parameters([
                    'isu-perjalanan' => 'isu_perjalanan'
                ]);

                Route::resource('pemesanan', AdminPemesananController::class)->parameters([
                    'pemesanan' => 'pemesanan'
                ]);
                Route::resource('jadwal', AdminJadwalController::class)->parameters([
                    'jadwal' => 'jadwal'
                ]);
                Route::resource('jemaah', AdminJemaahController::class)->parameters([
                    'jemaah' => 'jemaah'
                ]);
                Route::resource('kamar-jemaah', AdminKamarJemaahController::class)->parameters([
                    'kamar-jemaah' => 'kamar_jemaah'
                ]);
                Route::resource('bus-jemaah', AdminBusJemaahController::class)->parameters([
                    'bus-jemaah' => 'bus_jemaah'
                ]);
                Route::prefix('bus-jemaah')->group(function () {
                });
                Route::resource('grup', AdminGrupController::class)->parameters([
                    'grup' => 'grup'
                ]);
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
            ]);
            Route::resource('artikel', AuthorArtikelController::class)->parameters([
                'artikel' => 'artikel'
            ]);
            Route::resource('konten', AuthorKontenController::class)->parameters([
                'konten' => 'konten'
            ]);
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
            ]);
            Route::resource('jemaah', AgenJemaahController::class)->parameters([
                'jemaah' => 'jemaah'
            ]);
            Route::resource('poin', AgenPoinController::class)->parameters([
                'poin' => 'poin'
            ]);
        });
    });
});
