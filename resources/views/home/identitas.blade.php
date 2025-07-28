@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/identitas.css') }}">
@endsection

@section('content')
<div class="container py-4 mb-5">
    <!-- Form Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="fw-bold mb-0 text-primary"><i class="fas fa-user-circle me-2"></i>Identitas dan Berkas</h2>
                    <p class="text-muted">Lengkapi data profil Anda dengan informasi yang benar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ route('member.identitas.update') }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row g-4">
            <!-- Autentikasi Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Autentikasi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="name" class="form-label required-field">Nama Lengkap (Sesuai KTP)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $member->user->name) }}"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>
                            @error('name')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label required-field">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $member->user->email) }}"
                                    placeholder="nama@email.com" required>
                            </div>
                            @error('email')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                            <div id="email-availability" class="mt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label required-field">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username"
                                    value="{{ old('username', $member->user->username) }}"
                                    placeholder="Masukkan username" required>
                            </div>
                            @error('username')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                            <div id="username-availability" class="mt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label required-field">Nomor Ponsel</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number"
                                    value="{{ old('phone_number', $member->user->phone_number) }}"
                                    placeholder="Contoh: 08123456789" required>
                            </div>
                            @error('phone_number')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-field">Foto Jemaah</label>
                            <div class="text-center mb-3">
                                <img id="preview-image" src="{{ $member->foto ? asset('storage/' . $member->foto) : asset('storage/jemaah-foto/pas-foto.jpg') }}"
                                    class="img-thumbnail" style="height: 150px; width: auto;">
                            </div>
                            <div class="position-relative">
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto" name="foto" accept="image/*" onchange="previewImage(this)">
                                <label for="foto" class="btn btn-primary w-100 mt-2">
                                    <i class="fas fa-upload me-2"></i>Pilih Foto Jemaah
                                </label>
                                @error('foto')
                                    <div class="text-danger fs-6">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biodata Member Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-gradient-info text-white py-3">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>Biodata Member</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="nomor_ktp" class="form-label required-field">Nomor KTP</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" class="form-control @error('nomor_ktp') is-invalid @enderror"
                                    id="nomor_ktp" name="nomor_ktp"
                                    value="{{ old('nomor_ktp', $member->nomor_ktp) }}"
                                    placeholder="16 digit nomor KTP" required>
                            </div>
                            @error('nomor_ktp')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <label for="nama_sesuai_paspor" class="form-label">Nama Sesuai Paspor</label>
                            <input type="text" class="form-control @error('nama_sesuai_paspor') is-invalid @enderror"
                                id="nama_sesuai_paspor" name="nama_sesuai_paspor"
                                value="{{ old('nama_sesuai_paspor', $member->nama_sesuai_paspor) }}"
                                placeholder="Nama sesuai paspor">
                            @error('nama_sesuai_paspor')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label required-field">Kota Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir"
                                value="{{ old('tempat_lahir', $member->tempat_lahir) }}"
                                placeholder="Masukkan kota tempat lahir" required>
                            @error('tempat_lahir')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label required-field">Tanggal Lahir</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $member->tanggal_lahir) }}"
                                    required>
                            </div>
                            @error('tanggal_lahir')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-field">Jenis Kelamin</label>
                            <div class="d-flex gap-4">
                                @foreach (['Laki-laki' => 'male', 'Perempuan' => 'female'] as $label => $icon)
                                    <div class="form-check">
                                        <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                            type="radio" name="jenis_kelamin" id="jk_{{ strtolower($label) }}"
                                            value="{{ $label }}"
                                            @checked(old('jenis_kelamin', $member->jenis_kelamin) == $label)>
                                        <label class="form-check-label" for="jk_{{ strtolower($label) }}">
                                            <i class="fas fa-{{ $icon }} me-1 {{ $label == 'Laki-laki' ? 'text-primary' : 'text-danger' }}"></i>
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('jenis_kelamin')
                                    <div class="text-danger fs-6">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-field">Golongan Darah</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach (['A', 'B', 'AB', 'O'] as $bloodType)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('golongan_darah') is-invalid @enderror"
                                            type="radio" name="golongan_darah" id="gol_{{ strtolower($bloodType) }}"
                                            value="{{ $bloodType }}"
                                            @checked(old('golongan_darah', $member->golongan_darah) == $bloodType)>
                                        <label class="form-check-label" for="gol_{{ strtolower($bloodType) }}">{{ $bloodType }}</label>
                                    </div>
                                @endforeach
                                @error('golongan_darah')
                                    <div class="text-danger fs-6">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-field">Kewarganegaraan</label>
                            <div class="d-flex gap-4">
                                @foreach (['WNI' => 'flag', 'WNA' => 'globe'] as $citizenship => $icon)
                                    <div class="form-check">
                                        <input class="form-check-input @error('kewarganegaraan') is-invalid @enderror"
                                            type="radio" name="kewarganegaraan" id="{{ strtolower($citizenship) }}"
                                            value="{{ $citizenship }}"
                                            @checked(old('kewarganegaraan', $member->kewarganegaraan) == $citizenship)>
                                        <label class="form-check-label" for="{{ strtolower($citizenship) }}">
                                            <i class="fas fa-{{ $icon }} me-1 {{ $citizenship == 'WNI' ? 'text-danger' : 'text-primary' }}"></i>
                                            {{ $citizenship }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('kewarganegaraan')
                                    <div class="text-danger fs-6">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-field">Tingkat Pendidikan</label>
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach (['SD' => 'SD/MI/Sederajat', 'SLTP' => 'SMP/MTs/Sederajat', 'SLTA' => 'SMA/SMK/MA/Sederajat', 'D1/D2/D3' => 'D1/D2/D3'] as $value => $label)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="{{ strtolower($value) }}"
                                                value="{{ $value }}"
                                                @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == $value)>
                                            <label class="form-check-label" for="{{ strtolower($value) }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    @foreach (['D4/S1' => 'D4/S1', 'S2' => 'S2', 'S3' => 'S3'] as $value => $label)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="{{ strtolower($value) }}"
                                                value="{{ $value }}"
                                                @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == $value)>
                                            <label class="form-check-label" for="{{ strtolower($value) }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('tingkat_pendidikan')
                                    <div class="text-danger fs-6">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label required-field">Pekerjaan</label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                id="pekerjaan" name="pekerjaan"
                                value="{{ old('pekerjaan', $member->pekerjaan) }}"
                                placeholder="Masukkan pekerjaan" required>
                            @error('pekerjaan')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-gradient-success text-white py-3">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Alamat Lengkap</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="provinsi" class="form-label required-field">Provinsi</label>
                            <select class="form-select @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi" required>
                                <option value="" selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->provinsi }}" @selected($provinsi->provinsi == old('provinsi', $member->provinsi))>
                                        {{ $provinsi->provinsi }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kabupaten" class="form-label required-field">Kabupaten/Kota</label>
                            <select class="form-select @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" required>
                                <option value="" selected disabled>Pilih Kabupaten</option>
                                @foreach ($kabupatens as $kabupaten)
                                    <option value="{{ $kabupaten->kabupaten }}" @selected($kabupaten->kabupaten == old('kabupaten', $member->kabupaten))>
                                        {{ $kabupaten->kabupaten }}</option>
                                @endforeach
                            </select>
                            @error('kabupaten')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label required-field">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                id="kecamatan" name="kecamatan"
                                value="{{ old('kecamatan', $member->kecamatan) }}"
                                placeholder="Masukkan kecamatan" required>
                            @error('kecamatan')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label required-field">Desa/Kelurahan</label>
                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                id="kelurahan" name="kelurahan"
                                value="{{ old('kelurahan', $member->kelurahan) }}"
                                placeholder="Masukkan desa/kelurahan" required>
                            @error('kelurahan')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kode_pos" class="form-label required-field">Kode Pos</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                <input type="text" class="form-control @error('kode_pos') is-invalid @enderror"
                                    id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $member->kode_pos) }}"
                                    placeholder="Masukkan kode pos" required>
                            </div>
                            @error('kode_pos')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label required-field">Detail Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                rows="3" placeholder="Contoh: Jl. Raya Bogor No. 123, RT 01/RW 02" required>{{ old('alamat', $member->alamat) }}</textarea>
                            @error('alamat')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paspor dan Informasi Tambahan Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-gradient-warning text-white py-3">
                        <h5 class="mb-0"><i class="fas fa-passport me-2"></i>Data Paspor dan Informasi Tambahan</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="nomor_paspor" class="form-label">Nomor Paspor</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                <input type="text" class="form-control @error('nomor_paspor') is-invalid @enderror"
                                    id="nomor_paspor" name="nomor_paspor"
                                    value="{{ old('nomor_paspor', $member->nomor_paspor) }}"
                                    placeholder="Masukkan nomor paspor">
                            </div>
                            @error('nomor_paspor')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_sesuai_paspor" class="form-label">Nama Sesuai Paspor</label>
                            <input type="text" class="form-control @error('nama_sesuai_paspor') is-invalid @enderror"
                                id="nama_sesuai_paspor" name="nama_sesuai_paspor"
                                value="{{ old('nama_sesuai_paspor', $member->nama_sesuai_paspor) }}"
                                placeholder="Nama sesuai paspor">
                            @error('nama_sesuai_paspor')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tempat_dikeluarkan" class="form-label">Tempat Dikeluarkan (Kota/Kabupaten)</label>
                            <input type="text" class="form-control @error('tempat_dikeluarkan') is-invalid @enderror"
                                id="tempat_dikeluarkan" name="tempat_dikeluarkan"
                                value="{{ old('tempat_dikeluarkan', $member->tempat_dikeluarkan) }}"
                                placeholder="Masukkan tempat dikeluarkan">
                            @error('tempat_dikeluarkan')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_dikeluarkan" class="form-label">Tanggal Dikeluarkan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control @error('tanggal_dikeluarkan') is-invalid @enderror"
                                    id="tanggal_dikeluarkan" name="tanggal_dikeluarkan"
                                    value="{{ old('tanggal_dikeluarkan', $member->tanggal_dikeluarkan) }}"
                                    placeholder="Tanggal dikeluarkan">
                            </div>
                            @error('tanggal_dikeluarkan')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                <input type="date" class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                                    id="tanggal_kadaluarsa" name="tanggal_kadaluarsa"
                                    value="{{ old('tanggal_kadaluarsa', $member->tanggal_kadaluarsa) }}"
                                    placeholder="Tanggal kadaluarsa">
                            </div>
                            @error('tanggal_kadaluarsa')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr class="my-4">
                        <h6 class="mb-3 text-primary">Informasi Tambahan</h6>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('pernah_umroh') is-invalid @enderror"
                                    type="checkbox" value="1" id="pernah_umroh" name="pernah_umroh"
                                    @checked(old('pernah_umroh', $member->pernah_umroh))>
                                <label class="form-check-label" for="pernah_umroh">
                                    <i class="fas fa-kaaba me-1"></i>Pernah Umroh?
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('pernah_haji') is-invalid @enderror"
                                    type="checkbox" value="1" id="pernah_haji" name="pernah_haji"
                                    @checked(old('pernah_haji', $member->pernah_haji))>
                                <label class="form-check-label" for="pernah_haji">
                                    <i class="fas fa-mosque me-1"></i>Pernah Haji?
                                </label>
                            </div>
                            @error('pernah_umroh')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                            @error('pernah_haji')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_keluarga_terdekat" class="form-label required-field">Nama Keluarga Terdekat</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                <input type="text" class="form-control @error('nama_keluarga_terdekat') is-invalid @enderror"
                                    id="nama_keluarga_terdekat" name="nama_keluarga_terdekat"
                                    value="{{ old('nama_keluarga_terdekat', $member->nama_keluarga_terdekat) }}"
                                    placeholder="Masukkan nama keluarga terdekat" required>
                            </div>
                            @error('nama_keluarga_terdekat')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kontak_keluarga_terdekat" class="form-label required-field">Kontak Keluarga Terdekat</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control @error('kontak_keluarga_terdekat') is-invalid @enderror"
                                    id="kontak_keluarga_terdekat" name="kontak_keluarga_terdekat"
                                    value="{{ old('kontak_keluarga_terdekat', $member->kontak_keluarga_terdekat) }}"
                                    placeholder="Masukkan nomor telepon keluarga terdekat" required>
                            </div>
                            @error('kontak_keluarga_terdekat')
                                <div class="text-danger fs-6">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="d-flex justify-content-between mt-4 pt-3">
            <a href="{{ route('member.profile', ['mode' => 'show']) }}" class="btn btn-outline-secondary btn-lg px-5">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
            <div>
                {{-- <button type="reset" class="btn btn-light btn-lg me-2">
                    <i class="fas fa-redo me-2"></i>Reset
                </button> --}}
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-save me-2"></i>Simpan Data
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // AJAX untuk mengambil data kabupaten berdasarkan provinsi
        $('#provinsi').change(function() {
            var selectedProvinsi = $(this).val();

            $.ajax({
                url: '/get-kabupaten',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    provinsi: selectedProvinsi
                },
                success: function(data) {
                    $('#kabupaten').empty();
                    $('#kabupaten').append('<option value="" selected disabled>Pilih Kabupaten</option>');
                    $.each(data, function(key, value) {
                        $('#kabupaten').append('<option value="' + value.kabupaten + '">' + value.kabupaten + '</option>');
                    });

                    // If there's a saved kabupaten value, set it
                    var savedKabupaten = "{{ old('kabupaten', $member->kabupaten ?? '') }}";
                    if (savedKabupaten) {
                        $('#kabupaten').val(savedKabupaten);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error: ' + errorThrown);
                }
            });
        });

        // Trigger provinsi change if there's a selected value
        if ($('#provinsi').val()) {
            $('#provinsi').trigger('change');
        }

        // Image preview
        window.previewImage = function(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        // Email availability check
        $('#email').on('blur', function() {
            var email = $(this).val();
            $.ajax({
                url: '/check-email',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email
                },
                success: function(response) {
                    $('#email-availability').text(response.message).css('color', response.available ? 'green' : 'red');
                }
            });
        });

        // Username availability check
        $('#username').on('blur', function() {
            var username = $(this).val();
            $.ajax({
                url: '/check-username',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    username: username
                },
                success: function(response) {
                    $('#username-availability').text(response.message).css('color', response.available ? 'green' : 'red');
                }
            });
        });
    });
</script>
@endsection
