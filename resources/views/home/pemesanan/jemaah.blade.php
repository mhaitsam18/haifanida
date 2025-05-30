@extends('layouts.main')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-4">
    <!-- Header Section with improved spacing and alignment -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">DATA JEMAAH</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('pemesanan.jemaah.create', $pemesanan->id) }}" class="btn btn-primary me-2">
                <i class="fas fa-plus-circle me-1"></i> Tambah
            </a>
            <a href="{{ route('pemesanan.detail',  $pemesanan->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Card container for better visual appearance -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h4 class="mb-0 py-2 text-secondary">Data Jemaah Keberangkatan 24 Februari 2024</h4>
        </div>
        <div class="card-body p-0">
            <!-- Responsive table with better spacing -->
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr class="align-middle">
                            <th class="px-3 py-3" width="5%">#</th>
                            <th class="px-3 py-3" width="20%">Nama Lengkap</th>
                            <th class="px-3 py-3" width="20%">Email</th>
                            <th class="px-3 py-3" width="15%">Nomor Ponsel</th>
                            <th class="px-3 py-3" width="10%">Foto</th>
                            <th class="px-3 py-3" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jemaahs as $jemaah)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jemaah->nama_lengkap }}</td>
                                        <td>{{ $jemaah->email }}</td>
                                        <td>{{ $jemaah->nomor_telepon }}</td>
                                        <td> 
                                            @if($jemaah->foto)
                                                <!-- MODIFIED: Set fixed dimensions for consistent photo size -->
                                                <img src="{{ asset('storage/' . $jemaah->foto) }}" alt="Foto"
                                                     class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td class="print-hilang">
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id]) }}" class="badge btn-primary d-inline-block m-1">Berkas</a>
                                                <a href="{{ route('pemesanan.jemaah.edit', [$pemesanan->id, $jemaah->id]) }}" class="badge bg-success d-inline-block m-1">Edit</a>
                                                <form action="{{ route('jemaah.destroy', $jemaah->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jemaah ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-danger d-inline-block ms-1 mb-1 badge-a tombol-hapus">Hapus</button>
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

    <!-- Pagination could be added here if needed -->
    <div class="mt-3 d-flex justify-content-end">
        <!-- Example pagination placeholder -->
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

<!-- Adding Font Awesome in the layout for icons -->
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    
    .btn-group .btn {
        border-radius: 4px;
    }
</style>
@endsection