<!-- resources/views/home/pemesanan/kamar/permintaan/add-permintaan.blade.php -->
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

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Form -->
    <form action="{{ route('permintaan-kamar.store') }}" method="POST" id="permintaanForm">
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
                            <label for="permintaan_kamar" class="form-label fw-semibold">
                                Jenis Kamar <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('permintaan_kamar') is-invalid @enderror" 
                                    id="permintaan_kamar" 
                                    name="permintaan_kamar" 
                                    required 
                                    onchange="updateHarga()">
                                <option selected disabled value="">Pilih Jenis Kamar</option>
                                @forelse($jenisKamar as $kamar)
                                    <option value="{{ $kamar->nama_ekstra }}" 
                                            data-harga="{{ $kamar->harga_default }}"
                                            data-nama="{{ $kamar->nama_ekstra }}"
                                            {{ old('permintaan_kamar') == $kamar->nama_ekstra ? 'selected' : '' }}>
                                        {{ $kamar->nama_ekstra }} 
                                        @if($kamar->deskripsi)
                                            - {{ Str::limit($kamar->deskripsi, 50) }}
                                        @endif
                                    </option>
                                @empty
                                    <option disabled>Tidak ada jenis kamar tersedia</option>
                                @endforelse
                            </select>
                            @error('permintaan_kamar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Pilih jenis kamar sesuai kebutuhan Anda</small>
                        </div>

                        <!-- DEBUG INFO START -->
                        @if(config('app.debug'))
                        <div class="mt-3 p-3 bg-light border rounded">
                            <strong>🔍 DEBUG INFO - Form Permintaan Kamar:</strong>
                            <div class="mt-2">
                                <small class="text-muted">Total jenis kamar: {{ count($jenisKamar) }}</small>
                            </div>
                            
                            @if(count($jenisKamar) > 0)
                                <div class="table-responsive mt-2">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Ekstra</th>
                                                <th>Harga</th>
                                                <th>Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jenisKamar as $kamar)
                                            <tr>
                                                <td>{{ $kamar->id ?? 'NULL' }}</td>
                                                <td>
                                                    {{ $kamar->nama_ekstra ?? 'NULL' }}
                                                    @if(old('permintaan_kamar') == $kamar->nama_ekstra)
                                                        <span class="badge bg-warning text-dark">OLD</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($kamar->harga_default)
                                                        <span class="text-success">Rp {{ number_format($kamar->harga_default, 0, ',', '.') }}</span>
                                                    @else
                                                        <span class="text-danger">NULL</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($kamar->deskripsi)
                                                        <small>{{ Str::limit($kamar->deskripsi, 50) }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            
                            <!-- Raw Data -->
                            <details class="mt-2">
                                <summary class="text-primary" style="cursor: pointer;">📋 Raw Data (JSON)</summary>
                                <pre class="mt-2 p-2 bg-dark text-light rounded" style="font-size: 11px; max-height: 150px; overflow-y: auto;">{{ json_encode($jenisKamar->toArray(), JSON_PRETTY_PRINT) }}</pre>
                            </details>
                        </div>
                        @endif
                        <!-- DEBUG INFO END -->
                        
                        <!-- Display Room Description (if available) -->
                        <div class="mb-3" id="deskripsi-container" style="display: none;">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Deskripsi:</strong> <span id="deskripsi-text"></span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="harga" class="form-label fw-semibold">
                                Harga <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                <input type="text" 
                                       class="form-control @error('harga') is-invalid @enderror" 
                                       id="harga_display" 
                                       placeholder="Harga akan muncul otomatis" 
                                       value="{{ old('harga') ? 'Rp ' . number_format(old('harga'), 0, ',', '.') : '' }}"
                                       readonly>
                                <input type="hidden" id="harga" name="harga" value="{{ old('harga') }}">
                            </div>
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Harga disesuaikan otomatis dari jenis kamar yang dipilih</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan / Catatan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" 
                                      name="keterangan" 
                                      rows="3" 
                                      maxlength="1000"
                                      placeholder="Masukkan keterangan atau catatan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">
                                <span id="char-count">0</span>/1000 karakter
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="row justify-content-center mt-3">
            <div class="col-md-8 d-flex justify-content-between">
                <a href="{{ route('permintaan-kamar.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <div>
                    <button type="reset" class="btn btn-light me-2" onclick="resetForm()">
                        <i class="fas fa-redo me-1"></i>Reset
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save me-1"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Function to update harga based on permintaan kamar selection
    function updateHarga() {
        const permintaanSelect = document.getElementById('permintaan_kamar');
        const hargaDisplay = document.getElementById('harga_display');
        const hargaInput = document.getElementById('harga');
        const deskripsiContainer = document.getElementById('deskripsi-container');
        const deskripsiText = document.getElementById('deskripsi-text');
        
        if (permintaanSelect.selectedIndex > 0) {
            const selectedOption = permintaanSelect.options[permintaanSelect.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const deskripsi = selectedOption.getAttribute('data-deskripsi');
            
            // Format the harga with Indonesian Rupiah format
            const formattedHarga = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(harga);
            
            hargaDisplay.value = formattedHarga;
            hargaInput.value = harga;
            
            // Show description if available
            if (deskripsi && deskripsi.trim() !== '') {
                deskripsiText.textContent = deskripsi;
                deskripsiContainer.style.display = 'block';
            } else {
                deskripsiContainer.style.display = 'none';
            }
        } else {
            hargaDisplay.value = '';
            hargaInput.value = '';
            deskripsiContainer.style.display = 'none';
        }
    }
    
    // Function to reset form
    function resetForm() {
        document.getElementById('permintaanForm').reset();
        document.getElementById('harga_display').value = '';
        document.getElementById('harga').value = '';
        document.getElementById('deskripsi-container').style.display = 'none';
        updateCharCount();
    }
    
    // Function to update character count
    function updateCharCount() {
        const keteranganTextarea = document.getElementById('keterangan');
        const charCount = document.getElementById('char-count');
        charCount.textContent = keteranganTextarea.value.length;
    }
    
    // Document ready
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize character count
        const keteranganTextarea = document.getElementById('keterangan');
        keteranganTextarea.addEventListener('input', updateCharCount);
        updateCharCount();
        
        // Restore harga if form has old input (validation error)
        const permintaanSelect = document.getElementById('permintaan_kamar');
        if (permintaanSelect.value) {
            updateHarga();
        }
        
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
        document.getElementById('permintaanForm').addEventListener('submit', function(event) {
            const permintaanSelect = document.getElementById('permintaan_kamar');
            const submitBtn = document.getElementById('submitBtn');
            
            if (permintaanSelect.selectedIndex === 0) {
                event.preventDefault();
                permintaanSelect.classList.add('is-invalid');
                permintaanSelect.focus();
                
                // Remove invalid class after 3 seconds
                setTimeout(() => {
                    permintaanSelect.classList.remove('is-invalid');
                }, 3000);
                
                return false;
            }
            
            // Disable submit button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
        });
        
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('show')) {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 150);
                }
            });
        }, 5000);
    });
</script>
@endsection