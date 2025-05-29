@extends('layouts.main')

@php use Illuminate\Support\Str; @endphp

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    
    <!-- Link ke CSS file yang baru -->
    <link rel="stylesheet" href="{{ asset('assets/css/umroh-package.css') }}">
    
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
                                <img src="{{ asset('storage/' . $paket->gambar) }}" alt="Gambar Paket">
                            @else
                                <img src="/assets-techex-demo/images/services/service-details.jpg" alt="{{ $paket->nama_paket }}">
                            @endif
                        </div>

                        <div class="service-article-title mt-4">
                            <h2>{{ $paket->nama_paket }}</h2>
                        </div>

                        <div class="service-article-content">
                            <div class="package-info-grid mt-5">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class='bx bx-map info-card-icon'></i>
                                        <h5 class="info-card-title">Destinasi</h5>
                                    </div>
                                    <p class="info-card-content">{{ $paket->destinasi }}</p>
                                </div>
                                
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class='bx bx-time info-card-icon'></i>
                                        <h5 class="info-card-title">Durasi</h5>
                                    </div>
                                    <p class="info-card-content">{{ $paket->durasi }} Hari</p>
                                </div>
                                
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class='bx bx-calendar info-card-icon'></i>
                                        <h5 class="info-card-title">Tanggal Keberangkatan</h5>
                                    </div>
                                    <p class="info-card-content">{{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</p>
                                </div>
                                
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class='bx bx-calendar info-card-icon'></i>
                                        <h5 class="info-card-title">Tanggal Kepulangan</h5>
                                    </div>
                                    <p class="info-card-content">{{ Carbon::parse($paket->tanggal_selesai)->format('d M Y') }}</p>
                                </div>
                                
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class='bx bxs-plane-take-off info-card-icon'></i>
                                        <h5 class="info-card-title">Keberangkatan dari</h5>
                                    </div>
                                    <p class="info-card-content">{{ $paket->tempat_keberangkatan }}</p>
                                </div>
                                
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class='bx bxs-plane-land info-card-icon'></i>
                                        <h5 class="info-card-title">Kepulangan ke</h5>
                                    </div>
                                    <p class="info-card-content">{{ $paket->tempat_kepulangan }}</p>
                                </div>
                            </div>

                            <div class="content-section">
                                <h3 class="content-section-title">
                                    <i class='bx bx-detail'></i>Deskripsi Paket
                                </h3>
                                <div class="content-section-body">
                                    {!! nl2br(e($paket->deskripsi)) !!}
                                </div>
                            </div>

                            <div class="content-section">
                                <h3 class="content-section-title">
                                    <i class='bx bx-check-shield'></i>Fasilitas
                                </h3>
                                <div class="content-section-body">
                                    {!! $paket->fasilitas !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-wrap">
                        <div class="price-card">
                            <h3>Harga Paket</h3>
                            <div class="price-display">
                                <div class="price-amount">
                                    Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                </div>
                                <div class="price-unit">per orang</div>
                            </div>
                            <a href="{{ route('umroh.formPemesanan', ['paket_id' => $paket->id]) }}" class="btn btn-order">
                                <i class='bx bx-cart' style="margin-right: 8px;"></i>Pesan Sekarang
                            </a>
                            
                            <!-- WhatsApp Share Button -->
                            <div class="text-center">
                                <a href="#" id="shareWhatsAppBtn" class="btn btn-whatsapp d-flex justify-content-center align-items-center">
                                    <i class='bx bxl-whatsapp me-2' style="font-size: 22px;"></i> Bagikan via WhatsApp
                                </a>
                            </div>
                        </div>

                        <div class="sidebar-section">
                            <h3 class="sidebar-title">
                                <i class='bx bx-package'></i>Paket Lainnya
                            </h3>
                            <div class="services-bar-widget">
                                @foreach(App\Models\Paket::where('jenis_paket', $paket->jenis_paket)
                                        ->where('id', '!=', $paket->id)
                                        ->where('published_at', '!=', null)
                                        ->latest()
                                        ->take(5)
                                        ->get() as $otherPaket)
                                    <div class="package-item">
                                        <div class="package-item-content">
                                            <div class="package-item-image">
                                                @if($otherPaket->gambar)
                                                    <img src="{{ asset('storage/' . $otherPaket->gambar) }}" alt="{{ $otherPaket->nama_paket }}">
                                                @else
                                                    <div class="package-item-placeholder">
                                                        <i class='bx bx-image'></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="package-item-details">
                                                <a href="/paket/{{ $otherPaket->id }}" style="text-decoration: none; color: inherit;">
                                                    <h6 class="package-item-title">{{ Str::limit($otherPaket->nama_paket, 45) }}</h6>
                                                    <div class="package-item-meta">
                                                        <i class='bx bx-calendar'></i>
                                                        {{ Carbon::parse($otherPaket->tanggal_mulai)->format('d M Y') }}
                                                    </div>
                                                    <div class="package-item-meta">
                                                        <i class='bx bx-time'></i>
                                                        {{ $otherPaket->durasi }} Hari
                                                    </div>
                                                    <div class="package-item-price">
                                                        Rp {{ number_format($otherPaket->harga, 0, ',', '.') }}
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="package-item-arrow">
                                                <i class='bx bx-chevron-right'></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const shareWhatsAppBtn = document.getElementById('shareWhatsAppBtn');
        
        shareWhatsAppBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Helper function untuk decode HTML entities
            function decodeHtmlEntities(text) {
                const textarea = document.createElement('textarea');
                textarea.innerHTML = text;
                return textarea.value;
            }
            
            // Decode deskripsi dan fasilitas
            const deskripsi = {!! json_encode(strip_tags($paket->deskripsi)) !!};
            const fasilitas = {!! json_encode(strip_tags($paket->fasilitas)) !!};
            
            const decodedDeskripsi = decodeHtmlEntities(deskripsi);
            const decodedFasilitas = decodeHtmlEntities(fasilitas);
            
            const message = `🕋 Bismillah, aku mau daftar Umroh di PT. Haifa Nida Wisata Karawang! 
Berikut detail paket yang aku pilih:

✈️ {{ $paket->nama_paket }}
📆 Keberangkatan: {{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}
⏱️ Durasi: {{ $paket->durasi }} Hari
🌐 Destinasi: {{ $paket->destinasi }}
💰 Harga: Rp {{ number_format($paket->harga, 0, ',', '.') }}/orang

${decodedDeskripsi}

Fasilitas:
${decodedFasilitas}

🙋‍♂️ Tertarik juga? Bisa langsung hubungi admin PT. Haifa:
📱 WhatsApp: https://wa.me/6282299198002
📍 Kantor: Jl. Raya Karawang No. 88`;

            // Encode message untuk URL
            const encodedMessage = encodeURIComponent(message);
            
            // Buat WhatsApp link
            const whatsappLink = `https://api.whatsapp.com/send?text=${encodedMessage}`;
            
            // Buka WhatsApp di tab baru
            window.open(whatsappLink, '_blank');
        });
    });
    </script>
@endsection