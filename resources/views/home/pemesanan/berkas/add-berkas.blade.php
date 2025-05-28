@extends('layouts.main')

@section('content')
<div class="container py-4 mb-5">
    <!-- Form Header with Modern Design -->
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-0 text-primary">Tambah Berkas Jemaah</h2>
            <p class="text-muted">Silakan unggah dokumen persyaratan untuk jemaah</p>
            <p class="text-info"><strong>{{ $jemaah->nama_lengkap }}</strong></p>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ route('pemesanan.jemaah.berkas.store', [$pemesanan->id, $jemaah->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Modern Card-Based Form Layout -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-2">
                        <h5 class="mb-0">
                            <i class="fas fa-file-upload me-2"></i>
                            Data Berkas Jemaah
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Document Type Selection -->
                        <div class="mb-3">
                            <label for="berkas_id" class="form-label fw-semibold">Nama Berkas <span class="text-danger">*</span></label>
                            <select class="form-select @error('berkas_id') is-invalid @enderror" id="berkas_id" name="berkas_id" required>
                                <option value="" selected disabled>-- Pilih Jenis Berkas --</option>
                                @foreach ($berkass as $item_berkas)
                                    <option value="{{ $item_berkas->id }}" @selected($item_berkas->id == old('berkas_id'))>
                                        {{ $item_berkas->nama_berkas }}
                                        @if($item_berkas->keterangan)
                                            - {{ $item_berkas->keterangan }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('berkas_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <!-- File Upload -->
                        <div class="mb-3">
                            <label for="file_path" class="form-label fw-semibold">Unggah File <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                <input type="file" class="form-control @error('file_path') is-invalid @enderror" id="file_path" name="file_path" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted">Format file yang didukung: PDF, JPG, PNG. Ukuran maksimal: 2MB</small>
                            @error('file_path')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="row justify-content-center mt-3">
            <div class="col-md-8 d-flex justify-content-between">
                <a href="{{ route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id]) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <div>
                    <button type="reset" class="btn btn-light me-2">
                        <i class="fas fa-redo me-1"></i>Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Berkas
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    body {
        background-color: #f8f9fa;
    }
    
    .form-label {
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .card {
        transition: all 0.2s ease;
        margin-bottom: 1rem;
    }
    
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }
    
    .form-control, .form-select {
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .btn {
        padding: 0.375rem 1rem;
        font-size: 0.9rem;
    }
    
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    
    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }
    
    .text-primary {
        color: #4e73df !important;
    }
    
    .container {
        max-width: 900px;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
    }
    
    textarea {
        resize: none;
    }
    
    /* Custom file input styling */
    input[type="file"]::file-selector-button {
        border: none;
        padding: .2em .4em;
        border-radius: .2em;
        background-color: #f0f0f0;
        transition: 0.2s;
        margin-right: 0.8em;
    }
    
    input[type="file"]::file-selector-button:hover {
        background-color: #e0e0e0;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add subtle animation when focusing form fields
        const formElements = document.querySelectorAll('.form-control, .form-select');
        formElements.forEach(element => {
            element.addEventListener('focus', function() {
                this.closest('.mb-3').style.transition = 'all 0.3s';
                this.closest('.mb-3').style.transform = 'translateX(5px)';
            });
            
            element.addEventListener('blur', function() {
                this.closest('.mb-3').style.transform = 'translateX(0)';
            });
        });
        
        // Form validation before submit
        document.querySelector('form').addEventListener('submit', function(event) {
            const berkasSelect = document.getElementById('berkas_id');
            const fileInput = document.getElementById('file_path');
            
            if (berkasSelect.selectedIndex === 0) {
                event.preventDefault();
                berkasSelect.classList.add('is-invalid');
                setTimeout(() => berkasSelect.classList.remove('is-invalid'), 3000);
            }
            
            if (!fileInput.files.length) {
                event.preventDefault();
                fileInput.classList.add('is-invalid');
                setTimeout(() => fileInput.classList.remove('is-invalid'), 3000);
            } else {
                // File size validation (max 2MB)
                const fileSize = fileInput.files[0].size;
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                
                if (fileSize > maxSize) {
                    event.preventDefault();
                    fileInput.classList.add('is-invalid');
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    setTimeout(() => fileInput.classList.remove('is-invalid'), 3000);
                }
            }
        });
        
        // Preview file name after selection
        document.getElementById('file_path').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Tidak ada file dipilih';
            const fileInfo = document.createElement('div');
            fileInfo.className = 'mt-2 text-muted small';
            fileInfo.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> File dipilih: <strong>${fileName}</strong>`;
            
            // Remove any existing file info
            const existingFileInfo = this.parentElement.nextElementSibling.nextElementSibling;
            if (existingFileInfo && existingFileInfo.classList.contains('text-muted', 'small')) {
                existingFileInfo.remove();
            }
            
            this.parentElement.insertAdjacentElement('afterend', fileInfo);
        });
    });
</script>
@endsection