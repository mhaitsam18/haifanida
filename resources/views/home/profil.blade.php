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
                    <h3>PT. Haifa Nida Wisata Karawang</h3>
                    <p>
                        PT. Haifa Nida Wisata Karawang didirikan pada tahun 2007 oleh Dr. Fakhrurrozi, Lc., MA, alumnus
                        Universitas Islam Madinah yang memiliki pengalaman luas dalam industri perhotelan dan perjalanan
                        ibadah. Berawal dari bisnis perhotelan dan catering di Madinah, beliau mendirikan Haifa Nida Wisata
                        untuk memberikan layanan perjalanan Haji dan Umrah yang aman, nyaman, dan terpercaya.
                    </p>
                    <p>
                        Dengan izin resmi sebagai Penyelenggara Perjalanan Ibadah Umrah (PPIU), Haifa Nida Wisata menjadi
                        travel pertama di Karawang yang memperoleh legalitas penuh untuk memberangkatkan jamaah Umrah. Kami
                        memiliki 10 Tour Leader tersertifikasi BNSP, Tour Guide profesional, serta tim pembimbing dan
                        Muthowif/Muthowifah yang ahli di bidangnya.
                    </p>
                    <p>
                        Haifa Nida Wisata telah melayani lebih dari 100.000 jamaah Umrah dari seluruh Indonesia dan terus
                        berkomitmen untuk meningkatkan kualitas pelayanan. Saat ini, kami telah resmi mendapatkan
                        <strong>Akreditasi A</strong> dari Kementerian Agama Republik Indonesia sebagai bentuk pengakuan
                        atas standar mutu dan profesionalitas kami. Selain itu, kami juga tengah dalam proses pengajuan izin
                        sebagai <strong>Penyelenggara Ibadah Haji Khusus (PIHK)</strong> dan <strong>anggota IATA</strong>
                        guna memperluas cakupan layanan dan memberikan kemudahan bagi para tamu Allah.
                    </p>
                    <p>
                        Dr. Fakhrurrozi juga dikenal sebagai pendiri Catering Al-Haidari dan pemilik restoran Bakso Si Adoel
                        di Madinah, yang turut memperkuat kredibilitas dan kualitas pelayanan kami. Dengan pengalaman luas
                        di industri perjalanan ibadah, kami siap memberikan pelayanan terbaik bagi setiap jamaah.
                    </p>
                    <p>
                        <em>Percayakan perjalanan ibadah Anda bersama Haifa Nida Wisata — Aman, Nyaman, Amanah.</em><br>
                        Hubungi kami sekarang untuk informasi paket Umrah dan Haji terbaru.
                    </p>
                </div>
            </div>
            {{-- <div class="row mt-4">
                <div class="col-lg-12">
                    <h3>Dewan Direksi</h3>
                    <ul>
                        <li>H. Dr. Fakhrurrozi, Lc.,MA. - Komisaris Utama</li>
                        <li>H. Muhammad Haitsam, S.Kom - Direktur Utama</li>
                        <li>Hj. Ria Marliana Sari, S.E - Direktur</li>
                        <!-- Tambahkan anggota tim manajemen lainnya sesuai kebutuhan -->
                    </ul>
                </div>
            </div> --}}
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="about-content ml-25">
                        <section class="container py-5">
                            <h2 class="text-center mb-4">Sertifikat Akreditasi PPIU</h2>
                            <style>
                                .pdf-wrapper iframe {
                                    width: 100%;
                                    height: 100vh;
                                    border: none;
                                }

                                @media (max-width: 768px) {
                                    .pdf-wrapper iframe {
                                        height: 60vh;
                                    }
                                }
                            </style>

                            <div class="pdf-wrapper">
                                <iframe src="https://drive.google.com/file/d/1SsSRT8vEdf5vJTc69NoRWqsZ-5d0OgN_/preview">
                                </iframe>
                            </div>
                        </section>
                        <img class="img-thumbnail" src="/assets/img/haifa/akreditasi-2.jpg" alt="Images" loading="lazy">
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="about-content ml-25">
                        <section class="container py-5">
                            <h2 class="text-center mb-4">Keunggulan Haifa Nida Wisata</h2>
                            <div class="row">
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <i class="fas fa-certificate fa-3x text-primary mb-3"></i>
                                            <h5 class="card-title">Legal & Terakreditasi</h5>
                                            <p class="card-text">Memiliki izin resmi PPIU dan sedang dalam proses akreditasi
                                                terbaru untuk menjamin layanan berkualitas.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <i class="fas fa-user-shield fa-3x text-success mb-3"></i>
                                            <h5 class="card-title">Keamanan & Kenyamanan</h5>
                                            <p class="card-text">Menjamin perjalanan haji dan umroh yang aman, nyaman, dan
                                                penuh keberkahan bagi setiap jamaah.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <i class="fas fa-utensils fa-3x text-warning mb-3"></i>
                                            <h5 class="card-title">Catering Terbaik</h5>
                                            <p class="card-text">Didukung oleh Catering Al-Haidari, penyedia makanan nomor
                                                satu di Madinah untuk jamaah haji dan umroh.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <i class="fas fa-hotel fa-3x text-danger mb-3"></i>
                                            <h5 class="card-title">Akomodasi Berkualitas</h5>
                                            <p class="card-text">Menyediakan hotel berbintang dengan lokasi strategis di
                                                Mekkah dan Madinah.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <i class="fas fa-plane fa-3x text-info mb-3"></i>
                                            <h5 class="card-title">Transportasi Nyaman</h5>
                                            <p class="card-text">Menggunakan armada transportasi yang modern dan nyaman
                                                untuk perjalanan ibadah.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <i class="fas fa-users fa-3x text-secondary mb-3"></i>
                                            <h5 class="card-title">Bimbingan Ibadah</h5>
                                            <p class="card-text">Dibimbing oleh Muthowif dan pembimbing ibadah yang
                                                berpengalaman dan tersertifikasi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
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

    <!-- MODIFIED-- -->
    <!-- Tim Pembantu Pengembang Website -->
    <div class="choose-area pt-100 pb-70" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="section-title text-center mb-5">
                <span class="sp-color2">Tim Pengembang</span>
                <h2>Tim Pembantu Pengembang Website</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100" style="transition: all 0.4s ease; border-radius: 20px; background: linear-gradient(145deg, #ffffff, #f0f0f0); position: relative; overflow: hidden;">
                        <!-- Glow Effect -->
                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(40,167,69,0.1) 0%, transparent 70%); transition: all 0.4s ease; transform: scale(0);"></div>
                        
                        <div class="card-body text-center p-4" style="position: relative; z-index: 2;">
                            <div class="mb-3" style="position: relative;">
                                <div style="background: linear-gradient(135deg, #28a745, #20c997); border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto; box-shadow: 0 10px 30px rgba(40,167,69,0.3); position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%); animation: shine 2s infinite;"></div>
                                    <i class="fas fa-palette fa-2x text-white" style="position: relative; z-index: 2;"></i>
                                </div>
                            </div>
                            <h5 class="card-title mb-2" style="font-size: 1rem; font-weight: 700; color: #2c3e50; background: linear-gradient(135deg, #2c3e50, #34495e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Nuansa Bening A.J.</h5>
                            <div class="mb-2" style="background: linear-gradient(135deg, #28a745, #20c997); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 600; font-size: 0.9rem; white-space: nowrap;">Frontend Developer</div>
                            <div class="text-muted small mb-3" style="background: rgba(108,117,125,0.1); border-radius: 10px; padding: 6px;">
                                <div style="font-weight: 600; color: #495057; font-size: 0.75rem; line-height: 1.2; margin-bottom: 2px;">Universitas Pendidikan Indonesia</div>
                                <div style="color: #6c757d; font-size: 0.7rem; line-height: 1.2;">Ilmu Komputer</div>
                            </div>
                            <a href="https://github.com/nbeningg" target="_blank" class="btn btn-dark btn-sm" style="border-radius: 25px; padding: 8px 20px; background: linear-gradient(135deg, #343a40, #495057); border: none; box-shadow: 0 5px 15px rgba(52,58,64,0.3); transition: all 0.3s ease;">
                                <i class="fab fa-github"></i> GitHub
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100" style="transition: all 0.4s ease; border-radius: 20px; background: linear-gradient(145deg, #ffffff, #f0f0f0); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(220,53,69,0.1) 0%, transparent 70%); transition: all 0.4s ease; transform: scale(0);"></div>
                        
                        <div class="card-body text-center p-4" style="position: relative; z-index: 2;">
                            <div class="mb-3" style="position: relative;">
                                <div style="background: linear-gradient(135deg, #dc3545, #fd7e14); border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto; box-shadow: 0 10px 30px rgba(220,53,69,0.3); position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%); animation: shine 2s infinite;"></div>
                                    <i class="fas fa-terminal fa-2x text-white" style="position: relative; z-index: 2;"></i>
                                </div>
                            </div>
                            <h5 class="card-title mb-2" style="font-size: 1rem; font-weight: 700; color: #2c3e50; background: linear-gradient(135deg, #2c3e50, #34495e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Kasyful Haq B.</h5>
                            <div class="mb-2" style="background: linear-gradient(135deg, #dc3545, #fd7e14); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 600; font-size: 0.9rem; white-space: nowrap;">Frontend Developer</div>
                            <div class="text-muted small mb-3" style="background: rgba(108,117,125,0.1); border-radius: 10px; padding: 6px;">
                                <div style="font-weight: 600; color: #495057; font-size: 0.75rem; line-height: 1.2; margin-bottom: 2px;">Universitas Pendidikan Indonesia</div>
                                <div style="color: #6c757d; font-size: 0.7rem; line-height: 1.2;">Ilmu Komputer</div>
                            </div>
                            <a href="https://github.com/DatBoiSUS-Baka" target="_blank" class="btn btn-dark btn-sm" style="border-radius: 25px; padding: 8px 20px; background: linear-gradient(135deg, #343a40, #495057); border: none; box-shadow: 0 5px 15px rgba(52,58,64,0.3); transition: all 0.3s ease;">
                                <i class="fab fa-github"></i> GitHub
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100" style="transition: all 0.4s ease; border-radius: 20px; background: linear-gradient(145deg, #ffffff, #f0f0f0); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,193,7,0.1) 0%, transparent 70%); transition: all 0.4s ease; transform: scale(0);"></div>
                        
                        <div class="card-body text-center p-4" style="position: relative; z-index: 2;">
                            <div class="mb-3" style="position: relative;">
                                <div style="background: linear-gradient(135deg, #ffc107, #fd7e14); border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto; box-shadow: 0 10px 30px rgba(255,193,7,0.3); position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%); animation: shine 2s infinite;"></div>
                                    <i class="fas fa-cogs fa-2x text-white" style="position: relative; z-index: 2;"></i>
                                </div>
                            </div>
                            <h5 class="card-title mb-2" style="font-size: 1rem; font-weight: 700; color: #2c3e50; background: linear-gradient(135deg, #2c3e50, #34495e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Meisya Amalia</h5>
                            <div class="mb-2" style="background: linear-gradient(135deg, #ffc107, #fd7e14); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 600; font-size: 0.9rem; white-space: nowrap;">Backend Developer</div>
                            <div class="text-muted small mb-3" style="background: rgba(108,117,125,0.1); border-radius: 10px; padding: 6px;">
                                <div style="font-weight: 600; color: #495057; font-size: 0.75rem; line-height: 1.2; margin-bottom: 2px;">Universitas Pendidikan Indonesia</div>
                                <div style="color: #6c757d; font-size: 0.7rem; line-height: 1.2;">Ilmu Komputer</div>
                            </div>
                            <a href="https://github.com/Meisya721" target="_blank" class="btn btn-dark btn-sm" style="border-radius: 25px; padding: 8px 20px; background: linear-gradient(135deg, #343a40, #495057); border: none; box-shadow: 0 5px 15px rgba(52,58,64,0.3); transition: all 0.3s ease;">
                                <i class="fab fa-github"></i> GitHub
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100" style="transition: all 0.4s ease; border-radius: 20px; background: linear-gradient(145deg, #ffffff, #f0f0f0); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(0,123,255,0.1) 0%, transparent 70%); transition: all 0.4s ease; transform: scale(0);"></div>
                        
                        <div class="card-body text-center p-4" style="position: relative; z-index: 2;">
                            <div class="mb-3" style="position: relative;">
                                <div style="background: linear-gradient(135deg, #007bff, #6610f2); border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto; box-shadow: 0 10px 30px rgba(0,123,255,0.3); position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%); animation: shine 2s infinite;"></div>
                                    <i class="fas fa-code fa-2x text-white" style="position: relative; z-index: 2;"></i>
                                </div>
                            </div>
                            <h5 class="card-title mb-2" style="font-size: 1rem; font-weight: 700; color: #2c3e50; background: linear-gradient(135deg, #2c3e50, #34495e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Ibnu Fadhilah</h5>
                            <div class="mb-2" style="background: linear-gradient(135deg, #007bff, #6610f2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 600; font-size: 0.9rem; white-space: nowrap;">Backend Developer</div>
                            <div class="text-muted small mb-3" style="background: rgba(108,117,125,0.1); border-radius: 10px; padding: 6px;">
                                <div style="font-weight: 600; color: #495057; font-size: 0.75rem; line-height: 1.2; margin-bottom: 2px;">Universitas Pendidikan Indonesia</div>
                                <div style="color: #6c757d; font-size: 0.7rem; line-height: 1.2;">Ilmu Komputer</div>
                            </div>
                            <a href="https://github.com/Noov-hub" target="_blank" class="btn btn-dark btn-sm" style="border-radius: 25px; padding: 8px 20px; background: linear-gradient(135deg, #343a40, #495057); border: none; box-shadow: 0 5px 15px rgba(52,58,64,0.3); transition: all 0.3s ease;">
                                <i class="fab fa-github"></i> GitHub
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(200%) rotate(45deg); }
        }
        
        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
        }
        
        .card:hover div[style*="radial-gradient"] {
            transform: scale(1) !important;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(52,58,64,0.4) !important;
        }
        
        .card-body {
            backdrop-filter: blur(10px);
        }
    </style>

    <!-- --MODIFIED -->

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
                {{-- <span class="sp-color2">Struktur Organisasi</span> --}}
                {{-- <h2>Staff Kami</h2> --}}
                <img class="img-thumbnail" src="/assets/img/haifa/staff-kami.jpg" alt="Images" loading="lazy">
            </div>
            {{-- <div class="row pt-45">
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
            </div> --}}
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
                <h2>Let's Check Our Business Growth and Success Story</h2>
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
