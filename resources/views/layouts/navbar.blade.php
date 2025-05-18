<header class="top-header top-header-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6">
                <div class="top-head-left">
                    <div class="top-contact">
                        {{-- <h3>Support By : <a href="tel:+1(212)-255-5511">+1 (212) 255-5511</a></h3> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="top-header-right">
                    <div class="top-header-social">
                        <ul>
                            <li>
                                <a href="https://www.tiktok.com/@haifanidaofficial" target="_blank">
                                    <i class='bx bxl-tiktok'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/haifanidaofficial" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://x.com/haifanidaoffice" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/pt-haifa-nida-wisata/" target="_blank">
                                    <i class='bx bxl-linkedin-square'></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://instagram.com/haifanidaofficial" target="_blank">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="language-list">
                        <select class="language-list-item">
                            <option>English</option>
                            <option>العربيّة</option>
                            <option>Deutsch</option>
                            <option>Português</option>
                            <option>简体中文</option>
                        </select>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</header>


<div class="navbar-area">

    <div class="mobile-nav">
        <a href="/" class="logo">
            <img src="/assets/img/logos/logo-lanskap-2.png" style="max-height: 60px;" class="logo-one" alt="Logo">
            <img src="/assets/img/logos/logo-lanskap-2.png" style="max-height: 60px;" class="logo-two" alt="Logo">
        </a>
    </div>

    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="/">
                    <img src="/assets/img/logos/logo-lanskap-2.png" style="max-height: 60px;" class="logo-one"
                        alt="Logo">
                    <img src="/assets/img/logos/logo-lanskap-2.png" style="max-height: 60px;" class="logo-two"
                        alt="Logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link active">
                                Home
                                <i class='bx bx-caret-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="index.html" class="nav-link active">
                                        Home One
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index-2.html" class="nav-link">
                                        Home Two
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index-3.html" class="nav-link">
                                        Home Three
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index-4.html" class="nav-link">
                                        Home Four <span>(New)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index-5.html" class="nav-link">
                                        Home Five <span>(New)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index-6.html" class="nav-link">
                                        Home Six <span>(New)</span>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Layanan Kami
                                <i class='bx bx-caret-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="/umroh" class="nav-link">
                                        Umroh
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/haji" class="nav-link">
                                        Haji
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/wisata-halal" class="nav-link">
                                        Wisata Halal
                                    </a>
                                </li>
                                @can('admin')
                                    <li class="nav-item">
                                        <a href="/admin/index" class="nav-link">
                                            Halaman Admin
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Konten Kami
                                <i class='bx bx-caret-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="/galeri" class="nav-link">
                                        Galeri & Testimoni
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.karawangmengaji.com/" class="nav-link">
                                        Artikel
                                    </a>
                                    {{-- <a href="/artikel" class="nav-link">
                                        Artikel
                                    </a> --}}
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.karawangmengaji.com/" class="nav-link" target="_blank">
                                        Kajian
                                    </a>
                                    {{-- <a href="/kajian" class="nav-link">
                                        Kajian
                                    </a> --}}
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Tentang Kami
                                <i class='bx bx-caret-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="/profil" class="nav-link">
                                        Profil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/sejarah" class="nav-link">
                                        Sejarah
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/visi-misi" class="nav-link">
                                        Visi dan Misi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/kantor-kami" class="nav-link">
                                        Kantor Perwakilan, Cabang dan Agen
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Bantuan
                                <i class='bx bx-caret-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="/kontak-kami" class="nav-link">
                                        Kontak Kami
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/kuesioner" class="nav-link">
                                        Kuesioner Kepuasan Jema'ah
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/keluhan" class="nav-link">
                                        Pengaduan & Keluhan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/faq" class="nav-link">
                                        FAQ
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/panduan" class="nav-link">
                                        Panduan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/syarat-ketentuan" class="nav-link">
                                        Syarat & Ketentuan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/kebijakan-privasi" class="nav-link">
                                        Kebijakan Privasi
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <div class="nav-side d-display">
                            <div class="nav-side-item">
                                <div class="search-box">
                                    <i class='bx bx-search'></i>
                                </div>
                            </div>
                            <div class="nav-side-item">
                                @guest
                                    <div class="get-btn">
                                        <a href="/login" class="default-btn btn-bg-two border-radius-50">Login
                                            <i class='bx bx-chevron-right'></i></a>
                                    </div>
                                @endguest
                                @auth
                                    <!-- MODIFIED-- -->
                                    <!-- <div class="get-btn">
                                        <a href="/logout" class="default-btn btn-bg-two border-radius-50">Logout
                                            <i class='bx bx-chevron-right'></i></a>
                                    </div> -->
                                    <li class="nav-item" style="padding-bottom: -10px">
                                        <a href="" class="btn p-0 border-0 bg-transparent">
                                            <img src="{{ Auth::user()->profile_picture
                                            ? asset('storage/user-photo/' . Auth::user()->profile_picture)
                                            : asset('storage/image-not-found-scaled.png') }}"
                                            alt="Profile"
                                            class="rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a href="/member/profile" class="nav-link">
                                                    Profile
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="">
                                                    Perjalanan Saya
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/logout">
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- --MODIFIED -->    
                                @endauth
                            </div>
                        </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="side-nav-responsive">
        <div class="container-max">
            <div class="dot-menu">
                <div class="circle-inner">
                    <div class="in-circle circle-one"></div>
                    <div class="in-circle circle-two"></div>
                    <div class="in-circle circle-three"></div>
                </div>
            </div>
            <div class="container">
                <div class="side-nav-inner">
                    <div class="side-nav justify-content-center align-items-center">
                        <div class="side-nav-item nav-side">
                            <div class="search-box">
                                <i class='bx bx-search'></i>
                            </div>
                            <div class="get-btn">
                                <a href="/login" class="default-btn btn-bg-two border-radius-50">Login
                                    <i class='bx bx-chevron-right'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="search-overlay">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="search-layer"></div>
            <div class="search-layer"></div>
            <div class="search-layer"></div>
            <div class="search-close">
                <span class="search-close-line"></span>
                <span class="search-close-line"></span>
            </div>
            <div class="search-form">
                <form>
                    <input type="text" class="input-search" placeholder="Search here...">
                    <button type="submit"><i class='bx bx-search'></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
