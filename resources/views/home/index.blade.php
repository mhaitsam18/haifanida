@extends('layouts.main')
@section('style')
    <style>
        .item-bg-1 {
            background-image: {{ asset('storage/' . $beranda1->gambar) }}
        }

        .item-bg-2 {
            background-image: {{ asset('storage/' . $beranda1->gambar) }}
        }

        .item-bg-3 {
            background-image: {{ asset('storage/' . $beranda1->gambar) }}
        }
    </style>
@endsection
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="banner-slider-area">
        <div class="banner-slider owl-carousel owl-theme">
            <div class="banner-item item-bg1">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="banner-item-content">
                                {{-- <span>Only High Quality Services</span> --}}
                                <h1>Haifa Nida Wisata</h1>
                                <p>
                                    Tour & Travel
                                    <br>
                                    No. SK : 91202027102820002
                                    <br>
                                    2 Agustus 2022
                                </p>
                                <div class="banner-btn">
                                    <a href="/tentang-kami" class="default-btn btn-bg-two border-radius-50">Tentang Kami<i
                                            class='bx bx-chevron-right'></i></a>
                                    <a href="/layanan-kami" class="default-btn btn-bg-one border-radius-50 ml-20">Paket Kami
                                        <i class='bx bx-chevron-right'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-item item-bg2">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="banner-item-content">
                                <h1>Berdiri sejak tahun 2007</h1>
                                <p>
                                    didirikan oleh Dr. Fakhrurrozi, Lc., MA, seorang alumni Universitas Islam Madinah yang
                                    memiliki pengalaman mendalam dan wawasan yang tak ternilai tentang Mekkah dan Madinah.
                                    Kombinasi pengetahuannya yang mendalam tentang destinasi suci bersama keahliannya dalam
                                    ilmu agama, menjadikan kami pilihan utama untuk perjalanan Haji, Umroh, dan wisata halal
                                    Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-item item-bg3">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="banner-item-content">
                                <h1>Aman, Nyaman dan Amanah</h1>
                                <p>
                                    "Aman, Nyaman, dan Amanah" adalah sebuah moto yang sangat kuat dan menggambarkan prinsip
                                    utama PT. Haifa Nida Wisata dalam memberikan pelayanan kepada para jamaah. Kombinasi
                                    dari keamanan, kenyamanan, dan keamanahan mencerminkan komitmen kami untuk memberikan
                                    pengalaman perjalanan ibadah yang tak terlupakan. Dalam setiap perjalanan bersama kami,
                                    kami berusaha untuk menjaga ketiga nilai ini sebagai fondasi utama dalam layanan kami
                                    kepada Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="about-area ptb-100">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6">
                    <div class="about-content mr-20">
                        <div class="section-title">
                            @php
                                $startDate = Carbon::create(2007, 8, 2);
                                $currentDate = Carbon::now();
                                $experienceYears = $currentDate->diffInYears($startDate);
                            @endphp
                            <span class="sp-color2">{{ $experienceYears }} Tahun Pengalaman</span>
                            <h2>Sejarah PT. Haifa Nida Wisata Karawang</h2>
                            <p>
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
                            </p>
                        </div>
                        {{-- <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="about-content-card">
                                    <i class="flaticon-practice"></i>
                                    <h3>Experience</h3>
                                    <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="about-content-card">
                                    <i class="flaticon-help"></i>
                                    <h3>Quick Support</h3>
                                    <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="/assets/img/haifa/karyawan.jpg" alt="About Images">
                        {{-- <div class="sub-content">
                            <img src="/assets-techex-demo/images/about/about-img2.jpg" alt="About Images" loading="lazy">
                            <div class="content">
                                <h3>4.5k</h3>
                                <span>Satisfied Clients</span>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <section class="services-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color1">Our Services</span>
                <h2>We Provide a Wide Variety of IT Services</h2>
                <p class="margin-auto">
                    Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id
                    elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris Morbi accumsan ipsum velit.
                </p>
            </div>
            <div class="row pt-45">
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-consultant"></i>
                        <h3><a href="service-details.html">IT Consulting</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor
                            nisi el. </p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-consulting"></i>
                        <h3><a href="service-details.html">Cloud Computing</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor
                            nisi el. </p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-web-development"></i>
                        <h3><a href="service-details.html">Web Development</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor
                            nisi el. </p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-stats"></i>
                        <h3><a href="service-details.html">Business Reform</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor
                            nisi el. </p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-shape">
            <img src="/assets-techex-demo/images/shape/service-shape1.png" alt="Images" loading="lazy">
        </div>
    </section> --}}


    {{-- <section class="work-process-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Our Working Process</span>
                <h2>How Our Services Will Help You to Grow Your Business</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-3 col-sm-6">
                    <div class="work-process-card">
                        <i class="flaticon-project"></i>
                        <h3>Discovery</h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.
                        </p>
                        <div class="number">01</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="work-process-card">
                        <i class="flaticon-chip"></i>
                        <h3>Planning</h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.
                        </p>
                        <div class="number">02</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="work-process-card">
                        <i class="flaticon-effective"></i>
                        <h3>Execute</h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.
                        </p>
                        <div class="number">03</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="work-process-card">
                        <i class="flaticon-bullhorn"></i>
                        <h3>Deliver</h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.
                        </p>
                        <div class="number">04</div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    {{-- <div class="build-area pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8">
                    <div class="build-content">
                        <div class="section-title">
                            <span>We Carry More Than Just Good Coding Skills</span>
                            <h2>Let's Build Your Website!</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="build-btn-area">
                        <a href="contact.html" class="default-btn btn-bg-two border-radius-50">Contact Us <i
                                class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
            </div>
            <div class="build-play-img pt-45">
                <img src="/assets-techex-demo/images/build-img.jpg" alt="Images" loading="lazy">
                <div class="play-area-content">
                    <span>Watch Our Intro Video</span>
                    <h2>Perfect Solution for IT Services!</h2>
                </div>
                <div class="play-area">
                    <a href="https://www.youtube.com/watch?v=tUP5S4YdEJo" class="play-on popup-btn"><i
                            class='bx bx-play'></i></a>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="counter-area pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Numbers Are Talking</span>
                <h2>Let’s Check Our Business Growth and Success Story</h2>
                <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id
                    elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris Morbi accumsan ipsum velit.
                </p>
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


    {{-- <div class="call-us-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="call-contact">
                        <h3>Call Us 24/7</h3>
                        <a href="tel:+1(212)255-5511" class="call-btn">+1 (212) 255-5511</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mollis tempor nunc ac
                            sollicitudin Interdum et malesuada fames ac ante ipsum primis.</p>
                        <a href="contact.html" class="default-btn btn-bg-two border-radius-5">Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="call-us-img">
                        <img src="/assets-techex-demo/images/call-us/call-us-img1.png" alt="Images" loading="lazy">
                        <div class="call-shape">
                            <div class="shape1">
                                <img src="/assets-techex-demo/images/call-us/call-shap2.png" alt="Images" loading="lazy">
                            </div>
                            <div class="shape2 shape2-rs">
                                <img src="/assets-techex-demo/images/call-us/call-shap3.png" alt="Images" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="case-study-area pt-100 pb-70">
        <div class="container-fluid p-0">
            <div class="section-title text-center">
                <span class="sp-color2">Case Study</span>
                <h2>Introduce Our Projects and Check Recent Work </h2>
            </div>
            <div class="case-study-slider owl-carousel owl-theme pt-45">
                <div class="case-study-item">
                    <a href="case-details.html">
                        <img src="/assets-techex-demo/images/case-study/case-study1.jpg" alt="Images" loading="lazy">
                    </a>
                    <div class="content">
                        <h3><a href="case-details.html">Business Solution</a></h3>
                        <ul>
                            <li><a href="case-details.html">Business</a></li>
                            <li><a href="case-details.html">Planing</a> </li>
                        </ul>
                        <a href="case-details.html" class="more-btn"><i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
                <div class="case-study-item">
                    <a href="case-details.html">
                        <img src="/assets-techex-demo/images/case-study/case-study2.jpg" alt="Images" loading="lazy">
                    </a>
                    <div class="content">
                        <h3><a href="case-details.html">Business Solution</a></h3>
                        <ul>
                            <li><a href="case-details.html">Business</a></li>
                            <li><a href="case-details.html">Planing</a> </li>
                        </ul>
                        <a href="case-details.html" class="more-btn"><i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
                <div class="case-study-item">
                    <a href="case-details.html">
                        <img src="/assets-techex-demo/images/case-study/case-study3.jpg" alt="Images" loading="lazy">
                    </a>
                    <div class="content">
                        <h3><a href="case-details.html">Business Solution</a></h3>
                        <ul>
                            <li><a href="case-details.html">Business</a></li>
                            <li><a href="case-details.html">Planing</a> </li>
                        </ul>
                        <a href="case-details.html" class="more-btn"><i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
                <div class="case-study-item">
                    <a href="case-details.html">
                        <img src="/assets-techex-demo/images/case-study/case-study4.jpg" alt="Images" loading="lazy">
                    </a>
                    <div class="content">
                        <h3><a href="case-details.html">UI/UX Research</a></h3>
                        <ul>
                            <li><a href="case-details.html">UI/UX Design</a></li>
                            <li><a href="case-details.html">Research</a> </li>
                        </ul>
                        <a href="case-details.html" class="more-btn"><i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
                <div class="case-study-item">
                    <a href="case-details.html">
                        <img src="/assets-techex-demo/images/case-study/case-study6.jpg" alt="Images" loading="lazy">
                    </a>
                    <div class="content">
                        <h3><a href="case-details.html">Business Solution</a></h3>
                        <ul>
                            <li><a href="case-details.html">Solution</a></li>
                            <li><a href="case-details.html">Business</a> </li>
                        </ul>
                        <a href="case-details.html" class="more-btn"><i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
                <div class="case-study-item">
                    <a href="case-details.html">
                        <img src="/assets-techex-demo/images/case-study/case-study2.jpg" alt="Images" loading="lazy">
                    </a>
                    <div class="content">
                        <h3><a href="case-details.html">Web Development</a></h3>
                        <ul>
                            <li><a href="case-details.html">Design</a></li>
                            <li><a href="case-details.html">Development</a> </li>
                        </ul>
                        <a href="case-details.html" class="more-btn"><i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <section class="technology-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color1">Technology Index</span>
                <h2>We Deliver Our Best Solution With The Goal of Trusting</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-2 col-6">
                    <div class="technology-card">
                        <i class="flaticon-android"></i>
                        <h3>Android</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="technology-card">
                        <i class="flaticon-website"></i>
                        <h3>Web</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="technology-card">
                        <i class="flaticon-apple"></i>
                        <h3>ios</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="technology-card">
                        <i class="flaticon-television"></i>
                        <h3>TV</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="technology-card">
                        <i class="flaticon-smartwatch"></i>
                        <h3>Watch </h3>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="technology-card">
                        <i class="flaticon-cyber-security"></i>
                        <h3>IoT</h3>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    {{-- <div class="brand-area ptb-100">
        <div class="container">
            <div class="brand-slider owl-carousel owl-theme">
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-logo1.png" class="brand-logo-one" alt="Images"
                        loading="lazy">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style1.png" class="brand-logo-two" alt="Images"
                        loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-logo2.png" class="brand-logo-one" alt="Images"
                        loading="lazy">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style2.png" class="brand-logo-two" alt="Images"
                        loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-logo3.png" class="brand-logo-one" alt="Images"
                        loading="lazy">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style3.png" class="brand-logo-two" alt="Images"
                        loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-logo4.png" class="brand-logo-one" alt="Images"
                        loading="lazy">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style4.png" class="brand-logo-two" alt="Images"
                        loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-logo5.png" class="brand-logo-one" alt="Images"
                        loading="lazy">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style5.png" class="brand-logo-two" alt="Images"
                        loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-logo3.png" class="brand-logo-one" alt="Images"
                        loading="lazy">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style3.png" class="brand-logo-two" alt="Images"
                        loading="lazy">
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <section class="clients-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Our Clients</span>
                <h2>Our Clients Feedback</h2>
            </div>
            <div class="clients-slider owl-carousel owl-theme pt-45">
                <div class="clients-content">
                    <div class="content">
                        <img src="/assets-techex-demo/images/clients-img/clients-img1.jpg" alt="Images" loading="lazy">
                        <i class='bx bxs-quote-alt-left'></i>
                        <h3>Jonthon Martin</h3>
                        <span>App Developer</span>
                    </div>
                    <p>
                        “Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor,
                        nisi elit consequat ipsum, nec sagittis.
                        sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi loren
                        accumsan ipsum velit.”
                    </p>
                </div>
                <div class="clients-content">
                    <div class="content">
                        <img src="/assets-techex-demo/images/clients-img/clients-img2.jpg" alt="Images" loading="lazy">
                        <i class='bx bxs-quote-alt-left'></i>
                        <h3>Alin Decros</h3>
                        <span>Graphic Designer</span>
                    </div>
                    <p>
                        “Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor,
                        nisi elit consequat ipsum, nec sagittis.
                        sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi loren
                        accumsan ipsum velit.”
                    </p>
                </div>
                <div class="clients-content">
                    <div class="content">
                        <img src="/assets-techex-demo/images/clients-img/clients-img3.jpg" alt="Images" loading="lazy">
                        <i class='bx bxs-quote-alt-left'></i>
                        <h3>Elen Musk</h3>
                        <span>Web Developer</span>
                    </div>
                    <p>
                        “Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor,
                        nisi elit consequat ipsum, nec sagittis.
                        sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi loren
                        accumsan ipsum velit.”
                    </p>
                </div>
            </div>
        </div>
        <div class="client-circle">
            <div class="client-circle-1">
                <div class="circle"></div>
            </div>
            <div class="client-circle-2">
                <div class="circle"></div>
            </div>
            <div class="client-circle-3">
                <div class="circle"></div>
            </div>
            <div class="client-circle-4">
                <div class="circle"></div>
            </div>
            <div class="client-circle-5">
                <div class="circle"></div>
            </div>
            <div class="client-circle-6">
                <div class="circle"></div>
            </div>
            <div class="client-circle-7">
                <div class="circle"></div>
            </div>
        </div>
    </section> --}}


    {{-- <div class="blog-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Latest Blog</span>
                <h2>Let’s Check Some Latest Blog</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="/assets-techex-demo/images/blog/blog-img1.jpg" alt="Blog Images" loading="lazy">
                            </a>
                            <div class="blog-tag">
                                <h3>11</h3>
                                <span>Dec</span>
                            </div>
                        </div>
                        <div class="content">
                            <ul>
                                <li>
                                    <a href="blog-1.html"><i class='bx bxs-user'></i> By Admin</a>
                                </li>
                                <li>
                                    <a href="blog-1.html"><i class='bx bx-purchase-tag-alt'></i>Business</a>
                                </li>
                            </ul>
                            <h3>
                                <a href="blog-details.html">Product Idea Solution for New Generation</a>
                            </h3>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                auctor, nisi elit consequat ipsum.</p>
                            <a href="blog-details.html" class="read-btn">Read More <i class='bx bx-chevron-right'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="/assets-techex-demo/images/blog/blog-img2.jpg" alt="Blog Images" loading="lazy">
                            </a>
                            <div class="blog-tag">
                                <h3>14</h3>
                                <span>Dec</span>
                            </div>
                        </div>
                        <div class="content">
                            <ul>
                                <li>
                                    <a href="blog-1.html"><i class='bx bxs-user'></i> By Admin</a>
                                </li>
                                <li>
                                    <a href="blog-1.html"><i class='bx bx-purchase-tag-alt'></i>Invention</a>
                                </li>
                            </ul>
                            <h3>
                                <a href="blog-details.html">New Device Invention for Digital Platform</a>
                            </h3>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                auctor, nisi elit consequat ipsum.</p>
                            <a href="blog-details.html" class="read-btn">Read More <i class='bx bx-chevron-right'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="/assets-techex-demo/images/blog/blog-img3.jpg" alt="Blog Images" loading="lazy">
                            </a>
                            <div class="blog-tag">
                                <h3>17</h3>
                                <span>Dec</span>
                            </div>
                        </div>
                        <div class="content">
                            <ul>
                                <li>
                                    <a href="blog-1.html"><i class='bx bxs-user'></i> By Admin</a>
                                </li>
                                <li>
                                    <a href="blog-1.html"><i class='bx bx-purchase-tag-alt'></i>Achive</a>
                                </li>
                            </ul>
                            <h3>
                                <a href="blog-details.html">Business Strategy Make His Goal Acheive </a>
                            </h3>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                auctor, nisi elit consequat ipsum.</p>
                            <a href="blog-details.html" class="read-btn">Read More <i class='bx bx-chevron-right'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
