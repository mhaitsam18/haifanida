<!-- resources/views/home/pemesanan/detail-jemaah.blade.php -->
@extends('layouts.main')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-4">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">DETAIL JEMAAH</h2>
            <p class="text-muted">Informasi lengkap jemaah keberangkatan 24 Februari 2024</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="#" class="btn btn-success me-2">
                <i class="fas fa-edit me-1"></i> Edit Data
            </a>
            <a href="#" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Main Content with Tabs -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <ul class="nav nav-tabs card-header-tabs" id="jemaahTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="true">
                                <i class="fas fa-user me-1"></i> Data Pribadi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="berkas-tab" data-bs-toggle="tab" data-bs-target="#berkas" type="button" role="tab" aria-controls="berkas" aria-selected="false">
                                <i class="fas fa-file-alt me-1"></i> Berkas Jemaah
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="bus-tab" data-bs-toggle="tab" data-bs-target="#bus" type="button" role="tab" aria-controls="bus" aria-selected="false">
                                <i class="fas fa-bus me-1"></i> Bus Jemaah
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="kamar-tab" data-bs-toggle="tab" data-bs-target="#kamar" type="button" role="tab" aria-controls="kamar" aria-selected="false">
                                <i class="fas fa-hotel me-1"></i> Kamar Jemaah
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sertifikat-tab" data-bs-toggle="tab" data-bs-target="#sertifikat" type="button" role="tab" aria-controls="sertifikat" aria-selected="false">
                                <i class="fas fa-certificate me-1"></i> Sertifikat
                            </button>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body">
                    <div class="tab-content" id="jemaahTabsContent">
                        <!-- Data Pribadi Tab -->
                        <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                            <div class="row mb-4">
                                <div class="col-md-3 text-center">
                                    <div class="position-relative mb-3">
                                        <img src="https://via.placeholder.com/180" alt="Foto Jemaah" class="img-thumbnail rounded-circle">
                                    </div>
                                    <h4 class="fw-bold">Budi</h4>
                                    <p class="text-muted">ID: JM-001</p>
                                </div>
                                <div class="col-md-9">
                                    <div class="row g-3">
                                        <!-- Personal Information Section -->
                                        <div class="col-12">
                                            <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-id-card me-2"></i>Informasi Pribadi</h5>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nama Lengkap (Sesuai KTP)</label>
                                                <p class="form-control-plaintext border-bottom">Budi Santoso</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Email</label>
                                                <p class="form-control-plaintext border-bottom">budi3@gmail.com</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nomor Ponsel</label>
                                                <p class="form-control-plaintext border-bottom">+6282117</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nomor KTP</label>
                                                <p class="form-control-plaintext border-bottom">3272021505800001</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nomor Sesuai Paspor</label>
                                                <p class="form-control-plaintext border-bottom">AB12345678</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Kota Tempat Lahir</label>
                                                <p class="form-control-plaintext border-bottom">Jakarta</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Tanggal Lahir</label>
                                                <p class="form-control-plaintext border-bottom">15 Mei 1980</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Jenis Kelamin</label>
                                                <p class="form-control-plaintext border-bottom">Laki-laki</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Golongan Darah</label>
                                                <p class="form-control-plaintext border-bottom">O</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Kewarganegaraan</label>
                                                <p class="form-control-plaintext border-bottom">Indonesia</p>
                                            </div>
                                        </div>

                                        <!-- Address Section -->
                                        <div class="col-12 mt-4">
                                            <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-map-marker-alt me-2"></i>Alamat</h5>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Provinsi</label>
                                                <p class="form-control-plaintext border-bottom">DKI Jakarta</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Kabupaten</label>
                                                <p class="form-control-plaintext border-bottom">Jakarta Pusat</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Kecamatan</label>
                                                <p class="form-control-plaintext border-bottom">Menteng</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Desa/Kelurahan</label>
                                                <p class="form-control-plaintext border-bottom">Kebon Sirih</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Kode Pos</label>
                                                <p class="form-control-plaintext border-bottom">10340</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Detail Alamat</label>
                                                <p class="form-control-plaintext border-bottom">Jl. Kebon Sirih No. 45, RT 05/RW 08</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Additional Information Section -->
                                        <div class="col-12 mt-4">
                                            <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-info-circle me-2"></i>Informasi Tambahan</h5>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Tingkat Pendidikan</label>
                                                <p class="form-control-plaintext border-bottom">Sarjana (S1)</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Pekerjaan</label>
                                                <p class="form-control-plaintext border-bottom">Wiraswasta</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Passport Information Section -->
                                        <div class="col-12 mt-4">
                                            <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-passport me-2"></i>Informasi Paspor</h5>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nomor Paspor</label>
                                                <p class="form-control-plaintext border-bottom">AB12345678</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Tempat Dikeluarkan</label>
                                                <p class="form-control-plaintext border-bottom">Jakarta</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Tanggal Dikeluarkan</label>
                                                <p class="form-control-plaintext border-bottom">10 Januari 2023</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Tanggal Kadaluarsa</label>
                                                <p class="form-control-plaintext border-bottom">10 Januari 2028</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Emergency Contact Section -->
                                        <div class="col-12 mt-4">
                                            <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-phone-alt me-2"></i>Kontak Darurat</h5>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nama Keluarga Terdekat</label>
                                                <p class="form-control-plaintext border-bottom">Siti Rahayu</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Kontak Keluarga Terdekat</label>
                                                <p class="form-control-plaintext border-bottom">+628138456789</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Berkas Jemaah Tab -->
                        <div class="tab-pane fade" id="berkas" role="tabpanel" aria-labelledby="berkas-tab">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Dokumen Persyaratan Jemaah</h5>
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus-circle me-1"></i> Tambah Berkas
                                </a>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-hover border">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="30%">Nama Berkas</th>
                                            <th width="15%">Status</th>
                                            <th width="20%">Tanggal Upload</th>
                                            <th width="30%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Scan KTP</td>
                                            <td><span class="badge bg-warning">Tertunda</span></td>
                                            <td>20 Jan 2024</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye me-1"></i> Detail
                                                    </a>
                                                    <a href="#" class="btn btn-success btn-sm mx-1">
                                                        <i class="fas fa-edit me-1"></i> Edit
                                                    </a>
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash me-1"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Scan Paspor</td>
                                            <td><span class="badge bg-warning">Tertunda</span></td>
                                            <td>20 Jan 2024</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye me-1"></i> Detail
                                                    </a>
                                                    <a href="#" class="btn btn-success btn-sm mx-1">
                                                        <i class="fas fa-edit me-1"></i> Edit
                                                    </a>
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash me-1"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Pas Foto Background Putih</td>
                                            <td><span class="badge bg-warning">Tertunda</span></td>
                                            <td>20 Jan 2024</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye me-1"></i> Detail
                                                    </a>
                                                    <a href="#" class="btn btn-success btn-sm mx-1">
                                                        <i class="fas fa-edit me-1"></i> Edit
                                                    </a>
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash me-1"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Bukti Vaksin COVID-19</td>
                                            <td><span class="badge bg-warning">Tertunda</span></td>
                                            <td>21 Jan 2024</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye me-1"></i> Detail
                                                    </a>
                                                    <a href="#" class="btn btn-success btn-sm mx-1">
                                                        <i class="fas fa-edit me-1"></i> Edit
                                                    </a>
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash me-1"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Bus Jemaah Tab -->
                        <div class="tab-pane fade" id="bus" role="tabpanel" aria-labelledby="bus-tab">
                            <div class="text-center p-5">
                                <div class="mb-4">
                                    <i class="fas fa-bus fa-5x text-muted"></i>
                                </div>
                                <h5>Informasi Bus Jemaah</h5>
                                <p class="text-muted">Informasi penempatan bus belum tersedia. <br>Menunggu penempatan dari admin.</p>
                                
                                <!-- Hidden section to be shown once data is available -->
                                <div class="d-none">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body text-start">
                                                    <h5 class="card-title">Informasi Bus</h5>
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <th width="40%">Nomor Rombongan</th>
                                                            <td width="60%">Rombongan 3</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nomor Bus</th>
                                                            <td>Bus A-15</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nomor Kursi</th>
                                                            <td>24</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kamar Jemaah Tab -->
                        <div class="tab-pane fade" id="kamar" role="tabpanel" aria-labelledby="kamar-tab">
                            <div class="text-center p-5">
                                <div class="mb-4">
                                    <i class="fas fa-hotel fa-5x text-muted"></i>
                                </div>
                                <h5>Informasi Kamar Jemaah</h5>
                                <p class="text-muted">Informasi penempatan kamar belum tersedia. <br>Menunggu penempatan dari admin.</p>
                                
                                <!-- Hidden section to be shown once data is available -->
                                <div class="d-none">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-header bg-primary text-white">
                                                    <h5 class="mb-0">Hotel di Mekkah</h5>
                                                </div>
                                                <div class="card-body text-start">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <th width="40%">Nama Hotel</th>
                                                            <td width="60%">Al Madinah Hotel</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nomor Kamar</th>
                                                            <td>507</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sertifikat Tab -->
                        <div class="tab-pane fade" id="sertifikat" role="tabpanel" aria-labelledby="sertifikat-tab">
                            <div class="text-center p-5">
                                <div class="mb-4">
                                    <i class="fas fa-certificate fa-5x text-muted"></i>
                                </div>
                                <h5>Sertifikat Umroh</h5>
                                <p class="text-muted">Sertifikat umroh belum tersedia. <br>Sertifikat akan tersedia setelah jemaah menyelesaikan ibadah umroh.</p>
                                
                                <!-- Hidden section to be shown once data is available -->
                                <div class="d-none">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="card border-0 shadow">
                                                <div class="card-body text-center p-4">
                                                    <div class="mb-4">
                                                        <i class="fas fa-certificate fa-3x text-success"></i>
                                                    </div>
                                                    <h4>Sertifikat Umroh</h4>
                                                    <p>Sertifikat telah tersedia untuk diunduh</p>
                                                    <a href="#" class="btn btn-primary">
                                                        <i class="fas fa-download me-1"></i> Unduh Sertifikat
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    .form-control-plaintext {
        padding-bottom: 0.5rem;
    }
    
    .btn-group .btn {
        border-radius: 4px;
    }
    
    .nav-tabs .nav-link {
        color: #6c757d;
    }
    
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        font-weight: 500;
    }
    
    .tab-pane {
        padding: 1.5rem 0.5rem;
    }
</style>
@endsection

@section('scripts')
<script>
    // JavaScript to enable Bootstrap tabs
    document.addEventListener('DOMContentLoaded', function() {
        var triggerTabList = [].slice.call(document.querySelectorAll('#jemaahTabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    });
</script>
@endsection