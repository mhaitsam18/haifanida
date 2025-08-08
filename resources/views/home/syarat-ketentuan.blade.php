@extends('layouts.main')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="inner-banner">
        <div class="container">
            <div class="inner-title text-center">
                <h3>{{ $title }}</h3>
                <ul>
                    <li>
                        <a href="/home">Home</a>
                    </li>
                    <li>
                        <i class='bx bx-chevrons-right'></i>
                    </li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
        <div class="inner-shape">
            <img src="/assets-techex-demo/images/shape/inner-shape.png" alt="Images">
        </div>
    </div>
    <div class="terms-conditions-area pt-100 pb-70">
        <div class="container">
            {{-- <div class="section-title text-center">
                <h2>Syarat & Ketentuan</h2>
            </div> --}}


            <div class="row pt-45">
                <div class="col-lg-12">
                    {{-- <div class="terms-conditions-img">
                        <img src="/assets-techex-demo/images/terms-condition-img.jpg" alt="Images" loading="lazy">
                    </div> --}}
                   <div class="single-content">
                        <h3>Syarat dan Ketentuan Umroh</h3>
                        <p>
                            Untuk kenyamanan dan kelancaran ibadah, setiap calon jamaah yang mendaftar bersama PT. Haifa Nida Wisata Karawang wajib memahami dan menyetujui syarat dan ketentuan berikut:
                        </p>

                        <h4>A. Syarat Pendaftaran</h4>
                        <ul>
                            <li>Paspor asli berlaku minimal 8 bulan sebelum keberangkatan.</li>
                            <li>Nama pada paspor disarankan terdiri dari 3 suku kata. Contoh: Aufa Abdul Bari.</li>
                            <li>Pas foto ukuran 3x4 dan 4x6 cm, masing-masing sebanyak 3 lembar, latar belakang putih:
                                <ul>
                                    <li>Perempuan: wajib mengenakan kerudung rapat.</li>
                                    <li>Laki-laki: tidak memakai topi/peci.</li>
                                </ul>
                            </li>
                            <li>Fotokopi dokumen: KTP, KK, buku nikah (bagi pasangan suami-istri), akta lahir atau ijazah (opsional).</li>
                            <li>Sertifikat vaksin meningitis (wajib) dan vaksin influenza (disarankan).</li>
                            <li>Setiap Jemaah harus melengkapi semua dokumen dan pembayaran harus dilakukan sesuai jadwal yang ditentukan, keterlambatan dokumen dan pembayaran dapat mengakibatkan pembatalan pendaftaran.</li>
                        </ul>

                        <h4>B. Ketentuan Pembayaran dan Pembatalan</h4>
                        <ul>
                            <li>Pembayaran bertahap, wajib lunas sebelum keberangkatan.</li>
                            <li>Pembatalan setelah pembayaran pertama: potongan 10% dari biaya.</li>
                            <li>Pembatalan 2 minggu sebelum keberangkatan: potongan 75% dari biaya.</li>
                            <li>Pembatalan 2 hari sebelum keberangkatan: potongan 100% (tanpa pengembalian).</li>
                            <li>Keterlambatan pelunasan dapat menyebabkan pembatalan sepihak.</li>
                        </ul>

                        <h4>C. Ketentuan Selama Perjalanan</h4>
                        <ul>
                            <li>Setiap jamaah bertanggung jawab atas barang pribadinya</li>
                            <li>Bagasi mengikuti ketentuan maskapai (20–30 kg). Biaya kelebihan ditanggung jamaah.</li>
                            <li>Kamar hotel sesuai paket (quad, triple, double). Permintaan upgrade akan dikenakan biaya tambahan.</li>
                            <li>
                                Jamaah yang sakit akan didampingi oleh tim kami dan dibawa ke fasilitas kesehatan terdekat. Seluruh layanan kesehatan dasar di Arab Saudi umumnya <strong>gratis dan ditanggung oleh pemerintah</strong>. Namun, jika ada tindakan medis lanjutan yang memerlukan biaya tambahan atau dilakukan di fasilitas non-pemerintah, maka biaya tersebut menjadi tanggung jawab pribadi kecuali jika jamaah memiliki asuransi yang menanggungnya.
                            </li>
                            <li>
                                Jamaah yang terpisah dari rombongan akan diupayakan untuk ditemukan semaksimal mungkin oleh pihak travel.
                                Ada tiga kategori situasi kehilangan:
                                <ul>
                                    <li><strong>Hilang sementara:</strong> Jamaah terpisah sejenak dari rombongan namun segera ditemukan atau kembali sendiri ke lokasi yang telah ditentukan.</li>
                                    <li><strong>Hilang berkepanjangan:</strong> Jamaah tidak ditemukan dalam waktu seharian atau lebih, hingga rombongan mungkin sudah berpindah kota. Pencarian tetap dilakukan, namun semua risiko dan biaya tambahan yang timbul menjadi tanggung jawab pribadi jamaah.</li>
                                    <li><strong>Hilang total:</strong> Jika jamaah tidak ditemukan hingga rombongan kembali ke Indonesia dan dinyatakan sebagai orang hilang, seluruh tanggung jawab hukum, logistik, dan biaya akomodasi atau kepulangan (jika ditemukan) ditanggung sepenuhnya oleh jamaah yang bersangkutan.</li>
                                </ul>
                            </li>
                            <li>Jika wafat, pengurusan jenazah mengikuti prosedur Saudi Arabia dan dibantu pihak travel.</li>
                            <li>Jamaah wajib mengikuti seluruh agenda city tour, manasik, dan ibadah.</li>
                            <li>Dilarang keras melakukan aktivitas ilegal seperti penyelundupan, transaksi ilegal, narkotika dan obat-obatan terlarang, peredaran uang palsu, atau aktivitas yang melanggar hukum Saudi/Indonesia. Pelanggaran akan diproses sesuai hukum dan tanggung jawab pribadi jamaah.</li>
                            <li>Jamaah dilarang membuat kegaduhan, provokasi, atau tindakan yang merugikan jamaah lain. Travel berhak mengeluarkan dari rombongan jika dianggap mengganggu kenyamanan.</li>
                        </ul>

                        <h4>D. Ketentuan Visa</h4>
                        <ul>
                            <li>Jika visa gagal terbit karena kesalahan data jamaah, dana dikembalikan setelah dipotong biaya administrasi.</li>
                            <li>Jika visa gagal karena kebijakan Arab Saudi, pengembalian proporsional sesuai biaya yang belum digunakan.</li>
                        </ul>

                        <h4>E. Ketentuan Paket & Layanan</h4>
                        <ul>
                            <li>Seluruh layanan (hotel, konsumsi, transportasi, dan pembimbing) disediakan sesuai standar paket yang dipilih.</li>
                            <li>City tour disesuaikan dengan waktu, kondisi, dan kebijakan pemerintah Arab Saudi. Bisa dibatalkan atau diubah sewaktu-waktu.</li>
                            <li>Perubahan jadwal atau fasilitas dapat terjadi akibat kebijakan maskapai, imigrasi, atau kondisi force majeure. Jamaah wajib memaklumi kondisi di luar kendali penyelenggara.</li>
                            <li>Jamaah dianggap setuju dengan seluruh ketentuan saat melakukan pendaftaran dan pembayaran.</li>
                            <li>Jika peserta tidak hadir saat city tour, maka tidak ada penggantian atau refund.</li>
                        </ul>

                        <h4>F. Ketentuan Keterlambatan Pembayaran</h4>
                        <ul>
                            <li>Keterlambatan pelunasan dapat menyebabkan:
                                <ul>
                                    <li>Pembatalan tiket pesawat.</li>
                                    <li>Perubahan jadwal keberangkatan.</li>
                                    <li>Denda administrasi.</li>
                                </ul>
                            </li>
                        </ul>

                        <h4>G. Ketentuan Force Majeure</h4>
                        <ul>
                            <li>Force majeure meliputi bencana alam, wabah penyakit, konflik politik, kebijakan pemerintah dan Hal lain di luar kendali penyelenggara.</li>
                            <li>Penyelenggara tidak bertanggung jawab atas pembatalan akibat force majeure.</li>
                        </ul>

                        {{-- <h4>H. Pernyataan Persetujuan Jamaah</h4>
                        <p>
                            Dengan ini saya menyatakan telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan umroh yang diterbitkan oleh PT. Haifa Nida Wisata Karawang.
                            Saya bersedia mematuhi semua ketentuan selama proses keberangkatan hingga selesai perjalanan ibadah.
                        </p>

                        <table style="width:100%; margin-top: 30px;">
                            <tr>
                                <td style="width:50%">
                                    <strong>Nama Jamaah:</strong> ............................................ <br><br>
                                    <strong>Nomor HP:</strong> ................................................<br><br>
                                    <strong>Tanggal:</strong> ................................................<br><br>
                                </td>
                                <td style="text-align:center;">
                                    Karawang, ............. 2025 <br><br>
                                    <strong>Tanda Tangan Jamaah</strong><br><br><br>
                                    ...................................................
                                </td>
                            </tr>
                        </table> --}}

                        <h4>H. Pernyataan Hukum</h4>
                        <p>
                            Dengan mendaftar atau menggunakan layanan, Anda dianggap setuju dengan syarat dan ketentuan ini. Kami berhak memperbarui isi peraturan yang disebabkan regulasi atau kondisi di luar kendali kami.
                        </p>
                        <p>
                            Kami tidak bertanggung jawab atas perubahan informasi atau ketidaksesuaian akibat perubahan kebijakan. Semua isi situs dan promosi bersifat tidak mengikat secara hukum.
                        </p>
                        <p>Kami berkomitmen untuk menyediakan layanan perjalanan umroh yang mencakup transportasi, akomodasi, dan pendampingan ibadah sesuai dengan paket yang dipilih. Namun, layanan dapat berubah karena faktor seperti perubahan jadwal maskapai, regulasi pemerintah, atau keadaan force majeure.</p>
                        <p><strong>PT. Haifa Nida Wisata Karawang</strong> berkomitmen untuk memberikan pelayanan terbaik sesuai prinsip <em>Aman, Nyaman, dan Amanah</em>. Seluruh ketentuan ini dibuat untuk melindungi jamaah dan penyelenggara agar perjalanan ibadah berjalan lancar dan penuh keberkahan.</p>

                        <h4>I. Ketentuan Website, Aplikasi, dan Sistem Informasi</h4>
                        <p>
                            Seluruh konten pada situs web, aplikasi, dan sistem informasi kami, termasuk namun tidak terbatas pada teks, gambar, logo, desain, kode program, dan basis data, adalah milik PT. Haifa Nida Wisata Karawang atau mitra resmi kami, dan dilindungi oleh <strong>Undang-Undang Nomor 28 Tahun 2014 tentang Hak Cipta</strong>.
                            Nomor dan Tanggal Permohonan: <strong>EC002025071030, 19 Juni 2025</strong>, Nomor Pencatatan: <strong>000911291</strong>. Website ini diumumkan pertama kali pada 24 Maret 2022.
                            Dilarang menyalin, mendistribusikan, memodifikasi, atau menggunakan konten tersebut tanpa izin tertulis dari kami.
                        </p>
                        <p>
                            Dengan mengakses situs atau aplikasi kami, Anda setuju untuk tidak menggunakannya untuk tujuan yang melanggar hukum, merugikan pihak lain, atau merusak reputasi perusahaan.
                            Kami berhak membatasi atau menghentikan akses Anda apabila ditemukan pelanggaran.
                        </p>
                        <p>
                            Kami tidak bertanggung jawab atas kerugian, kerusakan, atau gangguan layanan yang diakibatkan oleh hal-hal di luar kendali kami, termasuk namun tidak terbatas pada bencana alam, gangguan teknis, serangan siber, atau tindakan pihak ketiga.
                            Untuk keamanan tambahan, Anda disarankan memiliki perlindungan asuransi perjalanan dan menggunakan perangkat yang aman.
                        </p>
                        <p>
                            Anda bertanggung jawab penuh untuk menjaga kerahasiaan akun dan kata sandi yang digunakan untuk mengakses layanan online kami.
                            Jangan membagikan informasi login kepada pihak lain.
                            Kami menerapkan langkah-langkah keamanan sesuai <strong>Undang-Undang Nomor 27 Tahun 2022 tentang Perlindungan Data Pribadi</strong> dan <strong>Undang-Undang Nomor 11 Tahun 2008 tentang Informasi dan Transaksi Elektronik</strong> beserta perubahannya.
                            Segera hubungi kami jika Anda mencurigai adanya akses tidak sah pada akun Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
