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
                                {{-- <li class="nav-item">
                                    <a href="/kantor-kami" class="nav-link">
                                        Kantor Perwakilan, Cabang dan Agen
                                    </a>
                                </li> --}}
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
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('member.daftar-keberangkatan') }}" class="nav-link">
                                    Daftar Keberangkatan
                                </a>
                            </li>
                        @endauth
                        <div class="nav-side d-display">
                            {{-- <div class="nav-side-item">
                                <div class="search-box">
                                    <i class='bx bx-search'></i>
                                </div>
                            </div> --}}
                            <div class="nav-side-item">
                                @guest
                                    <div class="get-btn">
                                        <a href="/login" class="default-btn btn-bg-two border-radius-50">Login
                                            <i class='bx bx-chevron-right'></i></a>
                                    </div>
                                @endguest
                                @auth
                                    <div class="nav-side-item d-flex align-items-center">
                                        <!-- Daftar Keberangkatan Link -->

                                        <!-- Profile Dropdown -->
                                        <li class="nav-item profile-dropdown">
                                            <a href="#" class="btn p-0 border-0 bg-transparent">
                                                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('storage/user-photo/not-found.jpg') }}"
                                                    alt="Profile" class="rounded-circle"
                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                            </a>
                                            <ul class="dropdown-menu profile-menu">
                                                <li class="nav-item">
                                                    <a href="/member/profile" class="nav-link">
                                                        Profile
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('member.riwayat-perjalanan') }}" class="nav-link">
                                                        Riwayat Perjalanan
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="/logout" class="nav-link">
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </div>
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
                            {{-- modified --}}
                            {{-- <div class="search-box">
                                <i class='bx bx-search'></i>
                            </div> --}}
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

<style>
    /* Profile Dropdown Styling */
    .profile-dropdown {
        min-width: 65px;
        /* Sesuaikan dengan ukuran gambar */
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .profile-dropdown .dropdown-menu.profile-menu {
        /* position: absolute; */
        top: 100%;
        right: 0;
        left: auto;
        transform: none;
        min-width: 180px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 10px 0;
        z-index: 1000;
    }

    .profile-dropdown .dropdown-menu.profile-menu .nav-item {
        padding: 0;
    }

    .profile-dropdown .dropdown-menu.profile-menu .nav-link {
        color: #333;
        font-size: 14px;
        padding: 8px 20px;
        transition: background-color 0.2s ease;
    }

    .profile-dropdown .dropdown-menu.profile-menu .nav-link:hover {
        background-color: #f5f5f5;
        color: #000;
    }

    /* Dropdown arrow positioning fix */
    .navbar-nav .nav-item {
        display: flex;
        align-items: center;
        white-space: nowrap;
        /* Prevent text wrapping */
    }

    .navbar-nav .nav-link {
        display: flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
        /* Prevent text wrapping */
    }

    .navbar-nav .nav-link i.bx-caret-down {
        font-size: 16px;
        line-height: 1;
    }

    /* Main Navigation Layout Fixes */
    .main-nav .navbar .navbar-nav {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        /* Prevent items from wrapping to next line */
        margin: 0;
    }

    .main-nav .navbar-nav .nav-link {
        padding: 8px 12px;
        /* Add consistent padding */
    }

    /* Ensure no text breaks in navigation */
    .main-nav .navbar {
        flex-wrap: nowrap;
    }

    .nav-side {
        display: flex;
        align-items: center;
        margin-left: auto;
        white-space: nowrap;
    }

    /* Search box styling
.search-box {
    cursor: pointer;
    margin-right: 10px;
}

/* .search-box i {
    font-size: 20px;
} */

    /* Search overlay z-index fix */
    /* .search-overlay {
    z-index: 99999;
} */

    /* Keep regular dropdowns working */
    .navbar-nav .dropdown-menu:not(.profile-menu) {
        left: 0;
        transform: none;
    }

    /* Button styling consistency */
    .nav-side-item .default-btn {
        font-size: 14px;
        padding: 8px 15px;
        margin-left: 15px;
    }
</style>

<!-- Fix search functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchBox = document.querySelector('.search-box');
        const searchOverlay = document.querySelector('.search-overlay');
        const searchInput = document.querySelector('.search-overlay input');
        const searchClose = document.querySelector('.search-close');

        if (searchBox && searchOverlay) {
            searchBox.addEventListener('click', function() {
                searchOverlay.classList.add('search-overlay-active');
                searchInput?.focus();
            });

            searchClose?.addEventListener('click', function() {
                searchOverlay.classList.remove('search-overlay-active');
            });
        }

        // Profile dropdown without arrow indicator
        const profileDropdown = document.querySelector('.profile-dropdown');
        const profileMenu = document.querySelector('.profile-menu');

        if (profileDropdown && profileMenu) {
            profileDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
                profileMenu.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (!profileDropdown.contains(e.target)) {
                    profileMenu.classList.remove('show');
                }
            });
        }
    });
</script>
