@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/jemaah.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
    $jumlahJemaahTerdaftar = $jemaahs->count();
    $batasJemaah = $pemesanan->jumlah_orang;
    $sisaSlot = $batasJemaah - $jumlahJemaahTerdaftar;
    $sudahPenuh = $sisaSlot <= 0;
@endphp

<div class="container py-5">

    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">DATA JEMAAH</h2>
            <p class="text-muted mb-0">
                <i class="fas fa-users me-2"></i>
                {{ $jumlahJemaahTerdaftar }} dari {{ $batasJemaah }} jemaah terdaftar
                @if($sisaSlot > 0)
                    <span class="badge bg-success ms-2">{{ $sisaSlot }} slot tersisa</span>
                @else
                    <span class="badge bg-danger ms-2">Slot penuh</span>
                @endif
            </p>
        </div>
        <div class="col-md-6 text-end">
            @if(!$sudahPenuh)
                <a href="{{ route('pemesanan.jemaah.create', $pemesanan->id) }}" class="btn btn-primary me-2 px-4 py-2">
                    <i class="fas fa-plus-circle me-2"></i> Tambah
                </a>
            @else
                <button class="btn btn-secondary me-2 px-4 py-2" disabled>
                    <i class="fas fa-plus-circle me-2"></i> Slot Penuh
                </button>
            @endif
            <a href="{{ route('pemesanan.detail', $pemesanan->id) }}" class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Alerts -->
    @if($sisaSlot <= 2 && $sisaSlot > 0)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Pengingat:</strong> Tersisa {{ $sisaSlot }} slot jemaah lagi yang belum ditambahkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif($sudahPenuh)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Informasi:</strong> Semua slot jemaah sudah terisi penuh ({{ $batasJemaah }} jemaah).
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Container -->
    <div class="card shadow border-0">
        <div class="card-header bg-light border-0 py-3">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-0 text-secondary fw-semibold">Data Jemaah Keberangkatan {{ $paket->nama_paket }}</h4>
                </div>
                <div class="col-md-4 text-end">
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" 
                            style="width: {{ ($jumlahJemaahTerdaftar / $batasJemaah) * 100 }}%" 
                            aria-valuenow="{{ $jumlahJemaahTerdaftar }}" 
                            aria-valuemin="0" 
                            aria-valuemax="{{ $batasJemaah }}">
                        </div>
                    </div>
                    <small class="text-muted">{{ number_format(($jumlahJemaahTerdaftar / $batasJemaah) * 100, 1) }}% terisi</small>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($jemaahs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th class="px-4 py-3" width="5%">#</th>
                                <th class="px-4 py-3" width="20%">Nama Lengkap</th>
                                <th class="px-4 py-3" width="20%">Email</th>
                                <th class="px-4 py-3" width="15%">Nomor Ponsel</th>
                                <th class="px-4 py-3" width="10%">Foto</th>
                                <th class="px-4 py-3" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jemaahs as $jemaah)
                                <tr class="align-middle">
                                    <td class="px-4">{{ $loop->iteration }}</td>
                                    <td class="px-4 fw-bold" style="color: #4e73df;">
                                        {{ $jemaah->nama_lengkap }}
                                        @if($jemaah->is_pemesan)
                                            <span class="badge bg-info ms-2">Pemesan</span>
                                        @endif
                                    </td>
                                    <td class="px-4">{{ $jemaah->email }}</td>
                                    <td class="px-4">{{ $jemaah->nomor_telepon }}</td>
                                    <td class="px-4">
                                        @if($jemaah->foto)
                                            <img src="{{ asset('storage/' . $jemaah->foto) }}" alt="Foto"
                                                class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="px-4 print-hilang">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id]) }}" 
                                                class="btn btn-sm btn-success px-3 py-2">
                                                <i class="fas fa-folder me-1"></i> Berkas
                                            </a>
                                            <a href="{{ route('pemesanan.jemaah.edit', [$pemesanan->id, $jemaah->id]) }}" 
                                                class="btn btn-sm btn-warning px-3 py-2">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('jemaah.destroy', $jemaah->id) }}" method="POST" 
                                                class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jemaah ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger px-3 py-2 tombol-hapus">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada jemaah yang terdaftar</h5>
                    <p class="text-muted">Silakan tambahkan data jemaah untuk paket {{ $paket->nama_paket }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Pagination -->
        <div class="mt-3 d-flex justify-content-end">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.tombol-hapus');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const confirmation = confirm(
                    'Apakah Anda yakin ingin menghapus data jemaah ini?\n' +
                    'Slot akan tersedia kembali setelah dihapus.'
                );
                if (confirmation) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
