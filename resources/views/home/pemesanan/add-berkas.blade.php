<!-- resources/views/home/pemesanan/tambah-berkas-jemaah.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container py-4 mb-5">
    <!-- Form Header with Modern Design -->
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-0 text-primary">Tambah Berkas Jemaah</h2>
            <p class="text-muted">Silakan unggah dokumen persyaratan untuk jemaah</p>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ route('berkas-jemaah.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="document_type" class="form-label fw-semibold">Nama Berkas <span class="text-danger">*</span></label>
                            <select class="form-select" id="document_type" name="document_type" required>
                                <option value="" selected disabled>-- Pilih Jenis Berkas --</option>
                                <option value="ktp">KTP</option>
                                <option value="kk">Kartu Keluarga</option>
                                <option value="paspor">Paspor</option>
                                <option value="pas_foto">Pas Foto Background Putih</option>
                                <option value="buku_nikah">Buku Nikah</option>
                                <option value="akta_lahir">Akta Kelahiran</option>
                                <option value="vaksin_covid">Sertifikat Vaksin COVID-19</option>
                                <option value="vaksin_meningitis">Sertifikat Vaksin Meningitis</option>
                                <option value="izin_keluarga">Surat Izin Keluarga</option>
                                <option value="bukti_pembayaran">Bukti Pembayaran</option>
                                <option value="lainnya">Dokumen Lainnya</option>
                            </select>
                        </div>
                        
                        <!-- Additional field for "Lainnya" that will be shown only when "Lainnya" is selected -->
                        <div class="mb-3 d-none" id="other_document_div">
                            <label for="other_document_name" class="form-label fw-semibold">Nama Berkas Lainnya <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                <input type="text" class="form-control" id="other_document_name" name="other_document_name" placeholder="Masukkan nama berkas">
                            </div>
                        </div>
                        
                        <!-- File Upload -->
                        <div class="mb-3">
                            <label for="document_file" class="form-label fw-semibold">Unggah File <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                <input type="file" class="form-control" id="document_file" name="document_file" required>
                            </div>
                            <small class="text-muted">Format file yang didukung: PDF, JPG, PNG. Ukuran maksimal: 2MB</small>
                        </div>

                        <!-- Additional Note Field -->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan / Catatan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan atau catatan tambahan (opsional)"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="row justify-content-center mt-3">
            <div class="col-md-8 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </button>
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

{{-- @section('styles')
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
@endsection --}}

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle "Other Document Name" field when "Lainnya" is selected
        const documentTypeSelect = document.getElementById('document_type');
        const otherDocumentDiv = document.getElementById('other_document_div');
        const otherDocumentInput = document.getElementById('other_document_name');
        
        documentTypeSelect.addEventListener('change', function() {
            if (this.value === 'lainnya') {
                otherDocumentDiv.classList.remove('d-none');
                otherDocumentInput.setAttribute('required', 'required');
            } else {
                otherDocumentDiv.classList.add('d-none');
                otherDocumentInput.removeAttribute('required');
            }
        });
        
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
            const documentTypeSelect = document.getElementById('document_type');
            const documentFileInput = document.getElementById('document_file');
            
            if (documentTypeSelect.selectedIndex === 0) {
                event.preventDefault();
                documentTypeSelect.classList.add('is-invalid');
                setTimeout(() => documentTypeSelect.classList.remove('is-invalid'), 3000);
            }
            
            if (!documentFileInput.files.length) {
                event.preventDefault();
                documentFileInput.classList.add('is-invalid');
                setTimeout(() => documentFileInput.classList.remove('is-invalid'), 3000);
            } else {
                // File size validation (max 2MB)
                const fileSize = documentFileInput.files[0].size;
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                
                if (fileSize > maxSize) {
                    event.preventDefault();
                    documentFileInput.classList.add('is-invalid');
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    setTimeout(() => documentFileInput.classList.remove('is-invalid'), 3000);
                }
            }
        });
        
        // Preview file name after selection
        document.getElementById('document_file').addEventListener('change', function() {
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