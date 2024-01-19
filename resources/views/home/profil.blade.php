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
    <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="/assets/img/logos/logo-full.png" alt="Company Logo" class="img-fluid mb-4">
                </div>
                <div class="col-lg-6">
                    <h3>PT. Haifa NIda Wisata Karawang</h3>
                    <p>
                        PT. Haifa Nida Wisata Karawang merupakan perusahaan yang berdedikasi tinggi dalam menyediakan
                        layanan perjalanan Haji, Umroh, dan wisata halal yang berkualitas. Sejak berdiri pada tahun 2007,
                        perusahaan telah menempuh perjalanan panjang selama {{ now()->year - 2007 }}
                        tahun, membangun reputasi solid sebagai
                        penyedia jasa perjalanan ibadah yang terpercaya dan berkualitas.
                    </p>
                    <p>
                        Perusahaan ini didirikan pada tahun 2007 oleh Dr. Fakhrurrozi, Lc., MA,
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
                    </p>
                    <!-- Tambahkan elemen lain sesuai dengan struktur profil perusahaan yang diinginkan -->
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <h3>Dewan Direksi</h3>
                    <ul>
                        <li>H. Dr. Fakhrurrozi, Lc.,MA. - Komisaris Utama</li>
                        <li>H. Muhammad Haitsam, S.Kom - Direktur Utama</li>
                        <li>Hj. Ria Marliana Sari, S.E - Direktur</li>
                        <!-- Tambahkan anggota tim manajemen lainnya sesuai kebutuhan -->
                    </ul>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-play">
                        <img src="/assets/img/haifa/karyawan.jpg" alt="About Images" loading="lazy">
                        <div class="about-play-content">
                            <span>Company Profile</span>
                            <h2>Nyaman, Aman dan Amanah!</h2>
                            <div class="play-on-area">
                                <a href="https://www.youtube.com/watch?v=belum-tersedia" class="play-on popup-btn"><i
                                        class='bx bx-play'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content ml-25">
                        <div class="section-title">
                            {{-- <span class="sp-color2">Produk dan Layanan</span> --}}
                            <h2>Produk dan Layanan</h2>
                            <p>
                                PT. Haifa Nida Wisata Karawang menyediakan beragam produk dan layanan berkualitas tinggi
                                untuk memenuhi
                                kebutuhan perjalanan ibadah dan wisata Anda. Dengan komitmen untuk memberikan pengalaman
                                yang tak
                                terlupakan, kami menawarkan layanan berikut:
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <ul class="about-list text-start">
                                    <li><i class='bx bxs-check-circle'></i>Biro Perjalanan Wisata</li>
                                    <li><i class='bx bxs-check-circle'></i>Penyelenggara Perjalanan Ibadah Umroh</li>
                                    <li><i class='bx bxs-check-circle'></i>Penyelenggara Ibadah Haji Khusus</li>
                                    <li><i class='bx bxs-check-circle'></i>Handling Bandara</li>
                                    <li><i class='bx bxs-check-circle'></i>Oleh-oleh dan Perlengkapan Umroh</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <ul class="about-list about-list-2 text-start">
                                    <li><i class='bx bxs-check-circle'></i>Land Arrangement</li>
                                    <li><i class='bx bxs-check-circle'></i>Tiket dan Visa</li>
                                    <li><i class='bx bxs-check-circle'></i>Bimbingan Manasik</li>
                                    <li><i class='bx bxs-check-circle'></i>Tour Guide & Tour Leader</li>
                                </ul>
                            </div>
                        </div>
                        <p class="about-content-text">
                            Kami memahami betapa pentingnya setiap detil perjalanan Anda. Dengan dukungan profesionalisme
                            dan
                            keberlanjutan layanan, PT. Haifa Nida Wisata Karawang berkomitmen untuk memberikan pengalaman
                            perjalanan
                            ibadah yang aman, nyaman, dan berkesan. Ayo nikmati setiap momen suci Anda bersama kami!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="choose-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="choose-content mr-20">
                        <div class="section-title">
                            <span class="sp-color1">Kenapa Harus Kami</span>
                            <h2>Pengalaman yang Terbukti</h2>
                            <p>
                                Perusahaan kami, PT. Haifa Nida Wisata, telah berdiri sejak tahun 2007, menorehkan jejak
                                sukses selama {{ now()->year - 2007 }} tahun pengalaman dalam industri
                                Umroh dan Haji. Keberadaan kami di Karawang
                                sebagai Travel pertama yang memiliki izin Penyelenggara Perjalanan Ibadah Umroh (PPIU)
                                menandakan komitmen kami dalam memberikan pelayanan terbaik.
                            </p>
                            <p>
                                Dengan pengalaman yang solid, kami tidak hanya sebuah agen perjalanan, tapi mitra spiritual
                                dalam setiap perjalanan ibadah Anda. Keberhasilan ini memperoleh pijakan kuat karena kami
                                adalah perusahaan dengan kantor sendiri, bukan sewa. Kejelasan ini mencerminkan integritas
                                dan komitmen kami untuk memberikan layanan terbaik tanpa kompromi.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="choose-content-card">
                                    <div class="content">
                                        <i class="flaticon-practice"></i>
                                        <h3>Pendiri yang berkualitas</h3>
                                    </div>
                                    <p>
                                        Pendiri perusahaan, H. Dr. Fakhrurrozi Lc., MA, adalah seorang alumni Universitas
                                        Islam Madinah. Dengan latar belakang ini, beliau tidak hanya memiliki pengetahuan
                                        mendalam tentang Mekkah dan Madinah, tetapi juga pengalaman sebagai pengusaha
                                        perhotelan di Arab Saudi. Keahlian ini memberikan jaminan bahwa perjalanan Anda akan
                                        diatur oleh seseorang yang mengerti kebutuhan dan kenyamanan Anda.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="choose-content-card">
                                    <div class="content">
                                        <i class="flaticon-help"></i>
                                        <h3>Tradisi Keberlanjutan dan Layanan Unggul</h3>
                                    </div>
                                    <p>
                                        PT. Haifa Nida Wisata juga bangga memiliki perusahaan catering sendiri di Arab
                                        Saudi.
                                        Pelayanan kami terbukti nyaman, aman, dan amanah dengan kualitas nomor 1. Tour
                                        leader dan manajemen profesional kami bertujuan untuk memberikan pengalaman
                                        perjalanan yang tak terlupakan, menjadikan setiap momen ibadah Anda lebih berarti
                                        dan nyaman.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="choose-content-card">
                                    <p>
                                        Pilihlah PT. Haifa Nida Wisata sebagai mitra perjalanan Haji, Umroh, dan wisata
                                        halal
                                        Anda, karena untuk kami, setiap perjalanan adalah kesempatan untuk menciptakan
                                        kenangan
                                        berharga dalam ibadah Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose-img">
                        <img src="/assets/img/haifa/anak-muda.jpg" alt="Images" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="team-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Struktur Organisasi</span>
                <h2>Anggota Kami</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-4 col-md-6">
                    <div class="team-card">
                        <img src="/assets-techex-demo/images/team/team-img1.jpg" alt="Team Images" loading="lazy">
                        <ul class="social-link">
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/?lang=en" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/" target="_blank">
                                    <i class='bx bxl-linkedin-square'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                        </ul>
                        <div class="content">
                            <h3>Adam Smith</h3>
                            <span>President & CEO</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-card">
                        <img src="/assets-techex-demo/images/team/team-img2.jpg" alt="Team Images" loading="lazy">
                        <ul class="social-link">
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/?lang=en" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/" target="_blank">
                                    <i class='bx bxl-linkedin-square'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                        </ul>
                        <div class="content">
                            <h3>Max Angles</h3>
                            <span>Manager</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-card">
                        <img src="/assets-techex-demo/images/team/team-img3.jpg" alt="Team Images" loading="lazy">
                        <ul class="social-link">
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/?lang=en" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/" target="_blank">
                                    <i class='bx bxl-linkedin-square'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                        </ul>
                        <div class="content">
                            <h3>Park Anderson</h3>
                            <span>Sales Executive</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-card">
                        <img src="/assets-techex-demo/images/team/team-img4.jpg" alt="Team Images" loading="lazy">
                        <ul class="social-link">
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/?lang=en" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/" target="_blank">
                                    <i class='bx bxl-linkedin-square'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                        </ul>
                        <div class="content">
                            <h3>Tom Shumate</h3>
                            <span>Founder</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-card">
                        <img src="/assets-techex-demo/images/team/team-img5.jpg" alt="Team Images" loading="lazy">
                        <ul class="social-link">
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/?lang=en" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/" target="_blank">
                                    <i class='bx bxl-linkedin-square'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                        </ul>
                        <div class="content">
                            <h3>Michael Evens</h3>
                            <span>Team Leader</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-card">
                        <img src="/assets-techex-demo/images/team/team-img6.jpg" alt="Team Images" loading="lazy">
                        <ul class="social-link">
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/?lang=en" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/" target="_blank">
                                    <i class='bx bxl-linkedin-square'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                        </ul>
                        <div class="content">
                            <h3>Carrie Horton</h3>
                            <span>Sales Manager</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 text-center">
                    <div class="pagination-area">
                        <a href="team.html" class="prev page-numbers">
                            <i class='bx bx-left-arrow-alt'></i>
                        </a>
                        <span class="page-numbers current" aria-current="page">1</span>
                        <a href="team.html" class="page-numbers">2</a>
                        <a href="team.html" class="page-numbers">3</a>
                        <a href="team.html" class="next page-numbers">
                            <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="security-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">IT Security & Computing</span>
                <h2>Searching for a Solution! We Provide Truly Prominent IT Solutions</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-cyber-security"></i>
                        <h3><a href="case-details.html">Business Security</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-computer"></i>
                        <h3><a href="case-details.html">Manage IT Service</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-effective"></i>
                        <h3><a href="case-details.html">Product Analysis</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-implement"></i>
                        <h3><a href="case-details.html">Analytic Solution</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-consulting"></i>
                        <h3><a href="case-details.html">Finest Quality</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-consultant"></i>
                        <h3><a href="case-details.html">Risk Management</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="brand-area-two ptb-100">
        <div class="container">
            <div class="brand-slider owl-carousel owl-theme">
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style1.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style2.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style3.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style4.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style5.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style3.png" alt="Images" loading="lazy">
                </div>
            </div>
        </div>
    </div>


    <div class="counter-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Numbers Are Talking</span>
                <h2>Let’s Check Our Business Growth and Success Story</h2>
                <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id
                    elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris Morbi accumsan ipsum velit. </p>
            </div>
            <div class="row pt-45">
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="counter-another-content">
                        <i class="flaticon-web-development"></i>
                        <h3>4205+</h3>
                        <span>Delivered Goods</span>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="counter-another-content">
                        <i class="flaticon-consulting-1"></i>
                        <h3>245+</h3>
                        <span>IT Consulting</span>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="counter-another-content">
                        <i class="flaticon-startup"></i>
                        <h3>3550+</h3>
                        <span>Fully Launched</span>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="counter-another-content">
                        <i class="flaticon-tick"></i>
                        <h3>6545+</h3>
                        <span>Project Completed</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="counter-shape">
            <div class="shape1">
                <img src="/assets-techex-demo/images/shape/shape1.png" alt="Images" loading="lazy">
            </div>
            <div class="shape2">
                <img src="/assets-techex-demo/images/shape/shape2.png" alt="Images" loading="lazy">
            </div>
        </div>
    </div> --}}
@endsection
