@extends('layouts.main')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            {{-- <div>
                <h4 class="mb-0 text-primary">{{ $title }}</h4>
            </div> --}}
        </div>

        <!-- Main Content Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0 font-weight-bold">Detail Pemesanan</h5>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm rounded-circle" type="button" id="dropdownMenuButton" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i data-feather="more-horizontal"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="/admin/paket/{{ $pemesanan->paket_id }}/jemaah?pemesanan_id={{ $pemesanan->id }}">
                                <i data-feather="users" class="icon-sm me-2"></i> Lihat Jema'ah
                            </a></li>
                            <li><a class="dropdown-item" href="/admin/pemesanan/{{ $pemesanan->id }}/pemesanan-kamar">
                                <i data-feather="home" class="icon-sm me-2"></i> Lihat Pemesanan Kamar
                            </a></li>
                            <li><a class="dropdown-item" href="/admin/pemesanan/{{ $pemesanan->id }}/pemesanan-ekstra">
                                <i data-feather="plus-circle" class="icon-sm me-2"></i> Lihat Pemesanan Ekstra
                            </a></li>
                            <li><a class="dropdown-item" href="/admin/pemesanan/{{ $pemesanan->id }}/pembayaran">
                                <i data-feather="credit-card" class="icon-sm me-2"></i> Lihat Pembayaran
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Pemesanan Detail Section -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $pemesanan->paket->gambar) }}" 
                            class="img-fluid rounded shadow-sm" alt="{{ $pemesanan->paket->nama_paket }}">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h6 class="text-muted mb-2">INFORMASI PAKET</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <span class="fw-bold">Nama Paket:</span> 
                                            <span class="ms-1">{{ $pemesanan->paket->nama_paket }}</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-bold">Tanggal Pemesanan:</span>
                                            <span class="ms-1">{{ Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-bold">Jumlah Pesanan:</span> 
                                            <span class="ms-1">{{ $pemesanan->jumlah_orang }} pax</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-bold">Total Harga:</span> 
                                            <span class="ms-1 text-success">Rp {{ number_format($pemesanan->harga, 2, ',', '.') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h6 class="text-muted mb-2">INFORMASI PEMBAYARAN</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <span class="fw-bold">Tanggal Pelunasan:</span>
                                            <span class="ms-1">{{ Carbon::parse($pemesanan->tanggal_pelunasan)->isoFormat('LL') }}</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-bold">Metode Pembayaran:</span>
                                            <span class="ms-1">{{ $pemesanan->metode_pembayaran }}</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-bold">Status Pelunasan:</span>
                                            <span class="ms-1 badge {{ $pemesanan->is_pembayaran_lunas ? 'bg-success' : 'bg-warning' }}">
                                                {{ $pemesanan->is_pembayaran_lunas ? 'Lunas' : 'Belum Lunas' }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('pemesanan.jemaah.list', $pemesanan->id) }}" 
                                        class="btn btn-primary btn-sm me-2 mb-2">
                                        <i data-feather="users" class="icon-sm me-1"></i>
                                        Data Jema'ah
                                    </a>
                                    <a href="/admin/pemesanan/{{ $pemesanan->id }}/tagihan" 
                                        class="btn btn-success btn-sm me-2 mb-2">
                                        <i data-feather="file-text" class="icon-sm me-1"></i>
                                        Lihat Tagihan
                                    </a>
                                    <a href="{{ route('member.perjalanan-saya', $pemesanan->id)}}" 
                                        class="btn btn-secondary btn-sm mb-2">
                                        <i data-feather="arrow-left" class="icon-sm me-1"></i>
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Pemesanan Kamar Section -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i data-feather="home" class="icon-sm me-2"></i>Pemesanan Kamar</h5>
                        <a href="/pemesanan-kamar" 
                            class="btn btn-primary btn-sm">
                            <i data-feather="plus" class="icon-sm me-1"></i>
                            Tambah Kamar
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
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
                                                    <a href="/admin/pemesanan-kamar/{{ $kamar->id }}" 
                                                        class="btn btn-primary btn-sm">
                                                        <i data-feather="eye" class="icon-xs"></i>
                                                    </a>
                                                    <a href="/admin/pemesanan-kamar/{{ $kamar->id }}/edit" 
                                                        class="btn btn-success btn-sm">
                                                        <i data-feather="edit" class="icon-xs"></i>
                                                    </a>
                                                    <form action="/admin/pemesanan-kamar/{{ $kamar->id }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm tombol-hapus">
                                                            <i data-feather="trash-2" class="icon-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-3 text-muted">
                                            <i data-feather="info" class="icon-md mb-2"></i>
                                            <p>Belum ada pemesanan kamar</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Pemesanan Ekstra Section -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i data-feather="plus-circle" class="icon-sm me-2"></i>Pemesanan Ekstra</h5>
                        <a href="/tambah-ekstra" 
                            class="btn btn-primary btn-sm">
                            <i data-feather="plus" class="icon-sm me-1"></i>
                            Tambah Ekstra
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Ekstra / Tambahan</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Keterangan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pemesanan->pemesananEkstras->count() > 0)
                                    @foreach ($pemesanan->pemesananEkstras as $ekstra)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ekstra->ekstra }}</td>
                                            <td>{{ $ekstra->jumlah }}</td>
                                            <td>Rp {{ number_format($ekstra->total_harga, 2, ',', '.') }}</td>
                                            <td>{{ $ekstra->keterangan ?: '-' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="/admin/pemesanan-ekstra/{{ $ekstra->id }}/edit" 
                                                        class="btn btn-success btn-sm">
                                                        <i data-feather="edit" class="icon-xs"></i>
                                                    </a>
                                                    <form action="/admin/pemesanan-ekstra/{{ $ekstra->id }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm tombol-hapus">
                                                            <i data-feather="trash-2" class="icon-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-3 text-muted">
                                            <i data-feather="info" class="icon-md mb-2"></i>
                                            <p>Belum ada pemesanan ekstra</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Pembayaran Section -->
                <div class="mb-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i data-feather="credit-card" class="icon-sm me-2"></i>Pembayaran</h5>
                        <a href="/tambah-pembayaran" 
                            class="btn btn-primary btn-sm">
                            <i data-feather="plus" class="icon-sm me-1"></i>
                            Tambah Pembayaran
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pemesanan->pembayarans->count() > 0)
                                    @foreach ($pemesanan->pembayarans as $pembayaran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>Rp {{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}</td>
                                            <td>{{ $pembayaran->metode_pembayaran }}</td>
                                            <td>{{ Carbon::parse($pembayaran->tanggal_pembayaran)->isoFormat('LL') }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" 
                                                    class="btn btn-outline-info btn-sm" target="_blank">
                                                    <i data-feather="file" class="icon-xs me-1"></i> Lihat Bukti
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge {{ $pembayaran->status_pembayaran == 'Dikonfirmasi' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $pembayaran->status_pembayaran }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="/admin/pembayaran/{{ $pembayaran->id }}/edit" 
                                                        class="btn btn-success btn-sm">
                                                        <i data-feather="edit" class="icon-xs"></i>
                                                    </a>
                                                    <form action="/admin/pembayaran/{{ $pembayaran->id }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm tombol-hapus">
                                                            <i data-feather="trash-2" class="icon-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center py-3 text-muted">
                                            <i data-feather="info" class="icon-md mb-2"></i>
                                            <p>Belum ada riwayat pembayaran</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection