@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/coming-soon.css') }}">
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

    <div class="content-area pt-30 pb-70" style="background-color: #ffffff;">
        <div class="container">
            <div class="section-title text-center">
                {{-- <span class="sp-color2">Segera Hadir</span>
                <h2>Pilih Paket Tour Anda</h2> --}}
            </div>
            <div class="row pt-45">
                <div class="col-lg-12 col-md-12">
                    <div class="coming-soon-content text-center">
                        <h1 class="coming-soon-title">Coming Soon!</h1>
                        <p>Kami sedang mempersiapkan paket tour terbaik untuk perjalanan Anda. Tunggu kabar terbaru dari kami!</p>
                        <div class="coming-soon-decoration">
                            <div class="particle-effect"></div>
                            <div class="icon-wrapper">
                                <i class='bx bx-time-five'></i>
                            </div>
                        </div>
                        {{-- <a href="/home" class="btn-order mt-4">Kembali ke Beranda <i class='bx bx-chevron-right'></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection