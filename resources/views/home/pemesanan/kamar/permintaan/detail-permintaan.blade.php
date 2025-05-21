<!-- resources/views/home/pemesanan/kamar/detail-kamar.blade.php -->
@extends('layouts.main')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-4">
    <!-- Header Section with improved spacing and alignment -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">DETAIL PEMESANAN KAMAR</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="" class="btn btn-primary me-2">
                <i class="fas fa-plus-circle me-1"></i> Tambah
            </a>
            <a href="" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Card container for better visual appearance -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <!-- Responsive table with better spacing -->
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr class="align-middle">
                            <th class="px-3 py-3" width="5%">#</th>
                            <th class="px-3 py-3" width="35%">PERMINTAAN <i class="fas fa-sort ms-1"></i></th>
                            <th class="px-3 py-3" width="25%">TAMBAHAN HARGA <i class="fas fa-sort ms-1"></i></th>
                            <th class="px-3 py-3" width="20%">KETERANGAN <i class="fas fa-sort ms-1"></i></th>
                            <th class="px-3 py-3" width="15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td class="px-3 py-3">1</td>
                            <td class="px-3 py-3">Kamar View Kakbah</td>
                            <td class="px-3 py-3">Rp.5.000.000,00</td>
                            <td class="px-3 py-3"></td>
                            <td class="px-3 py-3">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm ms-1">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- You can add more rows here as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-between align-items-center">
        <div class="text-muted">
            Showing 1 to 1 of 1 entries
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    
    .btn-group .btn {
        border-radius: 4px;
    }
    
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .page-link {
        color: #0d6efd;
    }
    
    .page-link:hover {
        color: #0a58ca;
    }
    
    .form-select:focus, .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');
        
        searchButton.addEventListener('click', function() {
            alert('Pencarian: ' + searchInput.value);
            // Implementasi pencarian akan disesuaikan dengan backend
        });
        
        // Entries select change
        const entriesSelect = document.getElementById('entries-select');
        
        entriesSelect.addEventListener('change', function() {
            alert('Menampilkan ' + this.value + ' data per halaman');
            // Implementasi perubahan jumlah entries akan disesuaikan dengan backend
        });
    });
</script>
@endsection