@extends('layouts.main')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-4">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">BERKAS JEMAAH</h2>
               <p class="text-info"><strong>{{ $jemaah->nama_lengkap }}</strong></p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('pemesanan.jemaah.add-berkas', [$pemesanan->id, $jemaah->id]) }}" 
               class="btn btn-success me-2">
                <i class="fas fa-plus me-1"></i> Tambah Berkas
            </a>
            <a href="{{ route('pemesanan.jemaah', $pemesanan->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card container -->
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h4 class="mb-0 py-2 text-secondary">Daftar Berkas</h4>
            <div class="d-flex align-items-center">
                <span class="badge bg-info me-2">Total: {{ $berkasJemaahs->count() }} berkas</span>
            </div>
        </div>
        <div class="card-body p-0">
            @if($berkasJemaahs->count() > 0)
                <!-- Responsive table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th class="px-3 py-3" width="5%">#</th>
                                <th class="px-3 py-3" width="25%">Nama Berkas</th>
                                <th class="px-3 py-3" width="20%">File</th>
                                <th class="px-3 py-3" width="15%">Status</th>
                                <th class="px-3 py-3" width="15%">Tanggal Upload</th>
                                <th class="px-3 py-3" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berkasJemaahs as $berkasJemaah)
                                <tr>
                                    <td class="px-3">{{ $loop->iteration }}</td>
                                    <td class="px-3">
                                        <div class="fw-semibold">{{ $berkasJemaah->berkas->nama_berkas }}</div>
                                        @if($berkasJemaah->berkas->keterangan)
                                            <small class="text-muted">{{ $berkasJemaah->berkas->keterangan }}</small>
                                        @endif
                                    </td>
                                    <td class="px-3">
                                        @if($berkasJemaah->file_path)
                                            @php
                                                $fileExtension = pathinfo($berkasJemaah->file_path, PATHINFO_EXTENSION);
                                                $fileName = basename($berkasJemaah->file_path);
                                            @endphp
                                            
                                            @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset('storage/' . $berkasJemaah->file_path) }}" 
                                                     alt="Berkas" class="img-thumbnail mb-2" style="max-width: 80px; max-height: 80px;">
                                            @else
                                                <div class="d-flex align-items-center mb-2">
                                                    @if(strtolower($fileExtension) == 'pdf')
                                                        <i class="fas fa-file-pdf text-danger me-2 fa-2x"></i>
                                                    @elseif(in_array(strtolower($fileExtension), ['doc', 'docx']))
                                                        <i class="fas fa-file-word text-primary me-2 fa-2x"></i>
                                                    @else
                                                        <i class="fas fa-file text-secondary me-2 fa-2x"></i>
                                                    @endif
                                                    <div>
                                                        <div class="small fw-semibold">{{ strtoupper($fileExtension) }} File</div>
                                                        <div class="small text-muted">{{ substr($fileName, 0, 20) }}...</div>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            <div>
                                                <a href="{{ asset('storage/' . $berkasJemaah->file_path) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <i class="fas fa-file-slash text-muted fa-2x mb-2"></i>
                                                <div class="small text-muted">Belum ada file</div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-3">
                                        @if($berkasJemaah->status == 'diverifikasi')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Diverifikasi
                                            </span>
                                        @elseif($berkasJemaah->status == 'ditolak')
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i>Ditolak
                                            </span>
                                            @if($berkasJemaah->catatan)
                                                <div class="small text-danger mt-1">
                                                    <i class="fas fa-exclamation-triangle"></i> {{ $berkasJemaah->catatan }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-clock me-1"></i>Tertunda
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ Carbon::parse($berkasJemaah->created_at)->format('d/m/Y') }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ Carbon::parse($berkasJemaah->created_at)->format('H:i') }}
                                        </small>
                                    </td>
                                    <td class="px-3">
                                        <div class="d-flex flex-column gap-1">
                                            @if($berkasJemaah->status != 'diverifikasi')
                                                <a href="{{ route('pemesanan.jemaah.berkas.edit', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            @endif
                                            
                                            <form action="{{ route('pemesanan.jemaah.berkas.destroy', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas ini? Tindakan ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        {{ $berkasJemaah->status == 'diverifikasi' ? 'disabled' : '' }}>
                                                    <i class="fas fa-trash"></i> Hapus
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
                    <div class="mb-4">
                        <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted mb-2">Belum ada berkas yang diupload</h5>
                        <p class="text-muted mb-4">
                            Silahkan upload berkas yang diperlukan untuk melengkapi pendaftaran Anda.
                        </p>
                        <a href="{{ route('pemesanan.jemaah.add-berkas', [$pemesanan->id, $jemaah->id]) }}" 
                           class="btn btn-success btn-lg">
                            <i class="fas fa-plus me-2"></i> Upload Berkas Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <br>
            <!-- Status Info -->
            <div class="alert alert-info">
                <div class="d-flex align-items-start">
                    <i class="fas fa-info-circle me-2 mt-1"></i>
                    <div>
                        <h6 class="alert-heading mb-1">Status Berkas</h6>
                        <ul class="mb-0 small">
                            <li><strong>Tertunda:</strong> Berkas sedang menunggu verifikasi</li>
                            <li><strong>Diverifikasi:</strong> Berkas telah diverifikasi dan diterima</li>
                            <li><strong>Ditolak:</strong> Berkas tidak memenuhi kriteria</li>
                        </ul>
                    </div>
                </div>
            </div>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    
    .img-thumbnail {
        border-radius: 8px;
        transition: transform 0.2s;
    }
    
    .img-thumbnail:hover {
        transform: scale(1.1);
    }
    
    .badge {
        font-size: 0.8em;
        padding: 0.5em 0.75em;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .gap-1 {
        gap: 0.25rem;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .card-header {
        border-bottom: 1px solid #dee2e6;
        background-color: #f8f9fa !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.025);
    }
    
    .btn:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }
    
    .text-info {
        color: #0dcaf0 !important;
    }
    
    .text-warning {
        color: #ffc107 !important;
    }
    
    .border-info {
        border-color: #0dcaf0 !important;
    }
    
    .border-warning {
        border-color: #ffc107 !important;
    }
</style>
@endsection