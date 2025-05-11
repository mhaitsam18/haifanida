@extends('layouts.main')

@php use Illuminate\Support\Str; @endphp

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="inner-banner">
        <div class="container">
            <div class="inner-title text-center">
                <h3>{{ $title }}</h3>
                <ul>
                    <li><a href="/home">Home</a></li>
                    <li><i class='bx bx-chevrons-right'></i></li>
                    <li><a href="/umroh">Paket Umroh</a></li>
                    <li><i class='bx bx-chevrons-right'></i></li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
        <div class="inner-shape">
            <img src="/assets-techex-demo/images/shape/inner-shape.png" alt="Images">
        </div>
    </div>

    <div class="service-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="service-article">
                        <div class="service-article-img">
                            @if($paket->gambar)
                            <img src="{{ asset('storage/' . $paket->gambar) }}" alt="Gambar Paket" style="max-height: 400px; width: 100%; object-fit: contain; border-radius: 10px; background: #f8f8f8;">
                            @else
                                <img src="/assets-techex-demo/images/services/service-details.jpg" alt="{{ $paket->nama_paket }}" style="max-height: 400px; width: 100%; object-fit: cover; border-radius: 10px;">
                            @endif
                        </div>

                        <div class="service-article-title">
                            <h2>{{ $paket->nama_paket }}</h2>
                        </div>

                        <div class="service-article-content">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-map'></i> Destinasi</h5>
                                        <p style="margin: 0;">{{ $paket->destinasi }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-time'></i> Durasi</h5>
                                        <p style="margin: 0;">{{ $paket->durasi }} Hari</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-calendar'></i> Tanggal Keberangkatan</h5>
                                        <p style="margin: 0;">{{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-calendar'></i> Tanggal Kepulangan</h5>
                                        <p style="margin: 0;">{{ Carbon::parse($paket->tanggal_selesai)->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-plane-take-off'></i> Keberangkatan dari</h5>
                                        <p style="margin: 0;">{{ $paket->tempat_keberangkatan }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-plane-land'></i> Kepulangan ke</h5>
                                        <p style="margin: 0;">{{ $paket->tempat_kepulangan }}</p>
                                    </div>
                                </div>
                            </div>

                            <h3>Deskripsi Paket</h3>
                            <p>{!! nl2br(e($paket->deskripsi)) !!}</p>

                            <h3>Fasilitas</h3>
                            <div class="facilities-content">
                                {!! $paket->fasilitas !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-wrap">
                        <div style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin-bottom: 30px; text-align: center;">
                            <h3>Harga Paket</h3>
                            <div style="margin: 15px 0;">
                                <h2 style="font-size: 32px; color: #ff5d22; margin-bottom: 0;">
                                    Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                </h2>
                                <span>per orang</span>
                            </div>
                            <a href="/pemesanan/create?paket_id={{ $paket->id }}" class="default-btn btn-bg-two border-radius-5 w-100 mt-3">
                                Pesan Sekarang
                            </a>
                        </div>

                        <div class="services-bar">
                            <h3 class="title">Paket Lainnya</h3>
                            <div class="services-bar-widget">
                                <ul>
                                    @foreach(App\Models\Paket::where('jenis_paket', $paket->jenis_paket)
                                            ->where('id', '!=', $paket->id)
                                            ->where('published_at', '!=', null)
                                            ->latest()
                                            ->take(5)
                                            ->get() as $otherPaket)
                                        <li>
                                            <a href="/paket/{{ $otherPaket->id }}">
                                                {{ $otherPaket->nama_paket }}
                                                <i class='bx bx-chevron-right'></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
