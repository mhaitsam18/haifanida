<!-- resources/views/home/pemesanan/ekstra/add-pemesanan-ekstra.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container py-4 mb-5">
    <!-- Form Header with Modern Design -->
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-0 text-primary">Tambah Pemesanan Ekstra</h2>
            <p class="text-muted">Silakan pilih layanan tambahan yang diinginkan</p>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ route('pemesanan-ekstra.store') }}" method="POST">
        @csrf
        
        <!-- Modern Card-Based Form Layout -->
        <div class="row justify-content-center">
            <!-- Pemesanan Ekstra Card -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-2">
                        <h5 class="mb-0">
                            <i class="fas fa-concierge-bell me-2"></i>
                            Data Pemesanan Ekstra
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="jenis_ekstra" class="form-label fw-semibold">Ekstra / Tambahan <span class="text-danger">*</span></label>
                            <select class="form-select" id="jenis_ekstra" name="jenis_ekstra" required onchange="updateHargaSatuan()">
                                <option selected disabled value="">Pilih Jenis Ekstra</option>
                                @foreach ($ekstras as $ekstra)
                                    <option value="{{ $ekstra->id }}" data-harga="{{ $ekstra->harga_default }}">
                                        {{ $ekstra->nama_ekstra }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- DEBUG INFO START -->
                            <div class="mt-3 p-3 bg-light border rounded">
                                <strong>🔍 DEBUG INFO - Data Ekstras:</strong>
                                <div class="mt-2">
                                    <small class="text-muted">Total data: {{ count($ekstras) }}</small>
                                </div>
                                @if(count($ekstras) > 0)
                                    <div class="table-responsive mt-2">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Ekstra</th>
                                                    <th>Jenis</th>
                                                    <th>Harga Default</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ekstras as $ekstra)
                                                <tr>
                                                    <td>{{ $ekstra->id }}</td>
                                                    <td>{{ $ekstra->nama_ekstra }}</td>
                                                    <td>{{ $ekstra->jenis_ekstra ?? 'NULL' }}</td>
                                                    <td>
                                                        @if($ekstra->harga_default)
                                                            <span class="text-success">Rp {{ number_format($ekstra->harga_default, 0, ',', '.') }}</span>
                                                        @else
                                                            <span class="text-danger">NULL/KOSONG</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-warning mt-2">
                                        <strong>⚠️ Tidak ada data ekstras yang ditemukan!</strong><br>
                                        <small>Periksa query di controller: whereIn('jenis_ekstra', ['perlengkapan', 'jasa', 'pesawat'])</small>
                                    </div>
                                @endif
                                
                                <!-- Debug Raw Data -->
                                <details class="mt-3">
                                    <summary class="text-primary" style="cursor: pointer;">📋 Raw Data (JSON)</summary>
                                    <pre class="mt-2 p-2 bg-dark text-light rounded" style="font-size: 11px; max-height: 200px; overflow-y: auto;">{{ json_encode($ekstras->toArray(), JSON_PRETTY_PRINT) }}</pre>
                                </details>
                            </div>
                            <!-- DEBUG INFO END -->
                        
                        
                        <div class="mb-3">
                            <label for="harga_satuan" class="form-label fw-semibold">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" placeholder="Harga satuan akan muncul otomatis" readonly>
                            </div>
                            <small class="text-muted">Harga per unit layanan</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jumlah" class="form-label fw-semibold">Jumlah <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="1" required onchange="hitungTotalHarga()" onkeyup="hitungTotalHarga()">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="total_harga" class="form-label fw-semibold">Total Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                <input type="text" class="form-control" id="total_harga" name="total_harga" placeholder="Total harga akan dihitung otomatis" readonly>
                            </div>
                            <small class="text-muted">Total harga dihitung dari harga satuan × jumlah</small>
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
                <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </button>
                <div>
                    <button type="reset" class="btn btn-light me-2" onclick="resetForm()">
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

@section('scripts')
<script>
    // Function to update harga satuan based on jenis ekstra selection
    function updateHargaSatuan() {
        const ekstraSelect = document.getElementById('jenis_ekstra');
        const hargaSatuanInput = document.getElementById('harga_satuan');
        
        if (ekstraSelect.selectedIndex > 0) {
            const selectedOption = ekstraSelect.options[ekstraSelect.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');

            if (harga) {
                const hargaAngka = parseInt(harga);
                
                const formattedHarga = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(hargaAngka);
                
                hargaSatuanInput.value = formattedHarga;

                hitungTotalHarga();
            } else {
                hargaSatuanInput.value = '';
            }
        } else {
            hargaSatuanInput.value = '';
            document.getElementById('total_harga').value = '';
        }
    }

    
    // Function to calculate total harga
    function hitungTotalHarga() {
        const ekstraSelect = document.getElementById('jenis_ekstra');
        const jumlahInput = document.getElementById('jumlah');
        const totalHargaInput = document.getElementById('total_harga');
        
        if (ekstraSelect.selectedIndex > 0 && jumlahInput.value > 0) {
            const selectedOption = ekstraSelect.options[ekstraSelect.selectedIndex];
            const hargaSatuan = parseInt(selectedOption.getAttribute('data-harga'));
            const jumlah = parseInt(jumlahInput.value);
            
            const totalHarga = hargaSatuan * jumlah;
            
            // Format the total harga with Indonesian Rupiah format
            const formattedTotalHarga = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(totalHarga);
            
            totalHargaInput.value = formattedTotalHarga;
            
            // Add highlight animation
            totalHargaInput.classList.add('highlight-change');
            setTimeout(() => totalHargaInput.classList.remove('highlight-change'), 1000);
        } else {
            totalHargaInput.value = '';
        }
    }
    
    // Function to increment jumlah
    function incrementJumlah() {
        const jumlahInput = document.getElementById('jumlah');
        jumlahInput.value = parseInt(jumlahInput.value) + 1;
        hitungTotalHarga();
    }
    
    // Function to decrement jumlah
    function decrementJumlah() {
        const jumlahInput = document.getElementById('jumlah');
        if (parseInt(jumlahInput.value) > 1) {
            jumlahInput.value = parseInt(jumlahInput.value) - 1;
            hitungTotalHarga();
        }
    }
    
    // Function to reset the form
    function resetForm() {
        document.getElementById('jenis_ekstra').selectedIndex = 0;
        document.getElementById('jumlah').value = 1;
        document.getElementById('harga_satuan').value = '';
        document.getElementById('total_harga').value = '';
        document.getElementById('keterangan').value = '';
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
            const ekstraSelect = document.getElementById('jenis_ekstra');
            const jumlahInput = document.getElementById('jumlah');
            
            let isValid = true;
            
            if (ekstraSelect.selectedIndex === 0) {
                ekstraSelect.classList.add('is-invalid');
                setTimeout(() => ekstraSelect.classList.remove('is-invalid'), 3000);
                isValid = false;
            }
            
            if (jumlahInput.value <= 0) {
                jumlahInput.classList.add('is-invalid');
                setTimeout(() => jumlahInput.classList.remove('is-invalid'), 3000);
                isValid = false;
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>
@endsection