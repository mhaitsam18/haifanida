@extends('layouts.main')

@section('content')
    <div class="section-title text-center">
        <h2>Daftar Keberangkatan</h2>
        <p>Daftar perjalanan yang akan datang</p>
    </div>

    @if($pemesanan && count($pemesanan) > 0)
    <div class="container">
        @foreach($pemesanan as $item)
        <div class="row justify-content-center my-5">
            <div class="card col-md-6" style="width: 54rem">
                <div class="card-body">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>{{ $item->paket->nama_paket }}</h3>
                        <span class="badge bg-primary">Akan Datang</span>
                    </div>
                    <div class="d-flex align-items-start m-3">
                        <img src="{{ asset('storage/paket-gambar/umroh-24.jpg') }}" alt="Foto Paket" class="me-3"
                        style="width: 250px; height: auto; border-radius: 8px;">
                        <div class="container">
                            @php
                                $departure = \Carbon\Carbon::parse($item->paket->tanggal_mulai);
                                $sisa_hari = \Carbon\Carbon::now()->diffInDays($departure, false);
                            @endphp
                            @if ($sisa_hari > 0)
                                <h3 class="mb-1 text-success">Berangkat {{ $sisa_hari }} hari lagi</h3>
                            @elseif($sisa_hari === 0)
                                <h3 class="mb-1 text-warning">Berangkat hari ini</h3>
                            @endif

                            <h5 class="mb-1">Tanggal Perjalanan: {{ \Carbon\Carbon::parse($item->paket->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($item->paket->tanggal_selesai)->format('d M Y') }}</h5>
                            <h5 class="mb-3 @if($item->is_pembayaran_lunas == 0) text-danger @else text-success @endif">
                                @if($item->is_pembayaran_lunas == 0)
                                    Tagihan yang belum dibayar: Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                                @else
                                    Pembayaran Lunas
                                @endif
                            </h5>

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

                    <div class="d-flex bd-highlight justify-content-end align-items-center mt-3">
                        @if($item->is_pembayaran_lunas == 0)
                            <p class="me-auto bd-highlight text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>Terdapat tagihan yang belum dilunasi
                            </p>
                            <a href="{{ route('pemesanan.detail', $item->id) }}" class="bd-highlight btn btn-primary me-2">
                                <i class="fas fa-info-circle me-2"></i>Detail
                            </a>
                            <a href="{{ route('pemesanan.tagihan', $item->id) }}" class="bd-highlight btn btn-success">
                                <i class="fas fa-credit-card me-2"></i>Bayar
                            </a>
                        @else
                            <p class="me-auto bd-highlight text-warning">
                                <i class="fas fa-file-alt me-2"></i>Periksa kelengkapan berkas Anda
                            </p>
                            <a href="{{ route('pemesanan.detail', $item->id) }}" class="bd-highlight btn btn-primary">
                                <i class="fas fa-info-circle me-2"></i>Detail
                            </a>
                        @endif
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
                    <i class="fas fa-info-circle fa-2x mb-3"></i>                    <h4>Belum ada perjalanan yang dijadwalkan</h4>
                    <p>Anda belum memiliki perjalanan yang akan datang. Silakan pesan perjalanan baru.</p>
                    <a href="{{ route('umroh.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-search me-2"></i>Cari Paket Perjalanan
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
