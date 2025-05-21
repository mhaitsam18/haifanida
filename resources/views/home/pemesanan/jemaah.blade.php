<!-- resources/views/home/pemesanan/jemaah.blade.php -->
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
            <a href="#" class="btn btn-primary me-2">
                <i class="fas fa-plus-circle me-1"></i> Tambah
            </a>
            <a href="#" class="btn btn-secondary">
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
                        <tr class="align-middle">
                            <td class="px-3 py-3">1</td>
                            <td class="px-3 py-3">Budi</td>
                            <td class="px-3 py-3">budi3@gmail.com</td>
                            <td class="px-3 py-3">+6282117</td>
                            <td class="px-3 py-3">
                                <img src="https://via.placeholder.com/40" alt="Foto" class="rounded-circle" width="40" height="40">
                            </td>
                            <td class="px-3 py-3">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                    <a href="#" class="btn btn-success btn-sm mx-1">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td class="px-3 py-3">2</td>
                            <td class="px-3 py-3">Ratu</td>
                            <td class="px-3 py-3">ratu@gmail.com</td>
                            <td class="px-3 py-3">+628138373</td>
                            <td class="px-3 py-3">
                                <span class="badge bg-secondary p-2">Foto</span>
                            </td>
                            <td class="px-3 py-3">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                    <a href="#" class="btn btn-success btn-sm mx-1">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
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