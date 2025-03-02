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

    <!-- SEJARAH PERUSAHAAN -->
    <div class="container pb-100">
        <h2 class="text-center mb-5">Sejarah Perusahaan</h2>
        <p><strong>Sejarah dan Profil PT. Haifa Nida Wisata Karawang</strong></p>

        <p><strong>Awal Perjalanan Sang Pendiri</strong></p>

        <p>Pendiri PT. Haifa Nida Wisata Karawang, Dr. Fakhrurrozi, Lc., MA, pertama kali menginjakkan kaki di Madinah
            Al-Munawwarah untuk menempuh pendidikan di Universitas Islam Madinah. Setelah mendaftar, beliau harus menunggu
            satu tahun untuk pengumuman penerimaan mahasiswa. Selama masa penantian tersebut, beliau bekerja di toko emas
            milik orang Arab. Berkat manajemen yang baik, beliau sukses mengembangkan bisnis tersebut hingga membuka
            beberapa cabang. Setelah dinyatakan diterima di Universitas Islam Madinah, beliau pun memutuskan untuk berhenti
            mengelola toko emas.</p>

        <p>Sembari berkuliah, beliau mulai menyadari bahwa selepas lulus, ia akan kembali ke Indonesia tanpa memiliki modal
            atau relasi bisnis yang kuat. Dengan pemikiran visioner, beliau mulai bekerja sebagai tour guide untuk jamaah
            Umroh dan Haji. Tidak berhenti di sana, beliau juga mencoba peruntungan di bidang perhotelan, dengan menyewa
            satu lantai hotel. Bisnisnya berkembang pesat hingga akhirnya ia berhasil menyewa satu gedung penuh. Hotel yang
            dikelolanya bahkan pernah menjadi pilihan Aburizal Bakrie, Megawati Soekarnoputri, dan Gus Dur selama di
            Madinah.</p>

        <p>Seiring dengan meningkatnya kondisi ekonomi, beliau memutuskan untuk melunasi hutang modal kepada mantan
            majikannya di toko emas, meskipun sang majikan telah mengikhlaskan hutang tersebut. Setelah sukses di dunia
            perhotelan, beliau mulai berinvestasi dengan membeli aset seperti sawah, membangun rumah, dan mendirikan bisnis
            kuliner.</p>

        <p><strong>Kelahiran Catering Al-Haidari dan Bisnis Kuliner</strong></p>

        <p>Kesuksesan di dunia bisnis berlanjut dengan didirikannya Catering Al-Haidari, yang kemudian menjadi catering
            nomor satu di Kota Madinah. Catering ini mensuplai makanan ke berbagai hotel bintang 3, 4, dan 5, serta melayani
            berbagai travel besar, salah satunya First Travel. Tidak hanya untuk jamaah Indonesia, Catering Al-Haidari juga
            menyediakan makanan untuk jamaah dari Turki, Thailand, India, dan negara lainnya.</p>

        <p>Dari kesuksesan bisnis catering, beliau kemudian mendirikan Restoran Indonesia Pesanggrahan di Madinah serta
            Bakso Si Doel, restoran bakso viral yang dibuka saat musim Haji di Hotel Royal Andalus, Madinah. Nama Bakso Si
            Doel terinspirasi dari karakter Si Doel Anak Betawi, karena kedekatan beliau dengan Rano Karno. Namun, konsepnya
            bukan tentang anak Betawi, melainkan anak Karawang, karena beliau adalah putra asli Karawang.</p>

        <p><strong>Lahirnya PT. Haifa Nida Wisata Karawang</strong></p>

        <p>Melihat perkembangan bisnisnya, sang pendiri menyadari bahwa ia telah memiliki dua elemen penting dalam industri
            perjalanan Haji dan Umroh, yaitu perhotelan dan catering. Dengan pemikiran strategis, beliau berinisiatif untuk
            mendirikan perusahaan travel sendiri agar dapat mengoptimalkan bisnis yang telah ada. Maka, pada tahun 2007,
            berdirilah PT. Haifa Nida Wisata yang mendapatkan izin sebagai Biro Perjalanan Wisata.</p>

        <p>Pada tahun 2008, beliau menyelesaikan program S3 dan meraih gelar doktor sebelum akhirnya kembali ke Indonesia.
            Kemudian, pada tahun 2010, PT. Haifa Nida Wisata mengajukan izin PPIU (Penyelenggara Perjalanan Ibadah Umrah)
            untuk pertama kalinya. Namun, akibat ulah petugas yang tidak amanah, perusahaan mengalami kendala administratif.
            Hingga akhirnya, pada 24 Agustus 2011, perusahaan harus mengganti nama menjadi PT. Haifa Nida Wisata Karawang.
            Izin PPIU pertama berhasil diperoleh pada tahun 2012, setelah menunggu selama 5 tahun.</p>

        <p>Pada perpanjangan izin PPIU tahun 2017, Haifa Nida Wisata mendapatkan akreditasi B, yang kemudian diperbarui
            kembali pada tahun 2022. Saat ini, karena adanya perubahan direksi, proses akreditasi terbaru sedang dalam tahap
            penyelesaian, dan diperkirakan akan selesai dalam bulan ini, InsyaAllah.</p>

        <p><strong>Keunggulan dan Legalitas</strong></p>

        <p>Sebagai travel pertama di Karawang yang memiliki izin resmi PPIU, Haifa Nida Wisata Karawang legal dan terpercaya
            dalam memberangkatkan jamaah Umroh dan Haji. Perusahaan juga sedang dalam proses pengajuan izin PIHK
            (Penyelenggara Ibadah Haji Khusus) dan IATA (International Air Transport Association) untuk semakin meningkatkan
            kualitas layanan.</p>

        <p>Untuk memastikan pelayanan terbaik, perusahaan memiliki 10 Tour Leader tersertifikasi BNSP, serta didukung oleh
            Tour Guide, Pembimbing, dan Muthowif/Muthowifah yang berpengalaman.</p>

        <p><strong>Jaringan Usaha dan Lokasi Kantor</strong></p>

        <p>Sejak berdiri, Haifa Nida Wisata telah melayani lebih dari 100.000 jamaah Umroh dari Indonesia. Kantor pusat
            perusahaan berlokasi di samping Islamic Center Al Jihad, Bypass Jalan R.A. Kartini No. 1, Kelurahan
            Karangpawitan, Karawang.</p>

        <p>Nama Haifa Nida Wisata sendiri merupakan singkatan dari nama anak-anak pendiri, yaitu Haitsam, Iyad, Aufa,
            Nidzom, dan Dafiq. Filosofi ini mencerminkan nilai keluarga, keberkahan, dan tanggung jawab yang menjadi prinsip
            utama dalam setiap layanan yang diberikan.</p>

        <p>Selain menjadi CEO PT. Haifa Nida Wisata Karawang, Dr. Fakhrurrozi juga aktif sebagai Ketua Komunitas Pengusaha
            Muslim Indonesia (KPMI) Karawang, yang membimbing para pengusaha muslim dalam mengembangkan bisnis yang
            berlandaskan nilai-nilai Islam.</p>

        <p><strong>Komitmen Kami</strong></p>

        <p>PT. Haifa Nida Wisata Karawang berkomitmen untuk selalu memberikan pelayanan terbaik dengan prinsip Aman, Nyaman,
            dan Amanah. Kami hadir untuk memastikan perjalanan ibadah Anda semakin berkesan dan penuh berkah.</p>

    </div>

    <!-- KEUNGGULAN PERUSAHAAN -->
    <div class="container pb-100">
        <h2 class="text-center mb-5">Keunggulan Kami</h2>
        <div class="row">
            <div class="col-lg-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="bx bx-shield-quarter bx-lg text-primary"></i>
                        <h5 class="card-title mt-3">Keamanan & Kenyamanan</h5>
                        <p class="card-text">Kami menjamin perjalanan ibadah yang aman dengan layanan premium.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="bx bx-group bx-lg text-primary"></i>
                        <h5 class="card-title mt-3">Pembimbing Berpengalaman</h5>
                        <p class="card-text">Dibimbing oleh ustadz dan tenaga profesional yang berpengalaman.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="bx bx-money bx-lg text-primary"></i>
                        <h5 class="card-title mt-3">Harga Kompetitif</h5>
                        <p class="card-text">Paket perjalanan dengan harga terbaik tanpa mengurangi kualitas layanan.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="bx bx-hotel bx-lg text-primary"></i>
                        <h5 class="card-title mt-3">Hotel Dekat Masjid</h5>
                        <p class="card-text">Akomodasi terbaik di sekitar Masjidil Haram dan Masjid Nabawi.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="bx bx-plane bx-lg text-primary"></i>
                        <h5 class="card-title mt-3">Penerbangan Langsung</h5>
                        <p class="card-text">Penerbangan langsung dari Jakarta ke Jeddah atau Madinah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
