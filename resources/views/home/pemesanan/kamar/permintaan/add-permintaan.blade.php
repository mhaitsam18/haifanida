<!-- resources/views/home/pemesanan/kamar/permintaan/add-berkas-jemaah.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container py-4 mb-5">
    <!-- Form Header with Modern Design -->
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-0 text-primary">Tambah Permintaan Kamar</h2>
            <p class="text-muted">Silakan pilih permintaan kamar yang diinginkan</p>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ route('permintaan-kamar.store') }}" method="POST">
        @csrf
        
        <!-- Modern Card-Based Form Layout -->
        <div class="row justify-content-center">
            <!-- Permintaan Kamar Card -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-2">
                        <h5 class="mb-0">
                            <i class="fas fa-bed me-2"></i>
                            Data Permintaan Kamar
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="permintaan_kamar" class="form-label fw-semibold">Permintaan Kamar <span class="text-danger">*</span></label>
                            <select class="form-select" id="permintaan_kamar" name="permintaan_kamar" required onchange="updateHarga()">
                                <option selected disabled value="">Pilih Permintaan Kamar</option>
                                <option value="1" data-harga="500000">Kamar Standard</option>
                                <option value="2" data-harga="800000">Kamar Deluxe</option>
                                <option value="3" data-harga="1200000">Kamar Suite</option>
                                <option value="4" data-harga="1500000">Kamar Family</option>
                                <option value="5" data-harga="2000000">Kamar Presidential</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="harga" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga akan muncul otomatis" readonly>
                            </div>
                            <small class="text-muted">Harga disesuaikan otomatis dari jenis permintaan kamar</small>
                        </div>
                        
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
                <button type="button" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </button>
                <div>
                    <button type="reset" class="btn btn-light me-2">
                        <i class="fas fa-redo me-1"></i>Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Data
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
</style>
@endsection

@section('scripts')
<script>
    // Function to update harga based on permintaan kamar selection
    function updateHarga() {
        const permintaanSelect = document.getElementById('permintaan_kamar');
        const hargaInput = document.getElementById('harga');
        
        if (permintaanSelect.selectedIndex > 0) {
            const selectedOption = permintaanSelect.options[permintaanSelect.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            
            // Format the harga with Indonesian Rupiah format
            const formattedHarga = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(harga);
            
            hargaInput.value = formattedHarga;
        } else {
            hargaInput.value = '';
        }
    }
    
    // Form validation
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
            const permintaanSelect = document.getElementById('permintaan_kamar');
            
            if (permintaanSelect.selectedIndex === 0) {
                event.preventDefault();
                permintaanSelect.classList.add('is-invalid');
                setTimeout(() => permintaanSelect.classList.remove('is-invalid'), 3000);
            }
        });
    });
</script>
@endsection