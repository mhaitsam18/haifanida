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

    <div class="content-area pt-30 pb-70">
        <div class="container">
            <!-- Filter Section -->
            <div class="filter-section mb-5">
                <div class="card shadow-sm" style="border: none; border-radius: 15px;">
                    <div class="card-body p-0">
                        <form id="filterForm" action="/umroh" method="GET">
                            <div class="d-flex align-items-center flex-wrap">
                                <!-- Filter Harga -->
                                <div class="filter-item flex-grow-1 p-3" style="border-right: 1px solid #eee;">
                                    <label class="form-label mb-2 text-muted small">
                                        <i class='bx bx-money-withdraw'></i> Range Harga
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control border-0" name="harga_min" 
                                            placeholder="Min" value="{{ request('harga_min') }}"
                                            style="border-radius: 8px 0 0 8px;">
                                        <span class="input-group-text border-0 bg-transparent">-</span>
                                        <input type="number" class="form-control border-0" name="harga_max" 
                                            placeholder="Max" value="{{ request('harga_max') }}"
                                            style="border-radius: 0 8px 8px 0;">
                                    </div>
                                </div>

                                <!-- Filter Tanggal -->
                                <div class="filter-item flex-grow-1 p-3" style="border-right: 1px solid #eee;">
                                    <label class="form-label mb-2 text-muted small">
                                        <i class='bx bx-calendar'></i> Tanggal Keberangkatan
                                    </label>
                                    <div class="input-group">
                                        <input type="date" class="form-control border-0" name="tanggal_mulai" 
                                            value="{{ request('tanggal_mulai') }}"
                                            style="border-radius: 8px 0 0 8px;">
                                        <span class="input-group-text border-0 bg-transparent">-</span>
                                        <input type="date" class="form-control border-0" name="tanggal_akhir" 
                                            value="{{ request('tanggal_akhir') }}"
                                            style="border-radius: 0 8px 8px 0;">
                                    </div>
                                </div>

                                <!-- Filter Durasi -->
                                <div class="filter-item flex-grow-1 p-3" style="border-right: 1px solid #eee;">
                                    <label class="form-label mb-2 text-muted small">
                                        <i class='bx bx-time'></i> Durasi Paket
                                    </label>
                                    <select class="form-select border-0" name="durasi" style="border-radius: 8px;">
                                        <option value="">Pilih Durasi</option>
                                        @foreach($durasiOptions as $durasi)
                                            <option value="{{ $durasi }}" {{ request('durasi') == $durasi ? 'selected' : '' }}>
                                                {{ $durasi }} Hari
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filter Pengurutan -->
                                <div class="filter-item flex-grow-1 p-3" style="border-right: 1px solid #eee;">
                                    <label class="form-label mb-2 text-muted small">
                                        <i class='bx bx-sort'></i> Urutkan
                                    </label>
                                    <select class="form-select border-0" name="urutkan" style="border-radius: 8px;">
                                        <option value="">Pilih Urutan</option>
                                        <option value="harga_terendah" {{ request('urutkan') == 'harga_terendah' ? 'selected' : '' }}>
                                            💰 Harga Terendah
                                        </option>
                                        <option value="harga_tertinggi" {{ request('urutkan') == 'harga_tertinggi' ? 'selected' : '' }}>
                                            💎 Harga Tertinggi
                                        </option>
                                        <option value="durasi_terpendek" {{ request('urutkan') == 'durasi_terpendek' ? 'selected' : '' }}>
                                            ⚡ Durasi Terpendek
                                        </option>
                                        <option value="durasi_terpanjang" {{ request('urutkan') == 'durasi_terpanjang' ? 'selected' : '' }}>
                                            🕒 Durasi Terpanjang
                                        </option>
                                    </select>
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex p-3">
                                    <button type="submit" class="btn btn-primary me-2" style="border-radius: 8px; padding: 8px 20px;">
                                        <i class='bx bx-search'></i> Cari
                                    </button>
                                    <a href="/umroh" class="btn btn-outline-secondary" style="border-radius: 8px; padding: 8px 12px;">
                                        <i class='bx bx-refresh'></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Paket Section -->
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
                                            <img src="{{ asset('storage/' . $paket->gambar) }}" alt="Gambar Paket" loading="lazy" class="img-fixed">
                                        @else
                                            <img src="/assets-techex-demo/images/blog/blog-img1.jpg" alt="{{ $paket->nama_paket }}" loading="lazy" class="img-fixed">
                                        @endif
                                    </a>
                                    <div class="blog-tag">
                                        <h3>{{ Carbon::parse($paket->tanggal_mulai)->format('d') }}</h3>
                                        <span>{{ Carbon::parse($paket->tanggal_mulai)->format('M') }}</span>
                                    </div>
                                </div>
                                <!-- Content Section -->
                                <div class="card-body d-flex flex-column" style="padding: 20px;">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3" style="font-weight: 700; line-height: 1.4;">
                                        <a href="/paket/{{ $paket->id }}" style="text-decoration: none; color: #333;">
                                            {{ $paket->nama_paket }}
                                        </a>
                                    </h5>

                                    <!-- Price -->
                                    <div class="price mb-3" style="font-size: 20px; font-weight: 650; color: #007bff;">
                                        <span>Rp {{ number_format($paket->harga, 0, ',', '.') }} /orang</span>
                                    </div>

                                    <!-- Package Info Grid -->
                                    <div class="package-details mb-3" style="font-size: 15px;">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class='bx bx-purchase-tag-alt' style="color: #007bff; margin-right: 6px; font-size: 16px;"></i>
                                                <span style="min-width: 165px;">Jenis</span>
                                                <span style="font-weight: 600;">{{ ucfirst($paket->jenis_paket) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class='bx bx-time' style="color: #007bff; margin-right: 6px; font-size: 16px;"></i>
                                                <span style="min-width: 165px;">Durasi Perjalanan</span>
                                                <span style="font-weight: 600;">{{ $paket->durasi }} Hari</span>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class='bx bx-time' style="color: #007bff; margin-right: 6px; font-size: 16px;"></i>
                                                <span style="min-width: 165px;">Tanggal Keberangkatan</span>
                                                <span style="font-weight: 600;">{{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</span>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class='bx bx-calendar' style="color: #007bff; margin-right: 6px; font-size: 16px;"></i>
                                                <span style="min-width: 165px;">Tanggal Kepulangan</span>
                                                <span style="font-weight: 600;">{{  Carbon::parse($paket->tanggal_selesai)->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class='bx bx-map' style="color: #007bff; margin-right: 6px; font-size: 16px;"></i>
                                                <span style="min-width: 165px;">Destinasi</span>
                                                <span style="font-weight: 600;">{{ $paket->destinasi }}</span>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class='bx bxs-plane-take-off' style="color: #007bff; margin-right: 6px; font-size: 16px;"></i>
                                                <span style="min-width: 165px;">Berangkat dari</span>
                                                <span style="font-weight: 600;">{{ $paket->tempat_keberangkatan }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <!-- Action Button -->
                                    <div class="mt-auto">
                                        <div class="d-grid gap-2">
                                            <a href="/paket/{{ $paket->id }}" class="btn-custom d-flex align-items-center justify-content-center" style="padding: 12px; font-weight: 600; border-radius: 8px; font-size: 15px;">
                                                <i class='bx bx-shopping-bag me-1'></i>
                                                <span>Pesan Sekarang</span>
                                            </a>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit when sort option changes
    document.querySelector('select[name="urutkan"]').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });

    // Format currency for price inputs
    const priceInputs = document.querySelectorAll('input[name="harga_min"], input[name="harga_max"]');
    priceInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value === '') return;
            this.value = parseInt(value).toLocaleString('id-ID');
        });
    });
});
</script>
@endpush