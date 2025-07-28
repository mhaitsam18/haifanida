@extends('layouts.main')
@section('style')
    <style>
        #map {
            height: 100%;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
    <div class="contact-form-area pt-50 pb-50">
        <div class="container">
            <div class="section-title text-center">
                <h2>Konsultasikan Rencana Perjalanan Anda</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-4">
                    <div class="contact-info mr-20">
                        <span>Info Kontak</span>
                        <h2>Hubungi Kami</h2>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam imperdiet varius mi, ut hendrerit magna mollis ac. </p> --}}
                        <ul>
                            <li>
                                <div class="content">
                                    <i class='bx bx-phone-call'></i>
                                    <h3>Nomor Telepon CS</h3>
                                    <a href="tel:+62(822)9919-8002">+62 (822) 9919-8002</a>
                                </div>
                            </li>
                            <li>
                                <div class="content">
                                    <i class='bx bxs-map'></i>
                                    <h3>Alamat</h3>
                                    <a href="https://maps.app.goo.gl/Xrx19pdcp5CvsVoc6">Jl. Ra. Kartini No.1, Karangpawitan,
                                        Kec. Karawang Barat, Karawang,
                                        Jawa Barat
                                        41315</a>
                                </div>
                            </li>
                            <li>
                                <div class="content">
                                    <i class='bx bx-message'></i>
                                    <h3>Email</h3>
                                    <a
                                        href="mailto:cs@haifanida.id?subject=Pertanyaan&body=Saya memiliki beberapa pertanyaan tentang produk Anda"><span
                                            class="__cf_email__">cs@haifanida.id</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-form">
                        @if (session()->has('error'))
                            <div class="alert alert-danger mb-3 mx-auto" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success mb-3 mx-auto" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session()->has('status'))
                            <div class="alert alert-info mb-3 mx-auto" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/kontak-kami" method="post" id="contactForm">
                            @csrf
                            @auth
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @endauth
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama<span>*</span></label>
                                        <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control"
                                            required data-error="Masukkan Nama Anda" placeholder="Nama">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input type="email" name="email_pengirim" id="email_pengirim" class="form-control"
                                            required data-error="Masukkan Email Anda" placeholder="Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nomor Ponsel / WhatsApp <span>*</span></label>
                                        <input type="text" name="nomor_wa_pengirim" id="nomor_wa_pengirim" required
                                            data-error="Masukkan Nomor Anda" class="form-control"
                                            placeholder="Nomor WhatsApp">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Subjek <span>*</span></label>
                                        <input type="text" name="subjek" id="subjek" class="form-control" required
                                            data-error="Masukkan Subjek" placeholder="Subjek / Judul">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Pesan <span>*</span></label>
                                        <textarea name="pesan" class="form-control" id="pesan" cols="30" rows="8" required
                                            data-error="Tulis Pesan Anda" placeholder="Pesan Anda"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12 col-md-12">
                                    <div class="agree-label">
                                        <input type="checkbox" id="chb1">
                                        <label untuk="chb1">
                                            Terima <a href="terms-condition.html">Syarat & Ketentuan</a> Dan <a
                                                href="privacy-policy.html">Kebijakan Privasi.</a>
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="default-btn btn-bg-two border-radius-50">
                                        Kirim Pesan <i class='bx bx-chevron-right'></i>
                                    </button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-form-area pt-50">
        <div class="container">
            <div class="section-title text-center">
                <h2>Informasi Kontak</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-12">
                    <h5 class="card-title">Customer Service</h5>
                    <a href="https://wa.me/6282299198002" target="_blank" class="card-text">
                        <img src="/assets/img/logos/logo-wa.png" alt="WhatsApp Logo" style="width: 24px; height: 24px; vertical-align: middle;"> +62 (822) 9919-8002
                    </a>
                    <hr>
                    {{--
                    <h5 class="card-title">Staf Administrasi: Rini Apriyani</h5>
                    <a href="https://wa.me/628111720494" target="_blank" class="card-text">WA: +62 (811) 1720-494</a>
                    <hr>
                    <h5 class="card-title">Direktur Keuangan: Dini Wahyuni</h5>
                    <a href="https://wa.me/6282299198102" target="_blank" class="card-text">WA: +62 (822) 9919-8102</a>
                    <hr>
                    <h5 class="card-title">Direktur Pemasaran: Irma Muji R</h5>
                    <a href="https://wa.me/6285221406683" target="_blank" class="card-text">WA: +62 (852) 2140-6683</a>
                    <hr>
                    <h5 class="card-title">Direktur Operasional: Hj. Ria Marlianasari, SE.</h5>
                    <a href="https://wa.me/6281387501171" target="_blank" class="card-text">WA: +62 (813) 8750-1171</a>
                    <hr>
                    <h5 class="card-title">Direktur Utama: H. Muhammad Haitsam, S.Kom.</h5>
                    <a href="https://wa.me/6282117503125" target="_blank" class="card-text">WA: +62 (821) 1750-3125</a>
                    <hr>
                    <h5 class="card-title">Komisaris Utama: Dr.H. Fakhrurrozi, Lc.,MA</h5>
                    <a href="https://wa.me/6281220747000" target="_blank" class="card-text">WA: +62 (812) 2074-7000</a>
                    <hr> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="map-area">
        <div class="container-fluid m-0 p-0">
            <div id="map"></div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4070.1583314211575!2d107.29679825896102!3d-6.299718274308804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e697761e03cf5ab%3A0x707fddda5f250f94!2sPT.%20Haifa%20Nida%20Wisata%20%7C%20Travel%20Umroh%20Karawang%20Pertama%20%7C%20Biro%20Umrah%20%7C%20Muslim%20Tour%20Umroh%20Resmi%20Terbaik%20Terpercaya!5e0!3m2!1sid!2sid!4v1746594252410!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
                d[l](f, ...n))
        })
        ({
            key: "AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg",
            v: "weekly"
        });
    </script>
    <script>
        // Initialize and add the map
        let map;

        async function initMap() {
            // The location of Uluru
            const position = {
                lat: -25.344,
                lng: 131.031
            };
            // Request needed libraries.
            //@ts-ignore
            const {
                Map
            } = await google.maps.importLibrary("maps");
            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");

            // The map, centered at Uluru
            map = new Map(document.getElementById("map"), {
                zoom: 4,
                center: position,
                mapId: "DEMO_MAP_ID",
            });

            // The marker, positioned at Uluru
            const marker = new AdvancedMarkerElement({
                map: map,
                position: position,
                title: "Uluru",
            });
        }

        initMap();
    </script>
@endsection
