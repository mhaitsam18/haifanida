@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/berkas/edit-berkas.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h2 class="fw-bold text-primary mb-2">EDIT BERKAS JEMAAH</h2>
            <h5 class="fw-bold" style="color: #4e73df;">{{ $jemaah->nama_lengkap }}</h5>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id]) }}" 
               class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Error Alert -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Container -->
    <div class="card shadow border-0">
        <div class="card-header bg-light border-0 py-3">
            <h4 class="mb-0 text-secondary fw-semibold">Edit Berkas: {{ $berkasJemaah->berkas->nama_berkas }}</h4>
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
                                   id="file_path" name="file_path" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx">
                            <div class="form-text">
                                Format yang diizinkan: JPG, JPEG, PNG, GIF, PDF, DOC, DOCX. Maksimal 3MB.
                            </div>
                            @error('file_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id]) }}" 
                               class="btn btn-outline-secondary px-3 py-2">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-3 py-2">
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
                                    $fileName = basename($berkasJemaah->file_path);
                                @endphp
                                <div class="border rounded p-3 bg-light">
                                    <div class="d-flex align-items-center mb-3">
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
                                    <div class="text-center">
                                        <a href="{{ route('pemesanan.jemaah.berkas.preview', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" 
                                           target="_blank" class="btn btn-sm btn-outline-primary px-3 py-2">
                                            <i class="fas fa-eye me-1"></i> Lihat
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