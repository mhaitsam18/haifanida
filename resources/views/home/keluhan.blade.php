@extends('layouts.main')

@section('content')
    <div class="inner-banner">
        <div class="container">
            <div class="inner-title text-center">
                <h3>Form Keluhan</h3>
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <i class='bx bx-chevrons-right'></i>
                    </li>
                    <li>Form Keluhan</li>
                </ul>
            </div>
        </div>
        <div class="inner-shape">
            <img src="/assets-techex-demo/images/shape/inner-shape.png" alt="Images">
        </div>
    </div>

    {{-- <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="embed-responsive embed-responsive-16by9 text-center" style="min-height: 300px;">
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfJNCjYC6nJ9fwwGd5BBblkM4SITpDo-u_zIBFFQKxCSPmHxQ/viewform?usp=sharing"
                            target="_blank" class="btn btn-danger btn-lg">
                            Klik di sini untuk isi Form Keluhan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Judul dan Deskripsi -->
                    <div class="section-title text-center mb-5">
                        <h2>Form Keluhan</h2>
                        <p class="margin-auto">Kami peduli dengan pengalaman Anda. Silakan sampaikan keluhan atau saran melalui formulir kami, dan tim kami akan menanggapi secepat mungkin.</p>
                    </div>
                    <!-- Tombol -->
                    <div class="form-button-wrapper text-center">
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfJNCjYC6nJ9fwwGd5BBblkM4SITpDo-u_zIBFFQKxCSPmHxQ/viewform?usp=sharing"
                           target="_blank" class="btn-custom">
                            <i class='bx bx-message-square-detail'></i> Isi Form Keluhan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
