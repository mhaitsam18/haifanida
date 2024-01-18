@extends('layouts.main')
@section('style')
    <link rel="stylesheet" href="/assets/css/style.css">
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


    <section class="services-widget-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Our Galeries</span>
                <h2>Umroh dan Haji bersama PT. Haifa Nida Wisata</h2>
            </div>
            <div class="row pt-45">
                @foreach ($galeries as $galeri)
                    <div class="col-lg-4 col-md-6">
                        <div class="services-item">
                            <a href="#">
                                <img src="{{ asset('storage/' . $galeri->file_path) }}" alt="Images" loading="lazy">
                            </a>
                            <div class="content">
                                <i>
                                    <img src="/assets/img/icons/haji-umroh.png" class="ikon" alt="">
                                </i>
                                <span><a href="#">{{ $galeri->nama }}</a></span>
                                <h3><a href="#">{{ $galeri->deskripsi }}</a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-12 col-md-12 text-center">
                    <div class="pagination-area">
                        <a href="services-1.html" class="prev page-numbers">
                            <i class='bx bx-left-arrow-alt'></i>
                        </a>
                        <span class="page-numbers current" aria-current="page">1</span>
                        <a href="services-1.html" class="page-numbers">2</a>
                        <a href="services-1.html" class="page-numbers">3</a>
                        <a href="services-1.html" class="next page-numbers">
                            <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
