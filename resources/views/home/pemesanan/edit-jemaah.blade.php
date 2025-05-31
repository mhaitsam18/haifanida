@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/crud-jemaah.css') }}">
@endsection

@section('content')
<div class="container py-4 mb-5">
    <!-- Form Header with Modern Design -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="fw-bold mb-0 text-primary">Edit Data Jemaah</h2>
                    <p class="text-muted">Silakan perbarui data jemaah dengan benar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ route('pemesanan.jemaah.update', [$pemesanan->id, $jemaah->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $jemaah->nama_lengkap) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $jemaah->email) }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label fw-semibold">Nomor Ponsel <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $jemaah->nomor_telepon) }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto <span class="text-danger">*</span></label>
                            <div class="text-center mb-3">
                                <img id="preview-image" src="{{ $jemaah->foto ? asset('storage/' . $jemaah->foto) : asset('storage/jemaah-foto/pas-foto.jpg') }}" alt="Preview" class="img-thumbnail" style="height: 150px; width: auto;">
                            </div>
                            <div class="position-relative">
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewImage(this)">
                                <label for="foto" class="btn btn-primary w-100 mt-2">
                                    <i class="fas fa-upload me-2"></i>Ubah Foto
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nomor_ktp" class="form-label fw-semibold">Nomor KTP <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" value="{{ old('nomor_ktp', $jemaah->nomor_ktp) }}" required>
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
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $jemaah->tempat_lahir) }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $jemaah->tanggal_lahir) }}" required>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_laki" value="Laki-laki" {{ (old('jenis_kelamin', $jemaah->jenis_kelamin) == 'Laki-laki') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jk_laki">
                                            <i class="fas fa-male text-primary me-1"></i> Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_perempuan" value="Perempuan" {{ (old('jenis_kelamin', $jemaah->jenis_kelamin) == 'Perempuan') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jk_perempuan">
                                            <i class="fas fa-female text-danger me-1"></i> Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Golongan Darah</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach(['A', 'B', 'AB', 'O'] as $goldar)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="golongan_darah" id="gol_{{ strtolower($goldar) }}" value="{{ $goldar }}" {{ (old('golongan_darah', $jemaah->golongan_darah) == $goldar) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gol_{{ strtolower($goldar) }}">{{ $goldar }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Kewarganegaraan <span class="text-danger">*</span></label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kewarganegaraan" id="wni" value="WNI" {{ (old('kewarganegaraan', $jemaah->kewarganegaraan) == 'WNI') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="wni">
                                        <i class="fas fa-flag text-danger me-1"></i> WNI
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kewarganegaraan" id="wna" value="WNA" {{ (old('kewarganegaraan', $jemaah->kewarganegaraan) == 'WNA') ? 'checked' : '' }}>
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
                                    @foreach(['SD' => 'SD/MI/Sederajat', 'SLTP' => 'SMP/MTs/Sederajat', 'SLTA' => 'SMA/SMK/MA/Sederajat', 'D1/D2/D3' => 'D1/D2/D3'] as $value => $label)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="tingkat_pendidikan" id="{{ strtolower($value) }}" value="{{ $value }}" {{ (old('tingkat_pendidikan', $jemaah->tingkat_pendidikan) == $value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ strtolower($value) }}">{{ $label }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    @foreach(['D4/S1' => 'D4/S1', 'S2' => 'S2', 'S3' => 'S3'] as $value => $label)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="tingkat_pendidikan" id="{{ strtolower($value) }}" value="{{ $value }}" {{ (old('tingkat_pendidikan', $jemaah->tingkat_pendidikan) == $value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ strtolower($value) }}">{{ $label }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $jemaah->pekerjaan) }}" placeholder="Masukkan pekerjaan">
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
                            <select class="form-select @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
                                <option value="" disabled>Pilih Provinsi</option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->provinsi }}" {{ (old('provinsi', $jemaah->provinsi) == $provinsi->provinsi) ? 'selected' : '' }}>
                                        {{ $provinsi->provinsi }}
                                    </option>
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
                                <option value="" disabled>Pilih Kabupaten/Kota</option>
                                @foreach ($kabupatens as $kabupaten)
                                    <option value="{{ $kabupaten->kabupaten }}" {{ (old('kabupaten', $jemaah->kabupaten) == $kabupaten->kabupaten) ? 'selected' : '' }}>
                                        {{ $kabupaten->kabupaten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label fw-semibold">Kecamatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $jemaah->kecamatan) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label fw-semibold">Desa/Kelurahan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $jemaah->kelurahan) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kode_pos" class="form-label fw-semibold">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $jemaah->kode_pos) }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">Detail Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $jemaah->alamat) }}</textarea>
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
                                <input type="text" class="form-control" id="nomor_paspor" name="nomor_paspor" value="{{ old('nomor_paspor', $jemaah->nomor_paspor) }}">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama_sesuai_paspor" class="form-label fw-semibold">Nama Sesuai Paspor</label>
                            <input type="text" class="form-control" id="nama_sesuai_paspor" name="nama_sesuai_paspor" value="{{ old('nama_sesuai_paspor', $jemaah->nama_sesuai_paspor) }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="tempat_dikeluarkan" class="form-label fw-semibold">Tempat Dikeluarkan (Kota/Kabupaten)</label>
                            <input type="text" class="form-control" id="tempat_dikeluarkan" name="tempat_dikeluarkan" value="{{ old('tempat_dikeluarkan', $jemaah->tempat_dikeluarkan) }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="tanggal_dikeluarkan" class="form-label fw-semibold">Tanggal Dikeluarkan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" id="tanggal_dikeluarkan" name="tanggal_dikeluarkan" value="{{ old('tanggal_dikeluarkan', $jemaah->tanggal_dikeluarkan) }}">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tanggal_kadaluarsa" class="form-label fw-semibold">Tanggal Kadaluarsa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa', $jemaah->tanggal_kadaluarsa) }}">
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
                            <input type="text" class="form-control" id="nama_keluarga_terdekat" name="nama_keluarga_terdekat" value="{{ old('nama_keluarga_terdekat', $jemaah->nama_keluarga_terdekat) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kontak_keluarga_terdekat" class="form-label fw-semibold">Kontak Keluarga Terdekat <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" id="kontak_keluarga_terdekat" name="kontak_keluarga_terdekat" value="{{ old('kontak_keluarga_terdekat', $jemaah->kontak_keluarga_terdekat) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="d-flex justify-content-between mt-4 pt-3">
            <a href="{{ route('pemesanan.jemaah.list', $pemesanan->id) }}" class="btn btn-outline-secondary btn-lg px-5">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
            <div>
                {{-- <button type="reset" class="btn btn-light btn-lg me-2">
                    <i class="fas fa-redo me-2"></i>Reset
                </button> --}}
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

@endsection


@section('script')
<script>
    // MODIFIED: Add proper image preview functionality
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    $(document).ready(function() {
        $('#foto').on('change', function() {
            previewImage(this);
        });
        
        // Ketika elemen provinsi berubah
        $('#provinsi').change(function() {
            // Ambil nilai provinsi yang dipilih
            var selectedProvinsi = $(this).val();

            // Lakukan request AJAX untuk mendapatkan data kabupaten berdasarkan provinsi
            $.ajax({
                url: '/get-kabupaten',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    provinsi: selectedProvinsi
                },
                success: function(data) {
                    // Hapus opsi lama pada dropdown kabupaten
                    $('#kabupaten').empty();

                    // Tambahkan opsi default pada dropdown kabupaten
                    $('#kabupaten').append('<option value="" disabled>Pilih Kabupaten</option>');

                    // Tambahkan opsi kabupaten berdasarkan data yang diterima dari server
                    $.each(data, function(key, value) {
                        $('#kabupaten').append('<option value="' + value.kabupaten + '">' + value.kabupaten + '</option>');
                    });

                    // Set kabupaten yang sudah tersimpan jika ada
                    var savedKabupaten = "{{ old('kabupaten', $jemaah->kabupaten) }}";
                    if (savedKabupaten) {
                        $('#kabupaten').val(savedKabupaten);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error: ' + errorThrown);
                }
            });
        });

        // Trigger change event pada provinsi jika ada nilai tersimpan
        if ($('#provinsi').val()) {
            $('#provinsi').trigger('change');
        }
    });
</script>
@endsection
