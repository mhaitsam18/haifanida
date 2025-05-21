<!-- resources/views/home/pemesanan/tambah-berkas-jemaah.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container py-4">
    <!-- Simple Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-primary">TAMBAH BERKAS JEMAAH</h2>
            <p class="text-muted">Unggah dokumen persyaratan untuk jemaah</p>
        </div>
    </div>

    <!-- Simple Form -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0"><i class="fas fa-file-upload me-2"></i>Form Unggah Berkas</h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Document Type Selection -->
                        <div class="mb-4">
                            <label for="document_type" class="form-label">Nama Berkas <span class="text-danger">*</span></label>
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
                        <div class="mb-4 d-none" id="other_document_div">
                            <label for="other_document_name" class="form-label">Nama Berkas Lainnya <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="other_document_name" name="other_document_name" placeholder="Masukkan nama berkas">
                        </div>
                        
                        <!-- File Upload -->
                        <div class="mb-4">
                            <label for="document_file" class="form-label">Unggah File <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="document_file" name="document_file" required>
                                <label class="input-group-text" for="document_file"><i class="fas fa-upload"></i></label>
                            </div>
                            <div class="form-text text-muted">
                                Format file yang didukung: PDF, JPG, PNG. Ukuran maksimal: 2MB
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="#" class="btn btn-secondary px-4">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Simpan Berkas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
@endsection

@section('scripts')
<script>
    // JavaScript to show/hide "Other Document Name" field when "Lainnya" is selected
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
@endsection