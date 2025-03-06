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
        <h1>Sejarah dan Profil PT. Haifa Nida Wisata Karawang</h1>

        <h2>Awal Perjalanan Sang Pendiri</h2>
        <p>PT. Haifa Nida Wisata Karawang didirikan oleh Dr. Fakhrurrozi, Lc., MA, seorang lulusan Universitas Islam Madinah
            yang memiliki visi besar dalam dunia bisnis dan pelayanan jamaah.</p>
        <p>Perjalanan beliau dimulai saat menginjakkan kaki di Madinah Al-Munawwarah untuk menempuh pendidikan tinggi.
            Sebelum diterima di universitas, beliau harus menunggu satu tahun, yang dimanfaatkannya dengan bekerja di sebuah
            toko emas milik pengusaha Arab. Dengan keterampilan manajemen yang baik, bisnis tersebut berkembang pesat hingga
            memiliki beberapa cabang.</p>
        <p>Setelah diterima di Universitas Islam Madinah, beliau memutuskan untuk fokus pada pendidikan. Namun, menyadari
            pentingnya membangun kemandirian ekonomi, beliau mulai bekerja sebagai tour guide bagi jamaah Umroh dan Haji.
            Seiring berjalannya waktu, ia juga terjun ke bisnis perhotelan dengan menyewa satu lantai hotel, yang kemudian
            berkembang hingga mampu menyewa satu gedung penuh. Hotel yang dikelolanya bahkan menjadi pilihan menginap bagi
            tokoh nasional seperti Aburizal Bakrie, Megawati Soekarnoputri, dan Gus Dur selama berada di Madinah.</p>
        <p>Keberhasilannya dalam bisnis membuatnya tetap menjunjung tinggi prinsip amanah. Salah satunya ditunjukkan dengan
            pelunasan hutang modal kepada mantan majikannya, meskipun telah diikhlaskan. Setelah sukses di sektor
            perhotelan, beliau mulai berinvestasi dalam agribisnis dan properti, serta mendirikan usaha di bidang kuliner.
        </p>

        <h2>Kelahiran Catering Al-Haidari dan Bisnis Kuliner</h2>
        <p>Keberhasilan di dunia bisnis semakin diperkuat dengan didirikannya Catering Al-Haidari, yang menjadi catering
            terkemuka di Kota Madinah. Catering ini melayani berbagai hotel bintang 3, 4, dan 5, serta bekerja sama dengan
            agen perjalanan besar, termasuk First Travel.</p>
        <p>Selain untuk jamaah Indonesia, Catering Al-Haidari juga menyediakan makanan bagi jamaah dari Turki, Thailand,
            India, dan negara lainnya.</p>
        <p>Keberhasilan catering ini mendorong beliau untuk mendirikan Restoran Indonesia Pesanggrahan di Madinah serta
            Bakso Si Doel, restoran bakso yang viral saat musim haji di Hotel Royal Andalus, Madinah. Nama "Si Doel" sendiri
            terinspirasi dari karakter Si Doel Anak Betawi, mengingat kedekatan beliau dengan Rano Karno. Namun, konsepnya
            lebih menggambarkan identitas Karawang, daerah asal beliau.</p>

        <h2>Lahirnya PT. Haifa Nida Wisata Karawang</h2>
        <p>Dengan pengalaman luas di bidang perhotelan dan catering, Dr. Fakhrurrozi melihat peluang untuk mengoptimalkan
            bisnis yang telah ada dengan mendirikan biro perjalanan sendiri. Pada tahun 2007, lahirlah PT. Haifa Nida
            Wisata, yang kemudian mendapatkan izin sebagai Biro Perjalanan Wisata.</p>
        <p>Setelah menyelesaikan studi S3 pada tahun 2008, beliau kembali ke Indonesia dan mulai mengembangkan bisnis travel
            secara lebih serius. Pada tahun 2010, perusahaan mengajukan izin Penyelenggara Perjalanan Ibadah Umrah (PPIU).
            Namun, akibat kendala administratif, perusahaan harus mengganti nama menjadi PT. Haifa Nida Wisata Karawang pada
            24 Agustus 2011.</p>
        <p>Pada tahun 2012, perusahaan resmi memperoleh izin PPIU setelah melalui proses selama 5 tahun. Dalam perpanjangan
            izin PPIU tahun 2017, Haifa Nida Wisata mendapatkan akreditasi B, yang kemudian diperbarui kembali pada tahun
            2022. Saat ini, dengan adanya perubahan direksi, proses akreditasi terbaru sedang dalam tahap penyelesaian dan
            diperkirakan akan rampung dalam waktu dekat, InsyaAllah.</p>

        <h2>Keunggulan dan Legalitas</h2>
        <p>Sebagai biro perjalanan haji dan umroh pertama di Karawang yang memiliki izin resmi PPIU, PT. Haifa Nida Wisata
            Karawang menjamin keberangkatan jamaah dengan legalitas dan kredibilitas tinggi.</p>
        <p>Perusahaan juga tengah dalam proses pengajuan izin Penyelenggara Ibadah Haji Khusus (PIHK) serta International
            Air Transport Association (IATA) untuk meningkatkan layanan kepada para jamaah.</p>
        <p>Untuk memastikan kualitas pelayanan terbaik, perusahaan memiliki 10 Tour Leader bersertifikasi BNSP, serta
            didukung oleh Tour Guide, Pembimbing, dan Muthowif/Muthowifah yang berpengalaman dalam membimbing jamaah selama
            perjalanan ibadah.</p>

        <h2>Jaringan Usaha dan Lokasi Kantor</h2>
        <p>Sejak berdiri, PT. Haifa Nida Wisata Karawang telah melayani lebih dari 100.000 jamaah umroh dari seluruh
            Indonesia.</p>
        <p>Kantor pusat perusahaan berlokasi di samping Islamic Center Al Jihad, Bypass Jalan R.A. Kartini No. 1, Kelurahan
            Karangpawitan, Karawang.</p>
        <p>Nama Haifa Nida Wisata sendiri merupakan singkatan dari nama anak-anak pendiri, yaitu Haitsam, Iyad, Aufa,
            Nidzom, dan Dafiq. Filosofi ini mencerminkan nilai keluarga, keberkahan, dan tanggung jawab yang menjadi prinsip
            utama dalam setiap layanan yang diberikan.</p>
        <p>Selain menjalankan perusahaan, Dr. Fakhrurrozi juga aktif sebagai Ketua Komunitas Pengusaha Muslim Indonesia
            (KPMI) Karawang, yang bertujuan membimbing para pengusaha muslim dalam mengembangkan bisnis berbasis nilai-nilai
            Islam.</p>

        <h2>Komitmen Kami</h2>
        <p>PT. Haifa Nida Wisata Karawang berkomitmen untuk selalu memberikan pelayanan terbaik dengan prinsip:</p>
        <ul>
            <li><strong>Aman</strong> → Legalitas dan kepercayaan jamaah adalah prioritas utama.</li>
            <li><strong>Nyaman</strong> → Menyediakan layanan terbaik dengan fasilitas berkualitas.</li>
            <li><strong>Amanah</strong> → Menjalankan bisnis dengan integritas dan tanggung jawab.</li>
        </ul>
        <p>Kami hadir untuk memastikan perjalanan ibadah Anda semakin berkesan, nyaman, dan penuh berkah.</p>

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
