<!-- resources/views/jemaah/create.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container py-4 mb-5">
    <!-- Form Header with Modern Design -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="fw-bold mb-0 text-primary">Tambah Jemaah</h2>
                    <p class="text-muted">Silakan lengkapi data jemaah dengan benar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ route('pemesanan.jemaah.store', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
        <!-- Modern Card-Based Form Layout -->
        <div class="row g-4">
            <!-- Personal Data Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-user-circle me-2"></i>
                            Data Pribadi
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label fw-semibold">Nama Lengkap (Sesuai KTP) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label fw-semibold">Nomor Ponsel <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Contoh: 08123456789" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="foto" class="form-label fw-semibold">Foto <span class="text-info">(3x4 background putih)</span></label>
                            <div class="card bg-light p-3 text-center position-relative">
                                <div id="preview-container" class="mb-2 d-flex justify-content-center">
                                    <img id="preview-image" src="{{ asset('storage/user-photo/crtnC5JGyJ05AGNYE5sN8oD3mDFt6CwYgzRMSzo3.png') }}" alt="Preview" class="img-thumbnail" style="height: 150px; width: auto;">
                                </div>
                                <div class="position-relative">
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewImage(this)">
                                    <label for="foto" class="btn btn-primary w-100 mt-2">
                                        <i class="fas fa-upload me-2"></i>Pilih Foto
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nomor_ktp" class="form-label fw-semibold">Nomor KTP <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" placeholder="16 digit nomor KTP" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Birth Information Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-gradient-info text-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Informasi Kelahiran & Data Diri
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label for="tempat_lahir" class="form-label fw-semibold">Kota Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan kota tempat lahir" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_laki" value="Laki-laki" checked>
                                        <label class="form-check-label" for="jk_laki">
                                            <i class="fas fa-male text-primary me-1"></i> Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_perempuan" value="Perempuan">
                                        <label class="form-check-label" for="jk_perempuan">
                                            <i class="fas fa-female text-danger me-1"></i> Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Golongan Darah</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="golongan_darah" id="gol_a" value="A">
                                        <label class="form-check-label" for="gol_a">A</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="golongan_darah" id="gol_b" value="B">
                                        <label class="form-check-label" for="gol_b">B</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="golongan_darah" id="gol_ab" value="AB">
                                        <label class="form-check-label" for="gol_ab">AB</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="golongan_darah" id="gol_o" value="O">
                                        <label class="form-check-label" for="gol_o">O</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Kewarganegaraan <span class="text-danger">*</span></label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kewarganegaraan" id="wni" value="WNI" checked>
                                    <label class="form-check-label" for="wni">
                                        <i class="fas fa-flag text-danger me-1"></i> WNI
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kewarganegaraan" id="wna" value="WNA">
                                    <label class="form-check-label" for="wna">
                                        <i class="fas fa-globe text-primary me-1"></i> WNA
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
    <label class="form-label fw-semibold">Tingkat Pendidikan</label>
    <div class="row">
        <div class="col-md-6">
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="tingkat_pendidikan" id="sd" value="SD">
                <label class="form-check-label" for="sd">SD/MI/Sederajat</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="tingkat_pendidikan" id="smp" value="SLTP">
                <label class="form-check-label" for="smp">SMP/MTs/Sederajat</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="tingkat_pendidikan" id="sma" value="SLTA">
                <label class="form-check-label" for="sma">SMA/SMK/MA/Sederajat</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="tingkat_pendidikan" id="d3" value="D1/D2/D3">
                <label class="form-check-label" for="d3">D1/D2/D3</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="tingkat_pendidikan" id="d4" value="D4/S1">
                <label class="form-check-label" for="d4">D4/S1</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="tingkat_pendidikan" id="s2" value="S2">
                <label class="form-check-label" for="s2">S2</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="tingkat_pendidikan" id="s3" value="S3">
                <label class="form-check-label" for="s3">S3</label>
            </div>
        </div>
    </div>
</div>

                        
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Masukkan pekerjaan">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Address Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-success text-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Alamat Lengkap
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select class="form-select @error('provinsi') is-invalid @enderror" id="provinsi"
                                        name="provinsi">
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        @foreach ($provinsis as $provinsi)
                                            <option value="{{ $provinsi->provinsi }}" @selected($provinsi->provinsi == old('provinsi'))>
                                                {{ $provinsi->provinsi }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        
                        <div class="mb-3">
                            <label for="kabupaten" class="form-label fw-semibold">Kabupaten/Kota <span class="text-danger">*</span></label>
                            <select class="form-select" id="kabupaten" name="kabupaten" required>
                                <option selected disabled value="">Pilih Kabupaten/Kota</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label fw-semibold">Kecamatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Masukkan kecamatan" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label fw-semibold">Desa/Kelurahan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Masukkan desa/kelurahan" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kode_pos" class="form-label fw-semibold">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Masukkan kode pos">
                        </div>
                        
                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">Detail Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Contoh: Jl. Raya Bogor No. 123, RT 01/RW 02" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Passport Information Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-warning text-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-passport me-2"></i>
                            Informasi Paspor
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="nomor_paspor" class="form-label fw-semibold">Nomor Paspor</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                <input type="text" class="form-control" id="nomor_paspor" name="nomor_paspor" placeholder="Masukkan nomor paspor">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama_sesuai_paspor" class="form-label fw-semibold">Nama Sesuai Paspor</label>
                            <input type="text" class="form-control" id="nama_sesuai_paspor" name="nama_sesuai_paspor" placeholder="Nama lengkap sesuai paspor">
                        </div>
                        
                        <div class="mb-3">
                            <label for="tempat_dikeluarkan" class="form-label fw-semibold">Tempat Dikeluarkan (Kota/Kabupaten)</label>
                            <input type="text" class="form-control" id="tempat_dikeluarkan" name="tempat_dikeluarkan" placeholder="Tempat paspor dikeluarkan">
                        </div>
                        
                        <div class="mb-3">
                            <label for="tanggal_dikeluarkan" class="form-label fw-semibold">Tanggal Dikeluarkan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" id="tanggal_dikeluarkan" name="tanggal_dikeluarkan">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tanggal_kadaluarsa" class="form-label fw-semibold">Tanggal Kadaluarsa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Emergency Contact Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-danger text-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-heartbeat me-2"></i>
                            Kontak Darurat
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="nama_keluarga_terdekat" class="form-label fw-semibold">Nama Keluarga Terdekat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_keluarga_terdekat" name="nama_keluarga_terdekat" placeholder="Masukkan nama keluarga terdekat" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kontak_keluarga_terdekat" class="form-label fw-semibold">Kontak Keluarga Terdekat <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" id="kontak_keluarga_terdekat" name="kontak_keluarga_terdekat" placeholder="Nomor telepon keluarga terdekat" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="d-flex justify-content-between mt-4 pt-3">
            <button type="button" class="btn btn-outline-secondary btn-lg px-5">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </button>
            <div>
                <button type="reset" class="btn btn-light btn-lg me-2">
                    <i class="fas fa-redo me-2"></i>Reset
                </button>
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-save me-2"></i>Simpan Data
                </button>
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
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }
    
    .bg-gradient-info {
        background: linear-gradient(45deg, #36b9cc, #1a8a98);
    }
    
    .bg-gradient-success {
        background: linear-gradient(45deg, #1cc88a, #13855c);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(45deg, #f6c23e, #dda20a);
    }
    
    .bg-gradient-danger {
        background: linear-gradient(45deg, #e74a3b, #be2617);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
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
    
    /* Form file input styling */
    input[type="file"] {
        display: none;
    }
    
    .required-field::after {
        content: " *";
        color: red;
    }
</style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#foto').on('change', function() {
                const file = $(this).prop('files')[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Ketika elemen provinsi berubah
            $('#provinsi').change(function() {
                // Ambil nilai provinsi yang dipilih
                var selectedProvinsi = $(this).val();

                // Lakukan request AJAX untuk mendapatkan data kabupaten berdasarkan provinsi
                $.ajax({
                    url: '/get-kabupaten', // Ganti URL dengan endpoint yang sesuai di controller
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token, sesuaikan dengan Laravel
                        provinsi: selectedProvinsi // Ganti dengan nama field yang sesuai di database
                    },
                    success: function(data) {
                        // Hapus opsi lama pada dropdown kabupaten
                        $('#kabupaten').empty();

                        // Tambahkan opsi default pada dropdown kabupaten
                        $('#kabupaten').append(
                            '<option value="" selected disabled>Pilih Kabupaten</option>');

                        // Tambahkan opsi kabupaten berdasarkan data yang diterima dari server
                        $.each(data, function(key, value) {
                            $('#kabupaten').append('<option value="' + value.kabupaten +
                                '">' +
                                value.kabupaten + '</option>');
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error: ' + errorThrown);
                    }
                });
            });
        });
    </script>
@endsection
