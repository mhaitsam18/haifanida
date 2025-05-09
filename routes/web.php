<?php

use App\Http\Controllers\AdminAdminController;
use App\Http\Controllers\AdminAgenController;
use App\Http\Controllers\AdminAuthorController;
use App\Http\Controllers\AdminBerkasController;
use App\Http\Controllers\AdminBerkasJemaahController;
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
use App\Http\Controllers\AdminKamarController;
use App\Http\Controllers\AdminKamarJemaahController;
use App\Http\Controllers\AdminKantorController;
use App\Http\Controllers\AdminKontenController;
use App\Http\Controllers\AdminMaskapaiController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPaketController;
use App\Http\Controllers\AdminPaketEkstraController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\AdminPemesananController;
use App\Http\Controllers\AdminPemesananEkstraController;
use App\Http\Controllers\AdminPemesananKamarController;
use App\Http\Controllers\AdminPenerbanganController;
use App\Http\Controllers\AdminPenginapanController;
use App\Http\Controllers\AdminPenumpangController;
use App\Http\Controllers\AdminPermintaanKamarController;
use App\Http\Controllers\AdminPerwakilanController;
use App\Http\Controllers\AdminPesanController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminSertifikatJemaahController;
use App\Http\Controllers\AdminSubMenuController;
use App\Http\Controllers\AdminTagihanController;
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

Route::redirect('/form-keluhan', 'https://docs.google.com/forms/d/e/1FAIpQLSfJNCjYC6nJ9fwwGd5BBblkM4SITpDo-u_zIBFFQKxCSPmHxQ/viewform?usp=sharing');
Route::redirect('/form-kuesioner', 'https://docs.google.com/forms/d/e/1FAIpQLSdhyNI6HqR7KCJZrfZ4pSDYisUMrnNJ7uj4cPlgghP00YR33A/viewform?usp=dialog');
Route::get('/keluhan', [HomeController::class, 'keluhan'])->name('home.keluhan');
Route::get('/kuesioner', [HomeController::class, 'kuesioner'])->name('home.kuesioner');

Route::get('/umroh', [HomeController::class, 'umroh'])->name('home.umroh');
Route::get('/haji', [HomeController::class, 'haji'])->name('home.haji');
Route::get('/wisata-halal', [HomeController::class, 'wisataHalal'])->name('home.wisata-halal');

Route::get('/galeri', [HomeGaleriController::class, 'index'])->name('home.galeri');
Route::get('/artikel', [HomeArtikelController::class, 'index'])->name('home.artikel');
Route::get('/kajian', [HomeKajianController::class, 'index'])->name('home.kajian');

Route::get('/profil', [HomeController::class, 'profil'])->name('home.profil');
Route::get('/sejarah', [HomeController::class, 'sejarah'])->name('home.profil');
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
                    Route::prefix('galeri')->group(function () {
                        Route::get('/', [AdminGaleriController::class, 'index'])->name('admin.paket.galeri.index');
                        Route::get('/create', [AdminGaleriController::class, 'create'])->name('admin.paket.galeri.create');
                    });
                    Route::prefix('paket-ekstra')->group(function () {
                        Route::get('/', [AdminPaketEkstraController::class, 'index'])->name('admin.paket.paket-ekstra.index');
                        Route::get('/create', [AdminPaketEkstraController::class, 'create'])->name('admin.paket.paket-ekstra.create');
                    });
                    Route::prefix('ekstra')->group(function () {
                        Route::get('/', [AdminPaketEkstraController::class, 'index'])->name('admin.paket.ekstra.index');
                        Route::get('/create', [AdminPaketEkstraController::class, 'create'])->name('admin.paket.ekstra.create');
                    });
                    Route::prefix('jemaah')->group(function () {
                        Route::get('/', [AdminJemaahController::class, 'index'])->name('admin.paket.jemaah.index');
                        Route::get('/create', [AdminJemaahController::class, 'create'])->name('admin.paket.jemaah.create');
                        Route::get('/{jemaah}', [AdminJemaahController::class, 'show'])->name('admin.paket.jemaah.show');
                        Route::get('/{jemaah}/edit', [AdminJemaahController::class, 'edit'])->name('admin.paket.jemaah.edit');
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

                Route::prefix('pemesanan/{pemesanan}')->group(function () {
                    Route::prefix('pemesanan-kamar')->group(function () {
                        Route::get('/', [AdminPemesananKamarController::class, 'index'])->name('admin.pemesanan.pemesanan-kamar.index');
                        Route::get('/create', [AdminPemesananKamarController::class, 'create'])->name('admin.pemesanan.pemesanan-kamar.create');
                    });
                    Route::prefix('pemesanan-ekstra')->group(function () {
                        Route::get('/', [AdminPemesananEkstraController::class, 'index'])->name('admin.pemesanan.pemesanan-ekstra.index');
                        Route::get('/create', [AdminPemesananekstraController::class, 'create'])->name('admin.pemesanan.pemesanan-ekstra.create');
                    });
                    Route::prefix('pembayaran')->group(function () {
                        Route::get('/', [AdminPembayaranController::class, 'index'])->name('admin.pemesanan.pembayaran.index');
                        Route::get('/create', [AdminPembayaranController::class, 'create'])->name('admin.pemesanan.pembayaran.create');
                    });
                    Route::prefix('tagihan')->group(function () {
                        Route::get('/', [AdminTagihanController::class, 'index'])->name('admin.pemesanan.tagihan');
                        Route::get('/cetak', [AdminTagihanController::class, 'cetak'])->name('admin.pemesanan.cetak');
                    });
                });
                Route::resource('pemesanan', AdminPemesananController::class)->parameters([
                    'pemesanan' => 'pemesanan'
                ]);
                Route::resource('pemesanan-kamar', AdminPemesananKamarController::class)->parameters([
                    'pemesanan-kamar' => 'pemesanan_kamar'
                ]);
                Route::resource('pemesanan-ekstra', AdminPemesananEkstraController::class)->parameters([
                    'pemesanan-ekstra' => 'pemesanan_ekstra'
                ]);
                Route::resource('pembayaran', AdminPembayaranController::class)->parameters([
                    'pembayaran' => 'pembayaran'
                ]);

                Route::prefix('pemesanan-kamar/{pemesanan_kamar}')->group(function () {
                    Route::prefix('permintaan-kamar')->group(function () {
                        Route::get('/', [AdminPermintaanKamarController::class, 'index'])->name('admin.pemesanan-kamar.permintaan-kamar.index');
                        Route::get('/create', [AdminPermintaanKamarController::class, 'create'])->name('admin.pemesanan-kamar.permintaan-kamar.create');
                    });
                });
                Route::resource('permintaan-kamar', AdminPermintaanKamarController::class)->parameters([
                    'permintaan-kamar' => 'permintaan_kamar'
                ]);


                Route::resource('penerbangan', AdminPenerbanganController::class)->parameters([
                    'penerbangan' => 'paket_maskapai'
                ]);

                Route::prefix('penginapan/{paket_hotel}')->group(function () {
                    Route::prefix('kamar')->group(function () {
                        Route::get('/', [AdminKamarController::class, 'index'])->name('admin.penginapan.kamar.index');
                        Route::get('/create', [AdminKamarController::class, 'create'])->name('admin.penginapan.kamar.create');
                    });
                });
                Route::resource('penginapan', AdminPenginapanController::class)->parameters([
                    'penginapan' => 'paket_hotel'
                ]);

                Route::prefix('kamar/{kamar}')->group(function () {
                    Route::prefix('kamar-jemaah')->group(function () {
                        Route::get('/', [AdminKamarJemaahController::class, 'index'])->name('admin.kamar.kamar-jemaah.index');
                        Route::get('/create', [AdminKamarJemaahController::class, 'create'])->name('admin.kamar.kamar-jemaah.create');
                    });
                });
                Route::resource('kamar', AdminKamarController::class)->parameters([
                    'kamar' => 'kamar'
                ]);
                Route::resource('galeri', AdminGaleriController::class)->parameters([
                    'galeri' => 'galeri'
                ]);
                Route::resource('paket-ekstra', AdminPaketEkstraController::class)->parameters([
                    'paket-ekstra' => 'paket_ekstra'
                ]);
                Route::resource('bus', AdminBusController::class)->parameters([
                    'bus' => 'bus'
                ]);
                Route::resource('penumpang', AdminPenumpangController::class)->parameters([
                    'penumpang' => 'bus_jemaah'
                ]);
                Route::prefix('grup')->group(function () { // routes/web.php
                    Route::post('/pindah-ke-grup', [AdminGrupController::class, 'pindahKeGrup'])->name('admin.grup.pindah-ke-grup');
                    Route::post('/kembali-ke-jemaah', [AdminGrupController::class, 'kembaliKeJemaah'])->name('admin.grup.kembali-ke-jemaah');
                });
                Route::prefix('grup/{grup}')->group(function () {
                    Route::prefix('tagihan')->group(function () {
                        Route::get('/', [AdminTagihanController::class, 'tagihanGrup'])->name('admin.grup.tagihan');
                        Route::get('/cetak', [AdminTagihanController::class, 'cetak'])->name('admin.grup.cetak');
                    });
                    Route::prefix('isu-perjalanan')->group(function () {
                        Route::get('/', [AdminIsuPerjalananController::class, 'index'])->name('admin.grup.isu-perjalanan.index');
                        Route::get('/create', [AdminIsuPerjalananController::class, 'create'])->name('admin.grup.isu-perjalanan.create');
                    });
                    Route::prefix('jadwal')->group(function () {
                        Route::get('/', [AdminJadwalController::class, 'index'])->name('admin.grup.jadwal.index');
                        Route::get('/create', [AdminJadwalController::class, 'create'])->name('admin.grup.jadwal.create');
                    });
                });
                Route::resource('grup', AdminGrupController::class)->parameters([
                    'grup' => 'grup'
                ]);

                Route::resource('isu-perjalanan', AdminIsuPerjalananController::class)->parameters([
                    'isu-perjalanan' => 'isu_perjalanan'
                ]);
                Route::resource('jadwal', AdminJadwalController::class)->parameters([
                    'jadwal' => 'jadwal'
                ]);
                Route::prefix('jemaah/{jemaah}')->group(function () {
                    Route::prefix('sertifikat')->group(function () {
                        Route::get('/', [AdminSertifikatJemaahController::class, 'index'])->name('admin.jemaah.sertifikat.index');
                        Route::get('/create', [AdminSertifikatJemaahController::class, 'create'])->name('admin.jemaah.sertifikat.create');
                    });
                    Route::prefix('berkas')->group(function () {
                        Route::get('/', [AdminBerkasJemaahController::class, 'index'])->name('admin.jemaah.berkas.index');
                        Route::get('/create', [AdminBerkasJemaahController::class, 'create'])->name('admin.jemaah.berkas.create');
                    });
                    Route::prefix('kamar')->group(function () {
                        Route::get('/', [AdminKamarJemaahController::class, 'index'])->name('admin.jemaah.kamar.index');
                        Route::get('/create', [AdminKamarJemaahController::class, 'create'])->name('admin.jemaah.kamar.create');
                    });
                    Route::prefix('bus')->group(function () {
                        Route::get('/', [AdminBusJemaahController::class, 'index'])->name('admin.jemaah.bus.index');
                        Route::get('/create', [AdminBusJemaahController::class, 'create'])->name('admin.jemaah.bus.create');
                    });
                });
                Route::resource('jemaah', AdminJemaahController::class)->parameters([
                    'jemaah' => 'jemaah'
                ]);
                Route::resource('berkas-jemaah', AdminBerkasJemaahController::class)->parameters([
                    'berkas-jemaah' => 'berkas_jemaah'
                ]);
                Route::resource('kamar-jemaah', AdminKamarJemaahController::class)->parameters([
                    'kamar-jemaah' => 'kamar_jemaah'
                ]);
                Route::resource('bus-jemaah', AdminBusJemaahController::class)->parameters([
                    'bus-jemaah' => 'bus_jemaah'
                ]);
                Route::resource('sertifikat-jemaah', AdminSertifikatJemaahController::class)->parameters([
                    'sertifikat-jemaah' => 'sertifikat_jemaah'
                ]);
                Route::prefix('bus-jemaah')->group(function () {});
                Route::prefix('pelayanan')->group(function () {});
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
