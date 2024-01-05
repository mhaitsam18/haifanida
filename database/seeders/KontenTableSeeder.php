<?php

namespace Database\Seeders;

use App\Models\Konten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kontens = [
            [
                'nama' => 'Beranda 1',
                'judul' => 'Haia Nida Wisata',
                'isi_konten' => '<p>
                                    Tour & Travel
                                    <br>
                                    No. SK : 91202027102820002
                                    <br>
                                    2 Agustus 2022
                                </p>',
                'gambar' => 'konten-gambar/beranda-slide1.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Beranda 2',
                'judul' => 'Berdiri sejak tahun 2007',
                'isi_konten' => '<p>
                                    didirikan oleh Dr. Fakhrurrozi, Lc., MA, seorang alumni Universitas Islam Madinah yang
                                    memiliki pengalaman mendalam dan wawasan yang tak ternilai tentang Mekkah dan Madinah.
                                    Kombinasi pengetahuannya yang mendalam tentang destinasi suci bersama keahliannya dalam
                                    ilmu agama, menjadikan kami pilihan utama untuk perjalanan Haji, Umroh, dan wisata halal
                                    Anda.
                                </p>',
                'gambar' => 'konten-gambar/beranda-slide2.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Beranda 3',
                'judul' => 'Aman, Nyaman dan Amanah',
                'isi_konten' => '<p>
                                    "Aman, Nyaman, dan Amanah" adalah sebuah moto yang sangat kuat dan menggambarkan prinsip
                                    utama PT. Haifa Nida Wisata dalam memberikan pelayanan kepada para jamaah. Kombinasi
                                    dari keamanan, kenyamanan, dan keamanahan mencerminkan komitmen kami untuk memberikan
                                    pengalaman perjalanan ibadah yang tak terlupakan. Dalam setiap perjalanan bersama kami,
                                    kami berusaha untuk menjaga ketiga nilai ini sebagai fondasi utama dalam layanan kami
                                    kepada Anda.
                                </p>',
                'gambar' => 'konten-gambar/beranda-slide3.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Beranda 4',
                'judul' => 'Sejarah PT. Haifa Nida Wisata Karawang',
                'isi_konten' => '<p>
                                PT. Haifa Nida Wisata Karawang, didirikan pada tahun 2007 oleh Dr. Fakhrurrozi, Lc., MA,
                                seorang alumni Universitas Islam Madinah yang memiliki pengalaman mendalam dan wawasan yang
                                tak ternilai tentang Mekkah dan Madinah. Kombinasi pengetahuannya yang mendalam tentang
                                destinasi suci bersama keahliannya dalam ilmu agama, menjadikan kami pilihan utama untuk
                                perjalanan Haji, Umroh, dan wisata halal Anda
                            </p>
                            <p>
                                Pendiri bukan hanya seorang alumni Universitas Islam Madinah yang berpengalaman dalam bidang
                                perjalanan ibadah, tetapi juga merupakan otak di balik Catering Al-Haidari di Madinah.
                                Pengalamannya yang luas dalam bisnis perhotelan dan sarana transportasi di Kota Mekkah dan
                                Madinah membuatnya menjadi sumber pengetahuan yang tak ternilai dalam menyediakan pelayanan
                                berkualitas tinggi kepada para jamaah Haji dan Umroh.
                            </p>
                            <p>
                                Tak hanya itu, Dr. Fakhrurrozi juga merupakan pemilik Bakso Si Adoel yang terkenal di
                                Madinah dan selalu buka selama musim Haji. Kombinasi pengalaman dan dedikasi dalam
                                memberikan pengalaman terbaik kepada para tamu Allah menjadikannya alasan yang sangat kuat
                                untuk memilih PT. Haifa Nida Wisata sebagai mitra perjalanan Haji dan Umroh Anda.
                                Keberadaannya yang berpengalaman adalah jaminan kualitas dalam setiap perjalanan ibadah
                                Anda.
                            </p>',
                'gambar' => 'konten-gambar/beranda-sejarah.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Profil Perusahaan',
                'judul' => 'Profil Perusahaan',
                'isi_konten' => '<p>

                            </p>',
                'gambar' => 'konten-gambar/profil-perusahaan.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Visi Misi',
                'judul' => 'Visi Misi',
                'isi_konten' => '<p>

                            </p>',
                'gambar' => 'konten-gambar/visi-misi.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'FAQ',
                'judul' => 'Frequently Asked Questions',
                'isi_konten' => '<p>

                            </p>',
                'gambar' => 'konten-gambar/faq.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Panduan',
                'judul' => 'Panduan',
                'isi_konten' => '<p>

                            </p>',
                'gambar' => 'konten-gambar/panduan.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Syarat dan Ketentuan',
                'judul' => 'Syarat & Ketentuan',
                'isi_konten' => '<p>

                            </p>',
                'gambar' => 'konten-gambar/syarat-ketentuan.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Kebijakan Privasi',
                'judul' => 'Kebijakan Privasi',
                'isi_konten' => '<p>

                            </p>',
                'gambar' => 'konten-gambar/kebijakan-privasi.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Akte Perusahaan',
                'judul' => 'Akte Perusahaan',
                'isi_konten' => '<p>
                Nomor Akte:
                            </p>',
                'gambar' => 'konten-gambar/akte-perusahaan.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'NIB',
                'judul' => 'NIB',
                'isi_konten' => '<p>
                Nomor NIB:
                            </p>',
                'gambar' => 'konten-gambar/nib.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'PPIU',
                'judul' => 'PPIU',
                'isi_konten' => '<p>
                Nomor PPIU:
                            </p>',
                'gambar' => 'konten-gambar/ppiu.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'PIHK',
                'judul' => 'PIHK',
                'isi_konten' => '<p>
                Nomor PIHK:
                            </p>',
                'gambar' => 'konten-gambar/pihk.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'ASITA',
                'judul' => 'ASITA',
                'isi_konten' => '<p>
                Nomor ASITA:
                            </p>',
                'gambar' => 'konten-gambar/asita.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'IATA',
                'judul' => 'IATA',
                'isi_konten' => '<p>
                Nomor IATA:
                            </p>',
                'gambar' => 'konten-gambar/iata.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Motto',
                'judul' => 'Motto',
                'isi_konten' => '<p>

                            </p>',
                'gambar' => 'konten-gambar/motto.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Slogan',
                'judul' => 'Slogan',
                'isi_konten' => '<p>

                            </p>',
                'gambar' => 'konten-gambar/slogan.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Struktur Organisasi',
                'judul' => 'Struktur Organisasi',
                'isi_konten' => '<p>

                            </p>',
                'gambar' => 'konten-gambar/struktur-organsiasi.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Alamat Kantor Pusat',
                'judul' => 'Alamat',
                'isi_konten' => '<p>
                Jl. Ra. Kartini No.1, Karangpawitan, Kec. Karawang Barat, Karawang, Jawa Barat 41315
                            </p>',
                'gambar' => 'konten-gambar/alamat.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Rekening Perusahaan',
                'judul' => 'Rekening Rekening Perusahaan',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/rekening-perusahaan.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'sejarah',
                'judul' => 'sejarah',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/sejarah.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Arti Motto',
                'judul' => 'Arti Motto',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/arti-motto.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Logo Mitra',
                'judul' => 'Logo Mitra',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/logo-mitra.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Sosial Media',
                'judul' => 'Sosial Media',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/social-media.jpg',
                'indelible' => 1
            ],
            [
                'nama' => 'Konten',
                'judul' => 'Konten',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/konten.jpg',
                'indelible' => 0
            ],
            [
                'nama' => 'Kontak Utama',
                'judul' => 'Kontak Utama',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/kontak-utama.jpg',
                'indelible' => 0
            ],
            [
                'nama' => 'Email Utama',
                'judul' => 'Email Utama',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/email-utama.jpg',
                'indelible' => 0
            ],
            [
                'nama' => 'Email CS',
                'judul' => 'Email CS',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/email-cs.jpg',
                'indelible' => 0
            ],
            [
                'nama' => 'Email Admin',
                'judul' => 'Email Admin',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/email-admin.jpg',
                'indelible' => 0
            ],
            [
                'nama' => 'Nomor Direksi',
                'judul' => 'Nomor Direksi',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/nomor-direksi.jpg',
                'indelible' => 0
            ],
            [
                'nama' => 'Nomor Marketing',
                'judul' => 'Nomor Marketing',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/nomor-marketing.jpg',
                'indelible' => 0
            ],
            [
                'nama' => 'Nomor Keuangan',
                'judul' => 'Nomor Keuangan',
                'isi_konten' => '<p>
                            </p>',
                'gambar' => 'konten-gambar/nomor-keuangan.jpg',
                'indelible' => 0
            ],
        ];
        foreach ($kontens as $konten) {
            Konten::create($konten);
        }
    }
}
