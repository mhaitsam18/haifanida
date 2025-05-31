@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/jemaah.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-5">
    <!-- Header Section with improved spacing and alignment -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">DATA JEMAAH</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('pemesanan.jemaah.create', $pemesanan->id) }}" class="btn btn-primary me-2 px-4 py-2">
                <i class="fas fa-plus-circle me-2"></i> Tambah
            </a>
            <a href="{{ route('pemesanan.detail',  $pemesanan->id) }}" class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Card container for better visual appearance -->
    <div class="card shadow border-0">
        <div class="card-header bg-light border-0 py-3">
            <h4 class="mb-0 text-secondary fw-semibold">Data Jemaah Keberangkatan 24 Februari 2024</h4>
        </div>
        <div class="card-body p-0">
            <!-- Responsive table with better spacing -->
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
                                <td class="px-4 fw-bold" style="color: #4e73df;">{{ $jemaah->nama_lengkap }}</td>
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

@endsection