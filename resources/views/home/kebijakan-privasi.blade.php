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
    <div class="content-area pt-30 pb-70">
        <div class="container">
            {{-- <div class="section-title text-center">
                <span class="sp-color2">Privacy Policy</span>
                <h2>Techex Privacy Policy</h2>
            </div> --}}
            <div class="row pt-45">
                <div class="col-lg-12">
                    <!-- Pengumpulan Informasi -->
                    <div class="single-content">
                        <h3>Pengumpulan Informasi</h3>
                        <p>
                            Kami mengumpulkan informasi pribadi yang Anda berikan saat mendaftar perjalanan umroh, seperti nama, alamat, nomor paspor, nomor telepon, alamat email, dan dokumen identitas lainnya. Informasi ini diperlukan untuk memproses pendaftaran, pengurusan visa, dan penyediaan layanan perjalanan ibadah.
                        </p>
                        <p>
                            Kami juga dapat mengumpulkan data non-pribadi, seperti riwayat pemesanan, preferensi perjalanan, dan interaksi dengan situs web kami, yang digunakan untuk meningkatkan layanan dan pengalaman pengguna.
                        </p>
                    </div>

                    <!-- Kebijakan Privasi -->
                    <div class="single-content">
                        <h3>Kebijakan Privasi</h3>
                        <p>
                            Kami berkomitmen menjaga kerahasiaan dan keamanan data pribadi Anda sesuai dengan ketentuan <strong>Undang-Undang No. 27 Tahun 2022 tentang Perlindungan Data Pribadi (UU PDP)</strong> serta <strong>UU No. 8 Tahun 1999 tentang Perlindungan Konsumen</strong>.
                        </p>
                        <p>
                            Informasi pribadi yang Anda berikan hanya akan digunakan untuk keperluan internal perusahaan, termasuk pengurusan perjalanan dan komunikasi layanan. Kami tidak akan menjual, menyewakan, atau membagikan data Anda kepada pihak ketiga tanpa persetujuan tertulis, kecuali diwajibkan oleh hukum.
                        </p>
                    </div>

                    <!-- Pemrosesan dan Penggunaan Data -->
                    <div class="single-content">
                        <h3>Pemrosesan dan Penggunaan Data Pribadi</h3>
                        <p>
                            Data Anda digunakan untuk memfasilitasi kebutuhan perjalanan umrah, termasuk pemesanan tiket, visa, akomodasi, dan layanan pendukung lainnya. Kami juga dapat mengirimkan informasi penting terkait perjalanan atau penawaran terbaru, berdasarkan persetujuan Anda.
                        </p>
                        <p>
                            Anda memiliki hak untuk mengakses, memperbaiki, menghapus, atau menarik persetujuan atas pemrosesan data pribadi Anda dengan menghubungi kami melalui kanal resmi.
                        </p>
                    </div>

                    <!-- Pembagian Data kepada Pihak Ketiga -->
                    <div class="single-content">
                        <h3>Pembagian Data dengan Mitra Layanan</h3>
                        <p>
                            Dalam menjalankan layanan, kami dapat berbagi informasi Anda kepada mitra terpercaya seperti maskapai, hotel, atau penyedia visa. Semua mitra wajib menjaga kerahasiaan dan menggunakan data sesuai dengan kebijakan privasi kami serta regulasi perlindungan data.
                        </p>
                    </div>

                    <!-- Perlindungan Data -->
                    <div class="single-content">
                        <h3>Perlindungan Data</h3>
                        <p>
                            Kami menerapkan langkah-langkah keamanan teknis dan organisasi, seperti enkripsi, firewall, dan sistem autentikasi untuk mencegah akses tidak sah terhadap data pribadi. Akses ke data dibatasi hanya kepada staf berwenang yang telah menandatangani perjanjian kerahasiaan.
                        </p>
                        <p>
                            Data akan disimpan selama diperlukan untuk memenuhi tujuan pengumpulan atau sesuai kewajiban hukum, dan akan dihapus atau dianonimkan secara aman setelahnya.
                        </p>
                    </div>

                    <!-- Pernyataan Penyangkalan -->
                    <div class="single-content">
                        <h3>Pernyataan Penyangkalan</h3>
                        <p>
                            Meskipun kami telah menerapkan sistem keamanan terbaik, tidak ada sistem yang 100% aman dari ancaman siber. Anda bertanggung jawab untuk menjaga informasi login dan perangkat pribadi Anda. Kami tidak bertanggung jawab atas kebocoran data yang disebabkan oleh kelalaian pengguna atau serangan di luar kendali kami.
                        </p>
                    </div>

                    <!-- Penggunaan Cookies -->
                    <div class="single-content">
                        <h3>Penggunaan Cookies</h3>
                        <p>
                            Situs kami menggunakan cookies untuk menyimpan preferensi pengguna dan menganalisis aktivitas pengunjung. Cookies tidak menyimpan data sensitif secara langsung. Anda dapat menonaktifkan cookies melalui pengaturan browser.
                        </p>
                    </div>

                    <!-- Persetujuan Pengguna -->
                    <div class="single-content">
                        <h3>Persetujuan Anda</h3>
                        <p>
                            Dengan menggunakan layanan kami dan mengakses situs ini, Anda menyetujui pengumpulan dan penggunaan informasi sebagaimana dijelaskan dalam kebijakan ini. Anda juga menyetujui pembaruan kebijakan yang akan kami umumkan sewaktu-waktu.
                        </p>
                    </div>

                    <!-- Dasar Hukum dan Penyelesaian Sengketa -->
                    <div class="single-content">
                        <h3>Dasar Hukum dan Penyelesaian Sengketa</h3>
                        <p>
                            Kebijakan ini tunduk pada hukum yang berlaku di Republik Indonesia, termasuk namun tidak terbatas pada:
                        </p>
                        <ul>
                            <li>Undang-Undang No. 27 Tahun 2022 tentang Perlindungan Data Pribadi</li>
                            <li>Undang-Undang No. 8 Tahun 1999 tentang Perlindungan Konsumen</li>
                            <li>Peraturan Menteri Kominfo No. 20 Tahun 2016 tentang Perlindungan Data Pribadi dalam Sistem Elektronik</li>
                            <li>Undang-Undang No. 11 Tahun 2008 tentang Informasi dan Transaksi Elektronik (ITE)</li>
                        </ul>
                        <p>
                            Segala perselisihan yang timbul terkait kebijakan ini akan diselesaikan secara musyawarah. Apabila tidak tercapai, maka akan diselesaikan melalui jalur hukum sesuai dengan yurisdiksi yang berlaku.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
