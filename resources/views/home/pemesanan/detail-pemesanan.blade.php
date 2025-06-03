@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/detail-pemesanan.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container-fluid py-5">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-2">{{ $title }}</h2>
        </div>
        <div class="col-md-6 text-end">
            <!-- ORIGINAL -->
            <!--
            <a href="{{ route('member.perjalanan-saya', $pemesanan->id) }}" 
               class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
            -->
            <!-- MODIFIED -->
            <a href="{{ $pemesanan->paket->tanggal_selesai >= Carbon::now() ? route('member.daftar-keberangkatan') : route('member.riwayat-perjalanan') }}" 
               class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
            <!-- END MODIFIED -->
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="card shadow border-0">
        <div class="card-header bg-light py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-secondary fw-semibold">Detail Pemesanan</h4>
            </div>
        </div>
        
        <div class="card-body p-4">
            <!-- Pemesanan Detail Section -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3 mb-md-0">
                    <img src="{{ asset('storage/' . $pemesanan->paket->gambar) }}" 
                         class="img-fluid shadow-sm" alt="{{ $pemesanan->paket->nama_paket }}">
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="text-muted mb-3 fw-semibold">Informasi Paket</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <span class="fw-bold">Nama Paket:</span> 
                                        <span class="ms-2">{{ $pemesanan->paket->nama_paket }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-bold">Tanggal Pemesanan:</span>
                                        <span class="ms-2">{{ Carbon::parse($pemesanan->tanggal_pesan)->format('d/m/Y') }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-bold">Jumlah Pesanan:</span> 
                                        <span class="ms-2">{{ $pemesanan->jumlah_orang }} pax</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-bold">Total Harga:</span> 
                                        <span class="ms-2 text-success">Rp {{ number_format($pemesanan->harga, 2, ',', '.') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="text-muted mb-3 fw-semibold">Informasi Pembayaran</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <span class="fw-bold">Tanggal Pelunasan:</span>
                                        <span class="ms-2">{{ $pemesanan->tanggal_pelunasan ? Carbon::parse($pemesanan->tanggal_pelunasan)->format('d/m/Y') : '-' }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-bold">Metode Pembayaran:</span>
                                        <span class="ms-2">{{ $pemesanan->metode_pembayaran ?: '-' }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-bold">Status Pelunasan:</span>
                                        <span class="ms-2 badge {{ $pemesanan->is_pembayaran_lunas ? 'bg-success' : 'bg-warning' }} px-3 py-2">
                                            <i class="fas {{ $pemesanan->is_pembayaran_lunas ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                                            {{ $pemesanan->is_pembayaran_lunas ? 'Lunas' : 'Belum Lunas' }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('pemesanan.jemaah.list', $pemesanan->id) }}" 
                                   class="btn btn-sm btn-primary px-3 py-2">
                                    <i class="fas fa-users me-2"></i>Data Jema'ah
                                </a>
                                <a href="{{ route('member.tagihan', $pemesanan->id) }}" 
                                   class="btn btn-sm btn-success px-3 py-2">
                                    <i class="fas fa-file-invoice me-2"></i>Lihat Tagihan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                        <!-- Pemesanan Kamar Section -->
            <!-- ORIGINAL -->
            <!--
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-bold"><i data-feather="home" class="icon-sm me-2"></i>Pemesanan Kamar</h5>
                    <a href="/pemesanan-kamar" class="btn btn-primary btn-sm">
                        <i data-feather="plus" class="icon-sm me-1"></i>
                        Tambah Kamar
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Tipe Kamar</th>
                                <th>Jumlah Pengisi</th>
                                <th>Harga</th>
                                <th>Keterangan</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pemesanan->pemesananKamars->count() > 0)
                                @foreach ($pemesanan->pemesananKamars as $kamar)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kamar->tipe_kamar }}</td>
                                        <td>{{ $kamar->jumlah_pengisi }}</td>
                                        <td>Rp {{ number_format($kamar->harga, 2, ',', '.') }}</td>
                                        <td>{{ $kamar->keterangan ?: '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="/data-permintaan" class="btn btn-outline-primary btn-sm me-2" title="Lihat Detail">
                                                    <i data-feather="eye" class="icon-xs"></i>
                                                    Lihat
                                                </a>
                                                <a href="#" class="btn btn-outline-warning btn-sm me-2" title="Edit Data">
                                                    <i data-feather="edit" class="icon-xs"></i>
                                                    Edit
                                                </a>
                                                <form action="/hapus-pemesanan-kamar/{{ $kamar->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm tombol-hapus" title="Hapus Data">
                                                        <i data-feather="trash-2" class="icon-xs"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i data-feather="info" class="icon-md mb-2"></i>
                                        <p class="mb-0">Belum ada pemesanan kamar</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            -->
            <!-- MODIFIED -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-home me-2"></i>Pemesanan Kamar</h5>
                    <a href="/pemesanan-kamar" 
                       class="btn btn-sm btn-primary px-3 py-2">
                        <i class="fas fa-plus me-2"></i>Tambah Kamar
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th class="px-4 py-3" width="5%">#</th>
                                <th class="px-4 py-3">Tipe Kamar</th>
                                <th class="px-4 py-3">Jumlah Pengisi</th>
                                <th class="px-4 py-3">Harga</th>
                                <th class="px-4 py-3">Keterangan</th>
                                <th class="px-4 py-3" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pemesanan->pemesananKamars->count() > 0)
                                @foreach ($pemesanan->pemesananKamars as $kamar)
                                    <tr class="align-middle">
                                        <td class="px-4">{{ $loop->iteration }}</td>
                                        <td class="px-4">{{ $kamar->tipe_kamar }}</td>
                                        <td class="px-4">{{ $kamar->jumlah_pengisi }}</td>
                                        <td class="px-4">Rp {{ number_format($kamar->harga, 2, ',', '.') }}</td>
                                        <td class="px-4">{{ $kamar->keterangan ?: '-' }}</td>
                                        <td class="px-4">
                                            <div class="d-flex gap-2">
                                                <a href="/data-permintaan" 
                                                   class="btn btn-sm btn-outline-primary btn-icon-only" title="Permintaan Kamar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/pemesanan-kamar/edit/{{ $kamar->id }}" 
                                                   class="btn btn-sm btn-outline-warning btn-icon-only" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="/hapus-pemesanan-kamar/{{ $kamar->id }}" 
                                                      method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemesanan kamar ini?');">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger btn-icon-only" 
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                                        <p class="mb-0">Belum ada pemesanan kamar</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END MODIFIED -->

            <!-- Pemesanan Ekstra Section -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i>Pemesanan Ekstra</h5>
                    <a href="{{ route('pemesanan-ekstra.create', $pemesanan->id) }}" 
                       class="btn btn-sm btn-primary px-3 py-2">
                        <i class="fas fa-plus me-2"></i>Tambah Ekstra
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th class="px-4 py-3" width="5%">#</th>
                                <th class="px-4 py-3">Ekstra</th>
                                <th class="px-4 py-3">Jumlah</th>
                                <th class="px-4 py-3">Total Harga</th>
                                <th class="px-4 py-3">Keterangan</th>
                                <th class="px-4 py-3" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pemesanan->pemesananEkstras as $index => $pemesananEkstra)
                                <tr class="align-middle">
                                    <td class="px-4">{{ $index + 1 }}</td>
                                    <td class="px-4">{{ $pemesananEkstra->ekstra }}</td>
                                    <td class="px-4">{{ $pemesananEkstra->jumlah }}</td>
                                    <td class="px-4">Rp {{ number_format($pemesananEkstra->total_harga, 2, ',', '.') }}</td>
                                    <td class="px-4">{{ $pemesananEkstra->keterangan ?? '-' }}</td>
                                    <td class="px-4">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('pemesanan-ekstra.edit', $pemesananEkstra) }}" 
                                               class="btn btn-sm btn-outline-warning px-3 py-2" title="Edit Data">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('pemesanan-ekstra.destroy', $pemesananEkstra) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemesanan ekstra ini?');">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger px-3 py-2" 
                                                        title="Hapus Data">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                                        <p class="mb-0">Tidak ada pemesanan ekstra</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pembayaran Section -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-credit-card me-2"></i>Pembayaran</h5>
                    <a href="{{ route('pembayaran.create', $pemesanan->id) }}" 
                       class="btn btn-sm btn-primary px-3 py-2">
                        <i class="fas fa-plus me-2"></i>Tambah Pembayaran
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th class="px-4 py-3" width="5%">#</th>
                                <th class="px-4 py-3">Jumlah Pembayaran</th>
                                <th class="px-4 py-3">Metode Pembayaran</th>
                                <th class="px-4 py-3">Tanggal Pembayaran</th>
                                <th class="px-4 py-3">Bukti Pembayaran</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pemesanan->pembayarans->count() > 0)
                                @foreach ($pemesanan->pembayarans as $pembayaran)
                                    <tr class="align-middle">
                                        <td class="px-4">{{ $loop->iteration }}</td>
                                        <td class="px-4">Rp {{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}</td>
                                        <td class="px-4">{{ $pembayaran->metode_pembayaran }}</td>
                                        <td class="px-4">{{ Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y') }}</td>
                                        <td class="px-4">
                                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" 
                                               class="btn btn-sm btn-outline-info px-3 py-2" target="_blank">
                                                <i class="fas fa-file me-1"></i>Lihat Bukti
                                            </a>
                                        </td>
                                        <td class="px-4">
                                            @if($pembayaran->status_pembayaran == 'diterima')
                                                <span class="badge bg-success text-white px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>Diterima
                                                </span>
                                            @elseif($pembayaran->status_pembayaran == 'ditolak')
                                                <span class="badge bg-danger text-white px-3 py-2">
                                                    <i class="fas fa-times-circle me-1"></i>Ditolak
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark px-3 py-2">
                                                    <i class="fas fa-clock me-1"></i>Tertunda
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                                        <p class="mb-0">Belum ada riwayat pembayaran</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Status Info -->
            <div class="alert alert-info mt-4 shadow-sm">
                <div class="d-flex align-items-start">
                    <i class="fas fa-info-circle me-2 mt-1 fa-lg"></i>
                    <div>
                        <h6 class="alert-heading mb-2 fw-semibold">Status Pembayaran</h6>
                        <ul class="mb-0 small">
                            <li><strong>Tertunda:</strong> Pembayaran sedang menunggu verifikasi</li>
                            <li><strong>Diterima:</strong> Pembayaran telah diverifikasi dan diterima</li>
                            <li><strong>Ditolak:</strong> Pembayaran tidak memenuhi kriteria</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection