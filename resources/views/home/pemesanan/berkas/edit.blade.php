<!-- resources/views/home/pemesanan/berkas/edit.blade.php -->
@extends('layouts.main')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-4">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h2 class="fw-bold text-primary">EDIT BERKAS JEMAAH</h2>
            <h5 class="text-secondary">{{ $jemaah->nama_lengkap }}</h5>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id]) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Error Alert -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card container -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h4 class="mb-0 py-2 text-secondary">Edit Berkas: {{ $berkasJemaah->berkas->nama_berkas }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('pemesanan.jemaah.berkas.update', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Nama Berkas (Read Only) -->
                        <div class="mb-3">
                            <label for="nama_berkas" class="form-label">Nama Berkas</label>
                            <input type="text" class="form-control" id="nama_berkas" 
                                   value="{{ $berkasJemaah->berkas->nama_berkas }}" readonly>
                        </div>

                        <!-- File Upload -->
                        <div class="mb-3">
                            <label for="file_path" class="form-label">File Berkas<span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('file_path') is-invalid @enderror" 
                                   id="file_path" name="file_path" accept=".jpg,.jpeg,.png,.gif,.pdf">
                            <div class="form-text">
                                Format yang diizinkan: JPG, JPEG, PNG, GIF, PDF. Maksimal 3MB.
                                <br>
                            </div>
                            @error('file_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id]) }}" 
                               class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <!-- Current File Preview -->
                        <div class="mb-3">
                            <label class="form-label">File Saat Ini</label>
                            @if($berkasJemaah->file_path)
                                @php
                                    $fileExtension = pathinfo($berkasJemaah->file_path, PATHINFO_EXTENSION);
                                @endphp
                                
                                <div class="border rounded p-3 bg-light">
                                    @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                        <div class="text-center mb-3">
                                            <img src="{{ asset('storage/' . $berkasJemaah->file_path) }}" 
                                                 alt="Current File" class="img-fluid rounded" style="max-height: 200px;">
                                        </div>
                                    @else
                                        <div class="text-center mb-3">
                                            <i class="fas fa-file-pdf fa-4x text-danger"></i>
                                            <div class="mt-2">
                                                <span class="badge bg-secondary">{{ strtoupper($fileExtension) }} File</span>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="text-center">
                                        <a href="{{ asset('storage/' . $berkasJemaah->file_path) }}" 
                                           target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-external-link-alt me-1"></i> Lihat File
                                        </a>
                                    </div>
                                    
                                    <div class="mt-2 text-center">
                                        <small class="text-muted">
                                            Diupload: {{ Carbon::parse($berkasJemaah->updated_at)->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @else
                                <div class="border rounded p-3 bg-light text-center">
                                    <i class="fas fa-file-slash fa-3x text-muted mb-2"></i>
                                    <p class="text-muted mb-0">Tidak ada file</p>
                                </div>
                            @endif
                        </div>

                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    .gap-2 {
        gap: 0.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    
    .alert-info {
        border-left: 4px solid #0dcaf0;
    }
    
    .border {
        border: 1px solid #dee2e6 !important;
    }
</style>
@endsection