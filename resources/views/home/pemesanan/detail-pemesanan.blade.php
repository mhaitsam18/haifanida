@extends('layouts.main')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="inner-banner">
    <div class="container">
        <div class="inner-title text-center">
            <h3>Detail Pemesanan</h3>
            <ul class="list-inline breadcrumb-items">
                <li class="list-inline-item"><a href="/home">Beranda</a></li>
                <li class="list-inline-item"><i class='bx bx-chevron-right'></i></li>
                <li class="list-inline-item"><a href="/umroh">Paket Umroh</a></li>
                <li class="list-inline-item"><i class='bx bx-chevron-right'></i></li>
                <li class="list-inline-item">Detail Pemesanan</li>
            </ul>
        </div>
    </div>
    <div class="inner-shape">
        <img src="/assets-techex-demo/images/shape/inner-shape.png" alt="Gambar">
    </div>
</div>

<div class="booking-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Detail Pemesanan -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                        <h5 class="m-0 fw-bold"><i class='bx bx-file me-2'></i>Detail Pemesanan</h5>
                        <div>
                            <a href="{{ route('pemesanan.detail.jamaah', $pemesanan->id) }}" class="btn btn-primary btn-sm me-2"><i class='bx bx-user me-1'></i>Lihat Data Jamaah</a>
                            <a href="{{ route('pemesanan.tagihan', $pemesanan->id) }}" class="btn btn-success btn-sm"><i class='bx bx-receipt me-1'></i>Lihat Tagihan</a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset('storage/' . $pemesanan->paket->gambar) }}" alt="{{ $pemesanan->paket->nama_paket }}" class="img-fluid rounded" style="width: 100%; height: auto;">
                            </div>
                            <div class="col-md-8">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Nama Paket:</strong> {{ $pemesanan->paket->nama_paket }}</li>
                                    <li class="mb-2"><strong>Tanggal Pemesanan:</strong> {{ Carbon::parse($pemesanan->created_at)->format('d M Y') }}</li>
                                    <li class="mb-2"><strong>Tanggal Pelunasan:</strong> {{ Carbon::parse($pemesanan->paket->tanggal_mulai)->format('d M Y') }}</li>
                                    <li class="mb-2"><strong>Pembayaran:</strong> {{ $pemesanan->metode_pembayaran }}</li>
                                    <li class="mb-2"><strong>Jumlah Pesanan:</strong> {{ $pemesanan->jumlah_pengisi }} pax</li>
                                    <li class="mb-2"><strong>Status Pelunasan:</strong> {{ $pemesanan->status_pembayaran ?? 'Belum Lunas' }}</li>
                                    <li class="mb-2"><strong>Total Harga:</strong> Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pemesanan Kamar -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                        <h5 class="m-0 fw-bold"><i class='bx bx-hotel me-2'></i>Pemesanan Kamar</h5>
                        <a href="#" class="btn btn-primary btn-sm"><i class='bx bx-plus me-1'></i>Tambah Pemesanan Kamar</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipe Kamar</th>
                                        <th>Jumlah Pengisi</th>
                                        <th>Harga</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pemesanan->kamar as $index => $kamar)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $kamar->tipe_kamar }}</td>
                                            <td>{{ $kamar->jumlah_pengisi }}</td>
                                            <td>Rp {{ number_format($kamar->harga, 0, ',', '.') }}</td>
                                            <td>{{ $kamar->keterangan ?? '-' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm me-1"><i class='bx bx-show'></i> Lihat Permintaan</a>
                                                <a href="#" class="btn btn-warning btn-sm me-1"><i class='bx bx-edit'></i> Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm"><i class='bx bx-trash'></i> Hapus</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada pemesanan kamar.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pemesanan Ekstra -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                        <h5 class="m-0 fw-bold"><i class='bx bx-plus-circle me-2'></i>Pemesanan Ekstra</h5>
                        <a href="#" class="btn btn-primary btn-sm"><i class='bx bx-plus me-1'></i>Tambah Pemesanan Ekstra</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ekstra / Tambahan</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pemesanan->ekstra as $index => $ekstra)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $ekstra->nama_ekstra }}</td>
                                            <td>{{ $ekstra->jumlah }}</td>
                                            <td>Rp {{ number_format($ekstra->total_harga, 0, ',', '.') }}</td>
                                            <td>{{ $ekstra->keterangan ?? '-' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm me-1"><i class='bx bx-edit'></i> Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm"><i class='bx bx-trash'></i> Hapus</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada pemesanan ekstra.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Pembayaran -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                        <h5 class="m-0 fw-bold"><i class='bx bx-money me-2'></i>Riwayat Pembayaran</h5>
                        <a href="#" class="btn btn-primary btn-sm"><i class='bx bx-plus me-1'></i>Tambah Riwayat Pembayaran</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pemesanan->pembayaran as $index => $pembayaran)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>Rp {{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}</td>
                                            <td>{{ $pembayaran->metode_pembayaran }}</td>
                                            <td>{{ Carbon::parse($pembayaran->tanggal_pembayaran)->format('d M Y') }}</td>
                                            <td><a href="#">Lihat Bukti</a></td>
                                            <td>{{ $pembayaran->status_pembayaran }}</td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm me-1"><i class='bx bx-edit'></i> Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm"><i class='bx bx-trash'></i> Hapus</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada riwayat pembayaran.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tombol Kembali -->
                <div class="text-start">
                    <a href="{{ route('pemesanan.form') }}" class="btn btn-secondary btn-bg-two border-radius-5 px-4 py-3">
                        <i class='bx bx-arrow-back me-2'></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection