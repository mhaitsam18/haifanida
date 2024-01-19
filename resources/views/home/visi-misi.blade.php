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
    <div class="privacy-policy-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">{{ $konten->judul }}</span>
                <h2>{{ $konten->judul }}</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-12">
                    <div class="single-content">
                        {!! $konten->isi_konten ?? 'Belum Tersedia' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
