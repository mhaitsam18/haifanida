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

    <div class="blog-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Paket Pilihan</span>
                <h2>Pilih Paket Umroh Anda</h2>
            </div>
            <div class="row pt-45">
                @if($pakets->count() > 0)
                    @foreach($pakets as $paket)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="blog-card">
                                <div class="blog-img">
                                    <a href="/paket/{{ $paket->id }}">
                                        @if($paket->gambar)
                                            <img src="{{ asset('storage/' . $paket->gambar) }}" alt="Gambar Paket" loading="lazy">
                                        @else
                                            <img src="/assets-techex-demo/images/blog/blog-img1.jpg" alt="{{ $paket->nama_paket }}" loading="lazy">
                                        @endif
                                    </a>
                                    <div class="blog-tag">
                                        <h3>{{ Carbon::parse($paket->tanggal_mulai)->format('d') }}</h3>
                                        <span>{{ Carbon::parse($paket->tanggal_mulai)->format('M') }}</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <ul>
                                        <li>
                                            <a href="#"><i class='bx bx-time'></i> {{ $paket->durasi }} Hari</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class='bx bx-purchase-tag-alt'></i>{{ ucfirst($paket->jenis_paket) }}</a>
                                        </li>
                                    </ul>
                                    <h3>
                                        <a href="/paket/{{ $paket->id }}">{{ $paket->nama_paket }}</a>
                                    </h3>
                                    <p>{{ Str::limit($paket->deskripsi, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="/paket/{{ $paket->id }}" class="read-btn">Lihat Detail <i class='bx bx-chevron-right'></i></a>
                                        <div class="price">
                                            <span>Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>Tidak ada paket umroh yang tersedia saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection