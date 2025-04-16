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
        <h1 class="text-center mb-5">Sejarah dan Profil PT. Haifa Nida Wisata Karawang</h1>

        <h2>1. Awal Perjalanan Sang Pendiri</h2>
        <p>PT. Haifa Nida Wisata Karawang didirikan oleh Dr. Fakhrurrozi, Lc., MA, alumni Universitas Islam Madinah yang
            memiliki visi besar dalam pelayanan jamaah dan bisnis perjalanan ibadah.</p>
        <p>Perjalanan beliau dimulai sejak menjejakkan kaki di Madinah untuk menempuh pendidikan tinggi. Sambil menunggu
            diterima di universitas, beliau bekerja di sebuah toko emas milik pengusaha Arab. Berkat keahliannya dalam
            manajemen, usaha tersebut berkembang hingga membuka beberapa cabang.</p>
        <p>Setelah resmi menjadi mahasiswa, beliau tetap menjaga semangat kemandirian ekonomi dengan bekerja sebagai tour
            guide bagi jamaah Umroh dan Haji. Usahanya berkembang hingga ke sektor perhotelan, menyewa satu lantai hotel,
            dan kemudian seluruh gedung. Hotel yang dikelolanya menjadi tempat menginap bagi tokoh nasional seperti Aburizal
            Bakrie, Megawati Soekarnoputri, dan Gus Dur.</p>
        <p>Sikap amanah beliau tercermin dalam pelunasan utang modal kepada mantan majikan, meskipun telah diikhlaskan.
            Setelah sukses di bidang perhotelan, beliau melebarkan sayap ke sektor agribisnis, properti, dan kuliner.</p>

        <h2>2. Kelahiran Catering Al-Haidari dan Bisnis Kuliner</h2>
        <p>Keberhasilan beliau dalam dunia bisnis diperkuat dengan mendirikan <strong>Catering Al-Haidari</strong>, yang
            menjadi salah satu penyedia makanan terkemuka di Kota Madinah. Catering ini melayani hotel bintang 3 hingga 5
            serta berbagai travel haji dan umrah, termasuk First Travel.</p>
        <p>Selain jamaah Indonesia, Catering Al-Haidari juga melayani jamaah asal Turki, Thailand, dan India. Beliau
            kemudian membuka <strong>Restoran Indonesia Pesanggrahan</strong> dan <strong>Bakso Si Adoel</strong> di Hotel
            Royal Andalus, Madinah—yang viral saat musim haji. Nama 'Si Adoel' terinspirasi dari Si Doel Anak Betawi dan
            merepresentasikan semangat Karawang.</p>

        <h2>3. Berdirinya PT. Haifa Nida Wisata Karawang</h2>
        <p>Berbekal pengalaman di sektor perhotelan dan catering, pada tahun 2007 beliau mendirikan PT. Haifa Nida Wisata.
            Setelah menyelesaikan studi S3 pada 2008, beliau pulang ke Indonesia dan mengembangkan bisnis travel lebih
            serius. Pada 2010, perusahaan mengajukan izin sebagai Penyelenggara Perjalanan Ibadah Umrah (PPIU).</p>
        <p>Karena kendala administratif, nama perusahaan diubah menjadi <strong>PT. Haifa Nida Wisata Karawang</strong> pada
            24 Agustus 2011. Izin resmi PPIU diperoleh pada tahun 2012. Dalam perpanjangan izin tahun 2017, Haifa Nida
            mendapatkan <strong>akreditasi B</strong> dan pada 2025 berhasil meraih <strong>akreditasi A</strong>.</p>

        <h2>4. Keunggulan dan Legalitas</h2>
        <p>Haifa Nida Wisata merupakan biro perjalanan haji dan umrah pertama di Karawang yang berizin resmi dan
            terakreditasi. Perusahaan juga tengah memproses izin <strong>Penyelenggara Ibadah Haji Khusus (PIHK)</strong>
            serta <strong>keanggotaan IATA</strong>.</p>
        <p>Perusahaan memiliki 10 Tour Leader bersertifikasi BNSP, Tour Guide profesional, serta pembimbing dan
            Muthowif/Muthowifah yang berpengalaman.</p>

        <h2>5. Jaringan Usaha dan Lokasi Kantor</h2>
        <p>Sejak berdiri, lebih dari <strong>100.000 jamaah</strong> telah diberangkatkan ke tanah suci oleh PT. Haifa Nida
            Wisata Karawang. Kantor pusat kami berlokasi di samping Islamic Center Al Jihad, Jl. R.A. Kartini No. 1,
            Kelurahan Karangpawitan, Karawang.</p>
        <p>Nama “Haifa Nida” merupakan singkatan dari nama anak-anak pendiri: <strong>Haitsam, Iyad, Aufa, Nidzom, dan
                Dafiq</strong>. Filosofi ini mencerminkan nilai keluarga, keberkahan, dan tanggung jawab dalam pelayanan.
        </p>
        <p>Selain menjalankan perusahaan, Dr. Fakhrurrozi juga aktif sebagai Ketua Komunitas Pengusaha Muslim Indonesia
            (KPMI) Karawang, untuk membina pengusaha muslim berbasis nilai-nilai Islam.</p>

        <h2>6. Komitmen Kami</h2>
        <p>PT. Haifa Nida Wisata Karawang berkomitmen memberikan layanan terbaik dengan prinsip:</p>
        <ul>
            <li><strong>Aman</strong> – Legalitas dan kepercayaan jamaah adalah prioritas utama.</li>
            <li><strong>Nyaman</strong> – Layanan terbaik dengan fasilitas berkualitas.</li>
            <li><strong>Amanah</strong> – Dijalankan dengan integritas dan tanggung jawab.</li>
            <li><strong>Profesional</strong> – Tim bersertifikasi dan berpengalaman.</li>
            <li><strong>Berkah</strong> – Menjadikan perjalanan ibadah penuh nilai spiritual.</li>
        </ul>
        <p>Kami hadir untuk memastikan perjalanan ibadah Anda lebih khusyu’, nyaman, dan bermakna.</p>
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
