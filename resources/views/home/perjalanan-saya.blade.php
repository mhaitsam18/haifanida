@extends('layouts.main')

@section('content')
    <div class="section-title text-center">
        <h2>Riwayat Perjalanan</h2>
        <h6>Daftar perjalanan yang telah selesai</h6>
    </div>

    @php
        use Carbon\Carbon;
    @endphp

    @if($pemesanan && count($pemesanan) > 0)
    <div class="container">
        @foreach($pemesanan as $item)
            @php
                $returnDate = Carbon::parse($item->paket->tanggal_selesai);
                $sisa_hari = Carbon::today()->diffInDays($returnDate, false);
            @endphp

            <div class="row justify-content-center my-5 mb-4">
                <div class="card col-md-6" style="width: 54rem">
                    <div class="card-body">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <!-- MODIFIED: Simplified header -->
                            <h3>{{ $item->paket->nama_paket }}</h3>
                            <span class="badge bg-secondary">Selesai</span>
                            <!-- ORIGINAL CODE: -->
                            <!-- <h3>{{ $item->paket->nama_paket }}</h3> -->
                        </div>
                        <div class="d-flex align-items-start m-3">
                            <!-- MODIFIED: Dynamic image -->
                            <img src="{{ $item->paket->gambar ? asset('storage/' . $item->paket->gambar) : asset('storage/paket-gambar/default.jpg') }}" 
                                 alt="{{ $item->paket->nama_paket }}" 
                                 class="me-3" style="width: 250px; height: auto; border-radius: 8px;">
                            <!-- ORIGINAL CODE: -->
                            <!-- <img src="{{ asset('storage/paket-gambar/umroh-24.jpg') }}" alt="Foto Paketnya di Sini" class="me-3" style="width: 250px; height: auto; border-radius: 8px;"> -->
                            <div class="container">
                                <!-- MODIFIED: Simplified status -->
                                <h3 class="mb-1 text-muted">Selesai {{ abs($sisa_hari) }} hari yang lalu</h3>
                                <!-- ORIGINAL CODE: -->
                                <!--
                                @if ($sisa_hari > 0)
                                    <h3 class="mb-1">Berangkat {{ $sisa_hari }} hari lagi</h3>
                                @elseif($sisa_hari === 0)
                                    <h3 class="mb-1">Berangkat hari ini</h3>
                                @elseif($sisa_hari < 0)
                                    <h3 class="mb-1">Sudah berangkat {{ abs($sisa_hari) }} hari yang lalu</h3>
                                @endif
                                -->
                                <h5 class="mb-3">
                                    Tanggal Perjalanan: 
                                    {{ Carbon::parse($item->paket->tanggal_mulai)->format('d M Y') }} - 
                                    {{ Carbon::parse($item->paket->tanggal_selesai)->format('d M Y') }}
                                </h5>
                                <!-- ORIGINAL CODE: -->
                                <!--
                                <h5 class="mb-1">Tanggal Perjalanan: {{ \Carbon\Carbon::parse($item->paket->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($item->paket->tanggal_selesai)->format('d M Y') }}</h5>
                                <h5 class="mb-3">Tagihan yang belum dibayar: Rp{{ number_format($item->total_harga, 0, ',', '.') }}</h5>
                                -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><i class="fas fa-users me-2"></i>Jumlah Orang: {{ $item->jumlah_orang }} Orang</p>
                                        <p><i class="fas fa-plane-departure me-2"></i>Keberangkatan: {{ ucfirst($item->paket->tempat_keberangkatan) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><i class="fas fa-suitcase me-2"></i>Jenis: {{ ucfirst($item->paket->jenis_paket) }}</p>
                                        <p><i class="fas fa-plane-arrival me-2"></i>Kepulangan: {{ ucfirst($item->paket->tempat_kepulangan) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center mt-3">
                            <!-- MODIFIED: Only Detail button -->
                            <a href="{{ route('pemesanan.detail', $item->id) }}" class="btn btn-primary">
                                <i class="fas fa-info-circle me-2"></i>Detail
                            </a>
                            <!-- ORIGINAL CODE: -->
                            <!--
                            @if($item->is_pembayaran_lunas == 0)
                                <p class="me-auto bd-highlight text-muted">Terdapat tagihan yang belum dilunasi</p>
                                <a href="{{ route('pemesanan.detail', $item->id) }}" class="bd-highlight btn btn-primary">Detail</a>
                            @else
                                <p class="me-auto bd-highlight text-muted">Terdapat Berkas yang belum diupload</p>
                            @endif
                            -->
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>Belum ada riwayat perjalanan</h4>
                    <p>Anda belum memiliki perjalanan yang telah selesai dan terkonfirmasi.</p>
                    <a href="{{ route('umroh.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-search me-2"></i>Cari Paket Perjalanan
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection