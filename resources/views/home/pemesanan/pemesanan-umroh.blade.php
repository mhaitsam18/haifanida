@extends('layouts.main')

@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="inner-banner">
    <div class="container">
        <div class="inner-title text-center">
            <h3>Form Pemesanan {{ $paket->nama_paket }}</h3>
            <ul>
                <li><a href="/home">Beranda</a></li>
                <li><i class='bx bx-chevrons-right'></i></li>
                <li><a href="/umroh">Paket Umroh</a></li>
                <li><i class='bx bx-chevrons-right'></i></li>
                <li>Form Pemesanan</li>
            </ul>
        </div>
    </div>
    <div class="inner-shape">
        <img src="/assets-techex-demo/images/shape/inner-shape.png" alt="Gambar">
    </div>
</div>

<div class="booking-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form method="POST" action="{{ route('pemesanan.store') }}" id="formPemesanan" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                    <!-- Kontainer Form Jemaah -->
                    <div id="jamaah-container">
                        <div class="card mb-4 jamaah-form" data-jamaah-index="0">
                            <div class="card-header bg-light">
                                <h5 class="m-0"><i class='bx bx-user-circle'></i> Data Jemaah <span class="jamaah-number">1</span></h5>
                            </div>
                            <div class="card-body">
                                <!-- Navigasi Tab -->
                                <ul class="nav nav-tabs mb-4" id="formTabs_0" role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link active" id="profile-tab_0" data-bs-toggle="tab" data-bs-target="#profile_0" type="button" role="tab" aria-selected="true">
                                            <i class='bx bx-user'></i> Profil
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" id="passport-tab_0" data-bs-toggle="tab" data-bs-target="#passport_0" type="button" role="tab" aria-selected="false">
                                            <i class='bx bx-book'></i> Paspor
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" id="family-tab_0" data-bs-toggle="tab" data-bs-target="#family_0" type="button" role="tab" aria-selected="false">
                                            <i class='bx bx-group'></i> Keluarga
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" id="extra-tab_0" data-bs-toggle="tab" data-bs-target="#extra_0" type="button" role="tab" aria-selected="false">
                                            <i class='bx bx-package'></i> Ekstra
                                        </button>
                                    </li>
                                </ul>

                                <!-- Konten Tab -->
                                <div class="tab-content" id="formTabContent_0">
                                    <!-- Data Profil -->
                                    <div class="tab-pane fade show active" id="profile_0" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="nama_lengkap_0" class="form-label">Nama Lengkap (Sesuai KTP) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.nama_lengkap') is-invalid @enderror" id="nama_lengkap_0" name="jamaah[0][nama_lengkap]" value="{{ old('jamaah.0.nama_lengkap') }}" required>
                                                @error('jamaah.0.nama_lengkap')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email_0" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control @error('jamaah.0.email') is-invalid @enderror" id="email_0" name="jamaah[0][email]" value="{{ old('jamaah.0.email') }}" required>
                                                @error('jamaah.0.email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="nomor_telepon_0" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.nomor_telepon') is-invalid @enderror" id="nomor_telepon_0" name="jamaah[0][nomor_telepon]" value="{{ old('jamaah.0.nomor_telepon') }}" required>
                                                @error('jamaah.0.nomor_telepon')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="nomor_ktp_0" class="form-label">Nomor KTP <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.nomor_ktp') is-invalid @enderror" id="nomor_ktp_0" name="jamaah[0][nomor_ktp]" value="{{ old('jamaah.0.nomor_ktp') }}" required>
                                                @error('jamaah.0.nomor_ktp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tempat_lahir_0" class="form-label">Kota Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.tempat_lahir') is-invalid @enderror" id="tempat_lahir_0" name="jamaah[0][tempat_lahir]" value="{{ old('jamaah.0.tempat_lahir') }}" required>
                                                @error('jamaah.0.tempat_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tanggal_lahir_0" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('jamaah.0.tanggal_lahir') is-invalid @enderror" id="tanggal_lahir_0" name="jamaah[0][tanggal_lahir]" value="{{ old('jamaah.0.tanggal_lahir') }}" required>
                                                @error('jamaah.0.tanggal_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="jenis_kelamin_0" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                                <select class="form-select @error('jamaah.0.jenis_kelamin') is-invalid @enderror" id="jenis_kelamin_0" name="jamaah[0][jenis_kelamin]" required>
                                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                    <option value="Laki-laki" @selected(old('jamaah.0.jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                                                    <option value="Perempuan" @selected(old('jamaah.0.jenis_kelamin') == 'Perempuan')>Perempuan</option>
                                                </select>
                                                @error('jamaah.0.jenis_kelamin')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Golongan Darah <span class="text-danger">*</span></label>
                                                <div class="d-flex">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input @error('jamaah.0.golongan_darah') is-invalid @enderror" type="radio" name="jamaah[0][golongan_darah]" id="golA_0" value="A" @checked(old('jamaah.0.golongan_darah') == 'A') required>
                                                        <label class="form-check-label" for="golA_0">A</label>
                                                    </div>
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="jamaah[0][golongan_darah]" id="golB_0" value="B" @checked(old('jamaah.0.golongan_darah') == 'B')>
                                                        <label class="form-check-label" for="golB_0">B</label>
                                                    </div>
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="jamaah[0][golongan_darah]" id="golAB_0" value="AB" @checked(old('jamaah.0.golongan_darah') == 'AB')>
                                                        <label class="form-check-label" for="golAB_0">AB</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jamaah[0][golongan_darah]" id="golO_0" value="O" @checked(old('jamaah.0.golongan_darah') == 'O')>
                                                        <label class="form-check-label" for="golO_0">O</label>
                                                    </div>
                                                </div>
                                                @error('jamaah.0.golongan_darah')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                                                <div class="d-flex">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input @error('jamaah.0.kewarganegaraan') is-invalid @enderror" type="radio" name="jamaah[0][kewarganegaraan]" id="wni_0" value="WNI" @checked(old('jamaah.0.kewarganegaraan') == 'WNI') required>
                                                        <label class="form-check-label" for="wni_0">WNI</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jamaah[0][kewarganegaraan]" id="wna_0" value="WNA" @checked(old('jamaah.0.kewarganegaraan') == 'WNA')>
                                                        <label class="form-check-label" for="wna_0">WNA</label>
                                                    </div>
                                                </div>
                                                @error('jamaah.0.kewarganegaraan')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Di form awal (index 0) -->
                                            <div class="col-md-6 mb-3">
                                                <label for="provinsi_0" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                                <select class="form-select @error('jamaah.0.provinsi') is-invalid @enderror" id="provinsi_0" name="jamaah[0][provinsi]" required>
                                                    <option value="" selected disabled>Pilih Provinsi</option>
                                                    @if(isset($provinsis) && $provinsis->isNotEmpty())
                                                        @foreach($provinsis as $provinsi)
                                                            <option value="{{ $provinsi->provinsi }}">{{ $provinsi->provinsi }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="" disabled>Data provinsi tidak tersedia</option>
                                                    @endif
                                                </select>
                                                @error('jamaah.0.provinsi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="kabupaten_0" class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                                                <select class="form-select @error('jamaah.0.kabupaten') is-invalid @enderror" id="kabupaten_0" name="jamaah[0][kabupaten]" required>
                                                    <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                                                </select>
                                                @error('jamaah.0.kabupaten')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="kecamatan_0" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.kecamatan') is-invalid @enderror" id="kecamatan_0" name="jamaah[0][kecamatan]" value="{{ old('jamaah.0.kecamatan') }}" required>
                                                @error('jamaah.0.kecamatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="kelurahan_0" class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.kelurahan') is-invalid @enderror" id="kelurahan_0" name="jamaah[0][kelurahan]" value="{{ old('jamaah.0.kelurahan') }}" required>
                                                @error('jamaah.0.kelurahan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="kode_pos_0" class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.kode_pos') is-invalid @enderror" id="kode_pos_0" name="jamaah[0][kode_pos]" value="{{ old('jamaah.0.kode_pos') }}" required>
                                                @error('jamaah.0.kode_pos')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tingkat_pendidikan_0" class="form-label">Tingkat Pendidikan <span class="text-danger">*</span></label>
                                                <select class="form-select @error('jamaah.0.tingkat_pendidikan') is-invalid @enderror" id="tingkat_pendidikan_0" name="jamaah[0][tingkat_pendidikan]" required>
                                                    <option value="" selected disabled>Pilih Tingkat Pendidikan</option>
                                                    <option value="SD" @selected(old('jamaah.0.tingkat_pendidikan') == 'SD')>SD/MI/Sederajat</option>
                                                    <option value="SLTP" @selected(old('jamaah.0.tingkat_pendidikan') == 'SLTP')>SLTP/SMP/MTs/Sederajat</option>
                                                    <option value="SLTA" @selected(old('jamaah.0.tingkat_pendidikan') == 'SLTA')>SLTA/SMA/MA/Sederajat</option>
                                                    <option value="D1/D2/D3" @selected(old('jamaah.0.tingkat_pendidikan') == 'D1/D2/D3')>D1/D2/D3</option>
                                                    <option value="D4/S1" @selected(old('jamaah.0.tingkat_pendidikan') == 'D4/S1')>D4/S1</option>
                                                    <option value="S2" @selected(old('jamaah.0.tingkat_pendidikan') == 'S2')>S2</option>
                                                    <option value="S3" @selected(old('jamaah.0.tingkat_pendidikan') == 'S3')>S3</option>
                                                </select>
                                                @error('jamaah.0.tingkat_pendidikan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="alamat_0" class="form-label">Detail Alamat <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('jamaah.0.alamat') is-invalid @enderror" id="alamat_0" name="jamaah[0][alamat]" rows="3" required>{{ old('jamaah.0.alamat') }}</textarea>
                                                @error('jamaah.0.alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="pekerjaan_0" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.pekerjaan') is-invalid @enderror" id="pekerjaan_0" name="jamaah[0][pekerjaan]" value="{{ old('jamaah.0.pekerjaan') }}" required>
                                                @error('jamaah.0.pekerjaan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <button type="button" class="btn btn-secondary" disabled>Sebelumnya</button>
                                            <button type="button" class="btn btn-primary" onclick="document.getElementById('passport-tab_0').click()">Selanjutnya</button>
                                        </div>
                                    </div>

                                    <!-- Data Paspor -->
                                    <div class="tab-pane fade" id="passport_0" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="nama_sesuai_paspor_0" class="form-label">Nama Sesuai Paspor <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.nama_sesuai_paspor') is-invalid @enderror" id="nama_sesuai_paspor_0" name="jamaah[0][nama_sesuai_paspor]" value="{{ old('jamaah.0.nama_sesuai_paspor') }}" required>
                                                @error('jamaah.0.nama_sesuai_paspor')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="nomor_paspor_0" class="form-label">Nomor Paspor <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.nomor_paspor') is-invalid @enderror" id="nomor_paspor_0" name="jamaah[0][nomor_paspor]" value="{{ old('jamaah.0.nomor_paspor') }}" required>
                                                @error('jamaah.0.nomor_paspor')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tempat_dikeluarkan_0" class="form-label">Tempat Dikeluarkan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.tempat_dikeluarkan') is-invalid @enderror" id="tempat_dikeluarkan_0" name="jamaah[0][tempat_dikeluarkan]" value="{{ old('jamaah.0.tempat_dikeluarkan') }}" required>
                                                @error('jamaah.0.tempat_dikeluarkan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tanggal_dikeluarkan_0" class="form-label">Tanggal Dikeluarkan <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('jamaah.0.tanggal_dikeluarkan') is-invalid @enderror" id="tanggal_dikeluarkan_0" name="jamaah[0][tanggal_dikeluarkan]" value="{{ old('jamaah.0.tanggal_dikeluarkan') }}" required>
                                                @error('jamaah.0.tanggal_dikeluarkan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tanggal_kadaluarsa_0" class="form-label">Tanggal Kadaluarsa <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('jamaah.0.tanggal_kadaluarsa') is-invalid @enderror" id="tanggal_kadaluarsa_0" name="jamaah[0][tanggal_kadaluarsa]" value="{{ old('jamaah.0.tanggal_kadaluarsa') }}" required>
                                                @error('jamaah.0.tanggal_kadaluarsa')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('profile-tab_0').click()">Sebelumnya</button>
                                            <button type="button" class="btn btn-primary" onclick="document.getElementById('family-tab_0').click()">Selanjutnya</button>
                                        </div>
                                    </div>

                                    <!-- Data Keluarga -->
                                    <div class="tab-pane fade" id="family_0" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="nama_keluarga_terdekat_0" class="form-label">Nama Keluarga Terdekat <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.nama_keluarga_terdekat') is-invalid @enderror" id="nama_keluarga_terdekat_0" name="jamaah[0][nama_keluarga_terdekat]" value="{{ old('jamaah.0.nama_keluarga_terdekat') }}" required>
                                                @error('jamaah.0.nama_keluarga_terdekat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="kontak_keluarga_terdekat_0" class="form-label">Kontak Keluarga Terdekat <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jamaah.0.kontak_keluarga_terdekat') is-invalid @enderror" id="kontak_keluarga_terdekat_0" name="jamaah[0][kontak_keluarga_terdekat]" value="{{ old('jamaah.0.kontak_keluarga_terdekat') }}" required>
                                                @error('jamaah.0.kontak_keluarga_terdekat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('passport-tab_0').click()">Sebelumnya</button>
                                            <button type="button" class="btn btn-primary" onclick="document.getElementById('extra-tab_0').click()">Selanjutnya</button>
                                        </div>
                                    </div>

                                    <!-- Data Ekstra -->
                                    <div class="tab-pane fade" id="extra_0" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="pilihan_kamar_0" class="form-label">Pilihan Kamar <span class="text-danger">*</span></label>
                                                <select class="form-select @error('jamaah.0.pilihan_kamar') is-invalid @enderror" id="pilihan_kamar_0" name="jamaah[0][pilihan_kamar]" required>
                                                    <option value="" selected disabled>Pilih Tipe Kamar</option>
                                                    <option value="Double" data-harga="0" @selected(old('jamaah.0.pilihan_kamar') == 'Double')>Double (2 orang/kamar)</option>
                                                    <option value="Triple" data-harga="0" @selected(old('jamaah.0.pilihan_kamar') == 'Triple')>Triple (3 orang/kamar)</option>
                                                    <option value="Quad" data-harga="0" @selected(old('jamaah.0.pilihan_kamar') == 'Quad')>Quad (4 orang/kamar)</option>
                                                </select>
                                                @error('jamaah.0.pilihan_kamar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Pemesanan Ekstra (Opsional)</label>
                                                <div class="row">
                                                    @if(isset($ekstras) && $ekstras->isNotEmpty())
                                                        @foreach($ekstras as $ekstra)
                                                            <div class="col-md-6">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox" id="ekstra_{{ $ekstra->nama_ekstra }}_0" name="jamaah[0][ekstra][]" value="{{ $ekstra->nama_ekstra }}" data-harga="{{ $ekstra->harga_default }}" @checked(in_array($ekstra->nama_ekstra, old('jamaah.0.ekstra', [])))>
                                                                    <label class="form-check-label" for="ekstra_{{ $ekstra->nama_ekstra }}_0">{{ $ekstra->nama_ekstra }} (+ Rp. {{ number_format($ekstra->harga_default, 0, ',', '.') }})</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <p class="text-muted">Tidak ada layanan ekstra tersedia.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('family-tab_0').click()">Sebelumnya</button>
                                            <button type="button" class="btn btn-primary" onclick="validateJamaahForm(0)">Selesai</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Tambah Jemaah -->
                    <div class="mb-4">
                        <button type="button" id="add-jamaah" class="btn btn-outline-primary">
                            <i class='bx bx-user-plus'></i> Tambah Jemaah Lainnya
                        </button>
                    </div>

                    <!-- Catatan Pemesanan -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="m-0"><i class='bx bx-note'></i> Catatan Pemesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan (Opsional)</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan khusus untuk pemesanan ini">{{ old('catatan') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn default-btn btn-bg-two border-radius-5">
                            <i class='bx bx-check-circle'></i> Lanjutkan ke Pembayaran
                        </button>
                    </div>
                </form>
            </div>

            <!-- Sidebar: Ringkasan Paket dan Pembayaran -->
            <div class="col-lg-4">
                <div class="sidebar-wrap sticky-top" style="top: 20px;">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="m-0"><i class='bx bx-package'></i> Ringkasan Paket</h5>
                        </div>
                        <div class="card-body">
                            <h4>{{ $paket->nama_paket }}</h4>
                            <div class="d-flex align-items-center my-3">
                                <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}" class="img-fluid rounded me-2" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                <div>
                                    <p class="mb-1"><i class='bx bx-map'></i> {{ $paket->destinasi }}</p>
                                    <p class="mb-1"><i class='bx bx-calendar'></i> {{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</p>
                                    <p class="mb-0"><i class='bx bx-time'></i> {{ $paket->durasi }} Hari</p>
                                </div>
                            </div>
                            <div class="border-top pt-3 mt-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Berangkat dari:</span>
                                    <span class="fw-bold">{{ $paket->tempat_keberangkatan }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tanggal Berangkat:</span>
                                    <span class="fw-bold">{{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tanggal Pulang:</span>
                                    <span class="fw-bold">{{ Carbon::parse($paket->tanggal_selesai)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4" id="price-summary">
                        <div class="card-header bg-light">
                            <h5 class="m-0"><i class='bx bx-money'></i> Rincian Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Harga Paket:</span>
                                <span class="fw-bold">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Jumlah Jemaah:</span>
                                <span class="fw-bold" id="total-jamaah">1 orang</span>
                            </div>
                            <div id="ekstra-biaya-container">
                                <!-- Biaya ekstra akan ditambahkan secara dinamis -->
                            </div>
                            <div class="border-top border-bottom py-2 my-3">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total Pembayaran:</span>
                                    <span class="fw-bold fs-5 text-primary" id="total-payment">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
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

@section('script')
<script>
    let jamaahCount = 1;

    // Tambah form jemaah baru
    $('#add-jamaah').click(function() {
        const newIndex = jamaahCount++;
        const jamaahForm = `
            <div class="card mb-4 jamaah-form" data-jamaah-index="${newIndex}">
                <div class="card-header bg-light">
                    <h5 class="m-0"><i class='bx bx-user-circle'></i> Data Jemaah <span class="jamaah-number">${newIndex + 1}</span></h5>
                    <button type="button" class="btn btn-sm btn-danger remove-jamaah" data-index="${newIndex}">Hapus</button>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" id="formTabs_${newIndex}" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="profile-tab_${newIndex}" data-bs-toggle="tab" data-bs-target="#profile_${newIndex}" type="button" role="tab" aria-selected="true">
                                <i class='bx bx-user'></i> Profil
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="passport-tab_${newIndex}" data-bs-toggle="tab" data-bs-target="#passport_${newIndex}" type="button" role="tab" aria-selected="false">
                                <i class='bx bx-book'></i> Paspor
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="family-tab_${newIndex}" data-bs-toggle="tab" data-bs-target="#family_${newIndex}" type="button" role="tab" aria-selected="false">
                                <i class='bx bx-group'></i> Keluarga
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="extra-tab_${newIndex}" data-bs-toggle="tab" data-bs-target="#extra_${newIndex}" type="button" role="tab" aria-selected="false">
                                <i class='bx bx-package'></i> Ekstra
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="formTabContent_${newIndex}">
                        <div class="tab-pane fade show active" id="profile_${newIndex}" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_lengkap_${newIndex}" class="form-label">Nama Lengkap (Sesuai KTP) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_lengkap_${newIndex}" name="jamaah[${newIndex}][nama_lengkap]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_${newIndex}" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email_${newIndex}" name="jamaah[${newIndex}][email]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nomor_telepon_${newIndex}" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nomor_telepon_${newIndex}" name="jamaah[${newIndex}][nomor_telepon]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nomor_ktp_${newIndex}" class="form-label">Nomor KTP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nomor_ktp_${newIndex}" name="jamaah[${newIndex}][nomor_ktp]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir_${newIndex}" class="form-label">Kota Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_lahir_${newIndex}" name="jamaah[${newIndex}][tempat_lahir]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_lahir_${newIndex}" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_lahir_${newIndex}" name="jamaah[${newIndex}][tanggal_lahir]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_kelamin_${newIndex}" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select" id="jenis_kelamin_${newIndex}" name="jamaah[${newIndex}][jenis_kelamin]" required>
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Golongan Darah <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="jamaah[${newIndex}][golongan_darah]" id="golA_${newIndex}" value="A" required>
                                            <label class="form-check-label" for="golA_${newIndex}">A</label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="jamaah[${newIndex}][golongan_darah]" id="golB_${newIndex}" value="B">
                                            <label class="form-check-label" for="golB_${newIndex}">B</label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="jamaah[${newIndex}][golongan_darah]" id="golAB_${newIndex}" value="AB">
                                            <label class="form-check-label" for="golAB_${newIndex}">AB</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jamaah[${newIndex}][golongan_darah]" id="golO_${newIndex}" value="O">
                                            <label class="form-check-label" for="golO_${newIndex}">O</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="jamaah[${newIndex}][kewarganegaraan]" id="wni_${newIndex}" value="WNI" required>
                                            <label class="form-check-label" for="wni_${newIndex}">WNI</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jamaah[${newIndex}][kewarganegaraan]" id="wna_${newIndex}" value="WNA">
                                            <label class="form-check-label" for="wna_${newIndex}">WNA</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="provinsi_${newIndex}" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <select class="form-select" id="provinsi_${newIndex}" name="jamaah[${newIndex}][provinsi]" required>
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        @if(isset($provinsis) && $provinsis->isNotEmpty())
                                            @foreach($provinsis as $provinsi)
                                                <option value="{{ $provinsi->provinsi }}">{{ $provinsi->provinsi }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>Data provinsi tidak tersedia</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kabupaten_${newIndex}" class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kabupaten_${newIndex}" name="jamaah[${newIndex}][kabupaten]" required>
                                        <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kecamatan_${newIndex}" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kecamatan_${newIndex}" name="jamaah[${newIndex}][kecamatan]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kelurahan_${newIndex}" class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kelurahan_${newIndex}" name="jamaah[${newIndex}][kelurahan]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kode_pos_${newIndex}" class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode_pos_${newIndex}" name="jamaah[${newIndex}][kode_pos]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tingkat_pendidikan_${newIndex}" class="form-label">Tingkat Pendidikan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="tingkat_pendidikan_${newIndex}" name="jamaah[${newIndex}][tingkat_pendidikan]" required>
                                        <option value="" selected disabled>Pilih Tingkat Pendidikan</option>
                                        <option value="SD">SD/MI/Sederajat</option>
                                        <option value="SLTP">SLTP/SMP/MTs/Sederajat</option>
                                        <option value="SLTA">SLTA/SMA/MA/Sederajat</option>
                                        <option value="D1/D2/D3">D1/D2/D3</option>
                                        <option value="D4/S1">D4/S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="alamat_${newIndex}" class="form-label">Detail Alamat <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat_${newIndex}" name="jamaah[${newIndex}][alamat]" rows="3" required></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan_${newIndex}" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pekerjaan_${newIndex}" name="jamaah[${newIndex}][pekerjaan]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="foto_${newIndex}" class="form-label">Foto <small>(jpg, jpeg, png, max: 2MB)</small></label>
                                    <input type="file" class="form-control" id="foto_${newIndex}" name="jamaah[${newIndex}][foto]" accept="image/jpeg,image/png">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" class="btn btn-secondary" disabled>Sebelumnya</button>
                                <button type="button" class="btn btn-primary" onclick="document.getElementById('passport-tab_${newIndex}').click()">Selanjutnya</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="passport_${newIndex}" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_sesuai_paspor_${newIndex}" class="form-label">Nama Sesuai Paspor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_sesuai_paspor_${newIndex}" name="jamaah[${newIndex}][nama_sesuai_paspor]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nomor_paspor_${newIndex}" class="form-label">Nomor Paspor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nomor_paspor_${newIndex}" name="jamaah[${newIndex}][nomor_paspor]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_dikeluarkan_${newIndex}" class="form-label">Tempat Dikeluarkan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_dikeluarkan_${newIndex}" name="jamaah[${newIndex}][tempat_dikeluarkan]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_dikeluarkan_${newIndex}" class="form-label">Tanggal Dikeluarkan <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_dikeluarkan_${newIndex}" name="jamaah[${newIndex}][tanggal_dikeluarkan]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_kadaluarsa_${newIndex}" class="form-label">Tanggal Kadaluarsa <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_kadaluarsa_${newIndex}" name="jamaah[${newIndex}][tanggal_kadaluarsa]" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" class="btn btn-secondary" onclick="document.getElementById('profile-tab_${newIndex}').click()">Sebelumnya</button>
                                <button type="button" class="btn btn-primary" onclick="document.getElementById('family-tab_${newIndex}').click()">Selanjutnya</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="family_${newIndex}" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_keluarga_terdekat_${newIndex}" class="form-label">Nama Keluarga Terdekat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_keluarga_terdekat_${newIndex}" name="jamaah[${newIndex}][nama_keluarga_terdekat]" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kontak_keluarga_terdekat_${newIndex}" class="form-label">Kontak Keluarga Terdekat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kontak_keluarga_terdekat_${newIndex}" name="jamaah[${newIndex}][kontak_keluarga_terdekat]" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" class="btn btn-secondary" onclick="document.getElementById('passport-tab_${newIndex}').click()">Sebelumnya</button>
                                <button type="button" class="btn btn-primary" onclick="document.getElementById('extra-tab_${newIndex}').click()">Selanjutnya</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="extra_${newIndex}" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pilihan_kamar_${newIndex}" class="form-label">Pilihan Kamar <span class="text-danger">*</span></label>
                                    <select class="form-select" id="pilihan_kamar_${newIndex}" name="jamaah[${newIndex}][pilihan_kamar]" required>
                                        <option value="" selected disabled>Pilih Tipe Kamar</option>
                                        <option value="Double" data-harga="0">Double (2 orang/kamar)</option>
                                        <option value="Triple" data-harga="0">Triple (3 orang/kamar)</option>
                                        <option value="Quad" data-harga="0">Quad (4 orang/kamar)</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Pemesanan Ekstra (Opsional)</label>
                                    <div class="row">
                                        @if(isset($ekstras) && $ekstras->isNotEmpty())
                                            @foreach($ekstras as $ekstra)
                                                <div class="col-md-6">
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" id="ekstra_{{ $ekstra->nama_ekstra }}_${newIndex}" name="jamaah[${newIndex}][ekstra][]" value="{{ $ekstra->nama_ekstra }}" data-harga="{{ $ekstra->harga_default }}">
                                                        <label class="form-check-label" for="ekstra_{{ $ekstra->nama_ekstra }}_${newIndex}">{{ $ekstra->nama_ekstra }} (+ Rp. {{ number_format($ekstra->harga_default, 0, ',', '.') }})</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted">Tidak ada layanan ekstra tersedia.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" class="btn btn-secondary" onclick="document.getElementById('family-tab_${newIndex}').click()">Sebelumnya</button>
                                <button type="button" class="btn btn-primary" onclick="validateJamaahForm(${newIndex})">Selesai</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#jamaah-container').append(jamaahForm);
        updateTotalPayment();
    });

    // Hapus form jemaah
    $(document).on('click', '.remove-jamaah', function() {
        const index = $(this).data('index');
        $(`.jamaah-form[data-jamaah-index="${index}"]`).remove();
        jamaahCount--;
        $('.jamaah-number').each(function(i) {
            $(this).text(i + 1);
        });
        updateTotalPayment();
    });

    // Validasi form jemaah
    function validateJamaahForm(index) {
        const form = $(`#formTabContent_${index}`);
        let isValid = true;
        form.find(':input[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        if (isValid) {
            $(`#formTabs_${index} .nav-link`).removeClass('active');
            $(`#extra-tab_${index}`).addClass('active');
            alert('Data Jemaah ' + (index + 1) + ' telah lengkap.');
        } else {
            alert('Harap lengkapi semua field yang wajib diisi.');
        }
    }

    // Perbarui total pembayaran
    function updateTotalPayment() {
        let total = {{ $paket->harga }} * jamaahCount;
        let ekstraDetails = {};

        $('.jamaah-form').each(function() {
            const index = $(this).data('jamaah-index');
            $(this).find(`input[name="jamaah[${index}][ekstra][]"]:checked`).each(function() {
                const ekstra = $(this).val();
                const harga = parseFloat($(this).data('harga'));
                ekstraDetails[ekstra] = (ekstraDetails[ekstra] || 0) + 1;
                total += harga;
            });
        });

        $('#total-jamaah').text(jamaahCount + ' orang');
        $('#ekstra-biaya-container').empty();
        for (const [ekstra, count] of Object.entries(ekstraDetails)) {
            const harga = parseFloat($(`input[value="${ekstra}"]`).data('harga')) * count;
            $('#ekstra-biaya-container').append(`
                <div class="d-flex justify-content-between mb-2">
                    <span>${ekstra} (x${count}):</span>
                    <span>Rp ${numberFormat(harga)}</span>
                </div>
            `);
        }
        $('#total-payment').text('Rp ' + numberFormat(total));
    }

    // Format angka
    function numberFormat(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    // Tangani perubahan ekstra dan kamar
    $(document).on('change', 'input[name*="[ekstra][]"], select[name*="[pilihan_kamar]"]', updateTotalPayment);

    // AJAX untuk kabupaten
    $(document).on('change', 'select[id^="provinsi_"]', function() {
        const index = $(this).attr('id').split('_')[1];
        const selectedProvinsi = $(this).val();
        console.log('Index:', index);
        console.log('Mengirim request untuk provinsi: ' + selectedProvinsi);
        $.ajax({
            url: '{{ route("get-kabupaten") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                provinsi: selectedProvinsi
            },
            success: function(data) {
                console.log('Response kabupaten: ', data);
                const kabupatenSelect = $(`#kabupaten_${index}`);
                console.log('Kabupaten select element:', kabupatenSelect.length ? 'Ditemukan' : 'Tidak ditemukan');
                console.log('HTML elemen sebelum append:', kabupatenSelect.prop('outerHTML'));
                kabupatenSelect.empty();
                kabupatenSelect.append('<option value="" selected disabled>Pilih Kabupaten/Kota</option>');
                for (let i = 0; i < data.length; i++) {
                    const kabupaten = data[i].kabupaten;
                    if (kabupaten) {
                        const option = '<option value="' + kabupaten + '">' + kabupaten + '</option>';
                        kabupatenSelect.append(option);
                        console.log('Opsi ditambahkan:', option);
                    }
                }
                console.log('Isi dropdown setelah append:', kabupatenSelect.html());
                kabupatenSelect.trigger('change');
            },
            error: function(xhr) {
                console.error('Error AJAX: ', xhr.responseText);
                alert('Gagal memuat data kabupaten. Status: ' + xhr.status);
            }
        });
    });

    // Validasi form saat submit
    $('#formPemesanan').submit(function(e) {
        const allValid = $('.jamaah-form').toArray().every(function(form) {
            const index = $(form).data('jamaah-index');
            return validateJamaahForm(index);
        });
        if (!allValid) {
            e.preventDefault();
            alert('Harap lengkapi semua data jemaah sebelum melanjutkan.');
        }
    });
</script>
@endsection