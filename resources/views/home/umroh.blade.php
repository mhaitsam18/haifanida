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
            <div class="filter-section mb-4">
                <form id="filterForm" action="/umroh" method="GET">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Harga Filter -->
                                        <div class="col-md-3">
                                            <div class="filter-group mb-3">
                                                <h5 class="filter-title">Harga</h5>
                                                <div class="price-range">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Rp {{ number_format(isset($hargaMin) ? $hargaMin : 0, 0, ',', '.') }}</span>
                                                        <span>Rp {{ number_format(isset($hargaMax) ? $hargaMax : 10000000, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <input type="number" class="form-control" name="harga_min" 
                                                                placeholder="Min" value="{{ request('harga_min') }}">
                                                        </div>
                                                        <div class="col-auto pt-2">-</div>
                                                        <div class="col">
                                                            <input type="number" class="form-control" name="harga_max" 
                                                                placeholder="Max" value="{{ request('harga_max') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Waktu Keberangkatan Filter -->
                                        <div class="col-md-3">
                                            <div class="filter-group mb-3">
                                                <h5 class="filter-title">Waktu Keberangkatan</h5>
                                                <div class="departure-dates">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="tanggal_mulai">Dari</label>
                                                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" 
                                                                value="{{ request('tanggal_mulai') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-2">
                                                        <div class="col">
                                                            <label for="tanggal_akhir">Sampai</label>
                                                            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" 
                                                                value="{{ request('tanggal_akhir') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Pilihan Lain Filter -->
                                        <div class="col-md-3">
                                            <div class="filter-group mb-3">
                                                <h5 class="filter-title">Pilihan Lain</h5>
                                                <div class="other-options">
                                                    <div class="durasi-options">
                                                        <label>Durasi</label>
                                                        <div class="durasi-checkboxes">
                                                            @if(isset($durasiOptions) && count($durasiOptions) > 0)
                                                                @foreach($durasiOptions as $durasi)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="durasi[]" 
                                                                            value="{{ $durasi }}" id="durasi{{ $durasi }}"
                                                                            {{ is_array(request('durasi')) && in_array($durasi, request('durasi')) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="durasi{{ $durasi }}">
                                                                            {{ $durasi }} Hari
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <p>Tidak ada opsi durasi</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Urutkan Filter -->
                                        <div class="col-md-3">
                                            <div class="filter-group mb-3">
                                                <h5 class="filter-title">Atur Urutan</h5>
                                                <select class="form-control" name="urutkan">
                                                    <option value="">Pilih Urutan</option>
                                                    <option value="harga_terendah" {{ request('urutkan') == 'harga_terendah' ? 'selected' : '' }}>
                                                        Harga Terendah
                                                    </option>
                                                    <option value="harga_tertinggi" {{ request('urutkan') == 'harga_tertinggi' ? 'selected' : '' }}>
                                                        Harga Tertinggi
                                                    </option>
                                                    <option value="tanggal_terdekat" {{ request('urutkan') == 'tanggal_terdekat' ? 'selected' : '' }}>
                                                        Tanggal Terdekat
                                                    </option>
                                                    <option value="durasi_terpendek" {{ request('urutkan') == 'durasi_terpendek' ? 'selected' : '' }}>
                                                        Durasi Terpendek
                                                    </option>
                                                    <option value="durasi_terpanjang" {{ request('urutkan') == 'durasi_terpanjang' ? 'selected' : '' }}>
                                                        Durasi Terpanjang
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Filter Buttons -->
                                    <div class="filter-buttons text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="/umroh" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit when sort option changes
        document.querySelector('select[name="urutkan"]').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
</script>
@endpush