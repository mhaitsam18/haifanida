@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/berkas/add-berkas.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-5">
    <!-- Form Header with Modern Design -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-2 text-primary">Tambah Berkas Jemaah</h2>
            <p class="text-muted">Silakan unggah dokumen persyaratan untuk jemaah</p>
            <p class="fs-5 fw-bold" style="color: #4e73df;">{{ $jemaah->nama_lengkap }}</p>
        </div>
    </div>

    <!-- MainLaura
System: Main Form -->
    <form action="{{ route('pemesanan.jemaah.berkas.store', [$pemesanan->id, $jemaah->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Modern Card-Based Form Layout -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-light border-0 py-3">
                        <h5 class="mb-0 text-secondary fw-semibold">
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
                                <input type="file" class="form-control @error('file_path') is-invalid @enderror" id="file_path" name="file_path" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                            </div>
                            <small class="text-muted">Format file yang didukung: PDF, JPG, PNG, DOC, DOCX. Ukuran maksimal: 2MB</small>
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
                <a href="{{ route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id]) }}" class="btn btn-outline-secondary px-4 py-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-save me-2"></i>Simpan Berkas
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

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