@extends('layouts.main')

@section('content')

<div class="section-title text-center">
    <h2>Identitas dan Berkas</h2>
</div>

<div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-2">{{ $title }}</h6>
                    </div>
                    <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT') 
                        @csrf
                        <input type="hidden" name="id" value="{{ $member->id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="mb-3">Autentikasi</h4>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap (Sesuai KTP)</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $member->user->name) }}"
                                        placeholder="Nama Lengkap">
                                    @error('name')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $member->user->email) }}"
                                        placeholder="Email">
                                    <span id="email-availability"></span>
                                    @error('email')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username"
                                        value="{{ old('username', $member->user->username) }}" placeholder="Username">
                                    <span id="username-availability"></span>
                                    @error('username')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Nomor Ponsel</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $member->user->phone_number) }}"
                                        placeholder="Nomor Ponsel">
                                    @error('phone_number')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2">Foto</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img src="{{ asset('storage/' . $member->user->photo) }}" 
                                                    class="img-thumbnail img-preview">
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    {{-- <label class="input-group-text" for="photo">Foto</label> --}}
                                                    <input type="file"
                                                        class="form-control @error('photo') is-invalid @enderror img-input"
                                                        id="photo" name="photo">
                                                    @error('photo')
                                                        <div class="text-danger fs-6">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <h4 class="mb-3">Biodata Member</h4>
                                <div class="mb-3">
                                    <label for="nomor_ktp" class="form-label">Nomor KTP</label>
                                    <input type="number" class="form-control @error('nomor_ktp') is-invalid @enderror"
                                        id="nomor_ktp" name="nomor_ktp"
                                        value="{{ old('nomor_ktp', $member->nomor_ktp) }}" placeholder="Nomor KTP">
                                    @error('nomor_ktp')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_sesuai_paspor" class="form-label">Nama Sesuai Paspor</label>
                                    <input type="text"
                                        class="form-control @error('nama_sesuai_paspor') is-invalid @enderror"
                                        id="nama_sesuai_paspor" name="nama_sesuai_paspor"
                                        value="{{ old('nama_sesuai_paspor', $member->nama_sesuai_paspor) }}"
                                        placeholder="Nama Sesuai Paspor">
                                    @error('nama_sesuai_paspor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Kota Tempat Lahir</label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        id="tempat_lahir" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', $member->tempat_lahir) }}"
                                        placeholder="Kota Tempat Lahir">
                                    @error('tempat_lahir')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $member->tanggal_lahir) }}"
                                        placeholder="Tanggal Lahir">
                                    @error('tanggal_lahir')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="@error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" @selected(old('jenis_kelamin', $member->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                                        <option value="Perempuan" @selected(old('jenis_kelamin', $member->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="golongan_darah">Golongan Darah</label>
                                    <div class="" id="golongan_darah">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('golongan_darah') is-invalid @enderror"
                                                type="radio" name="golongan_darah" id="A" value="A"
                                                @checked(old('golongan_darah', $member->golongan_darah) == 'A')>
                                            <label class="form-check-label" for="A">A</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('golongan_darah') is-invalid @enderror"
                                                type="radio" name="golongan_darah" id="B" value="B"
                                                @checked(old('golongan_darah', $member->golongan_darah) == 'B')>
                                            <label class="form-check-label" for="B">B</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('golongan_darah') is-invalid @enderror"
                                                type="radio" name="golongan_darah" id="AB" value="AB"
                                                @checked(old('golongan_darah', $member->golongan_darah) == 'AB')>
                                            <label class="form-check-label" for="AB">AB</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('golongan_darah') is-invalid @enderror"
                                                type="radio" name="golongan_darah" id="O" value="O"
                                                @checked(old('golongan_darah', $member->golongan_darah) == 'O')>
                                            <label class="form-check-label" for="O">O</label>
                                        </div>
                                    </div>
                                    @error('golongan_darah')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="kewarganegaraan">Kewarganegaraan</label>
                                    <div class="" id="kewarganegaraan">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('kewarganegaraan') is-invalid @enderror"
                                                type="radio" name="kewarganegaraan" id="wni" value="WNI"
                                                @checked(old('kewarganegaraan', $member->kewarganegaraan) == 'WNI')>
                                            <label class="form-check-label" for="wni">WNI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('kewarganegaraan') is-invalid @enderror"
                                                type="radio" name="kewarganegaraan" id="wna" value="WNA"
                                                @checked(old('kewarganegaraan', $member->kewarganegaraan) == 'WNA')>
                                            <label class="form-check-label" for="wna">WNA</label>
                                        </div>
                                    </div>
                                    @error('kewarganegaraan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select class="form-select @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        @foreach ($provinsis as $provinsi)
                                            <option value="{{ $provinsi->provinsi }}" @selected($provinsi->provinsi == old('provinsi', $member->provinsi))>
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
                                    <label for="kabupaten" class="form-label">Kabupaten / Kota</label>
                                    <select class="form-select @error('kabupaten') is-invalid @enderror" id="kabupaten"
                                        name="kabupaten">
                                        <option value="" selected disabled>Pilih Kabupaten</option>
                                        @foreach ($kabupatens as $kabupaten)
                                            <option value="{{ $kabupaten->kabupaten }}" @selected($kabupaten->kabupaten == old('kabupaten', $member->kabupaten))>
                                                {{ $kabupaten->kabupaten }}</option>
                                        @endforeach
                                    </select>
                                    @error('kabupaten')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                        id="kecamatan" name="kecamatan"
                                        value="{{ old('kecamatan', $member->kecamatan) }}" placeholder="Kecamatan">
                                    @error('kecamatan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kelurahan" class="form-label">Desa / Kelurahan</label>
                                    <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                        id="kelurahan" name="kelurahan"
                                        value="{{ old('kelurahan', $member->kelurahan) }}"
                                        placeholder="Desa / Kelurahan">
                                    @error('kelurahan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kode_pos" class="form-label">Kode Pos</label>
                                    <input type="number" class="form-control @error('kode_pos') is-invalid @enderror"
                                        id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $member->kode_pos) }}"
                                        placeholder="Kode Pos">
                                    @error('kode_pos')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Detail Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                        placeholder="Detail Alamat">{{ old('alamat', $member->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="tingkat_pendidikan">Tingkat Pendidikan</label>
                                    <div class="" id="tingkat_pendidikan">
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="sd" value="SD"
                                                @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == 'SD')>
                                            <label class="form-check-label" for="sd">SD/MI/Sederajat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="sltp" value="SLTP"
                                                @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == 'SLTP')>
                                            <label class="form-check-label" for="sltp">SLTP/SMP/MTs/Sederajat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="slta" value="SLTA"
                                                @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == 'SLTA')>
                                            <label class="form-check-label" for="slta">SLTA/SMA/MA/Sederajat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="d1d2d3" value="D1/D2/D3"
                                                @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == 'D1/D2/D3')>
                                            <label class="form-check-label" for="d1d2d3">D1/D2/D3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="d4s1" value="D4/S1"
                                                @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == 'D4/S1')>
                                            <label class="form-check-label" for="d4s1">D4/S1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="s2" value="S2"
                                                @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == 'S2')>
                                            <label class="form-check-label" for="s2">S2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="s3" value="S3"
                                                @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == 'S3')>
                                            <label class="form-check-label" for="s3">S3</label>
                                        </div>
                                    </div>
                                    @error('tingkat_pendidikan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                        id="pekerjaan" name="pekerjaan"
                                        value="{{ old('pekerjaan', $member->pekerjaan) }}" placeholder="Pekerjaan">
                                    @error('pekerjaan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <h4 class="mb-3">Data Paspor</h4>
                                <div class="mb-3">
                                    <label for="nomor_paspor" class="form-label">Nomor Paspor</label>
                                    <input type="text"
                                        class="form-control @error('nomor_paspor') is-invalid @enderror"
                                        id="nomor_paspor" name="nomor_paspor"
                                        value="{{ old('nomor_paspor', $member->nomor_paspor) }}"
                                        placeholder="Nomor Paspor">
                                    @error('nomor_paspor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_dikeluarkan" class="form-label">Tempat dikeluarkan
                                        (Kota/Kabupaten)</label>
                                    <input type="text"
                                        class="form-control @error('tempat_dikeluarkan') is-invalid @enderror"
                                        id="tempat_dikeluarkan" name="tempat_dikeluarkan"
                                        value="{{ old('tempat_dikeluarkan', $member->tempat_dikeluarkan) }}"
                                        placeholder="Tempat dikeluarkan">
                                    @error('tempat_dikeluarkan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_dikeluarkan" class="form-label">Tanggal dikeluarkan</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_dikeluarkan') is-invalid @enderror"
                                        id="tanggal_dikeluarkan" name="tanggal_dikeluarkan"
                                        value="{{ old('tanggal_dikeluarkan', $member->tanggal_dikeluarkan) }}"
                                        placeholder="Tanggal dikeluarkan">
                                    @error('tanggal_dikeluarkan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                                        id="tanggal_kadaluarsa" name="tanggal_kadaluarsa"
                                        value="{{ old('tanggal_kadaluarsa', $member->tanggal_kadaluarsa) }}"
                                        placeholder="Tanggal Kadaluarsa">
                                    @error('tanggal_kadaluarsa')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <h4 class="mb-3">Data Lainnya</h4>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('pernah_umroh') is-invalid @enderror"
                                            type="checkbox" value="1" id="pernah_umroh" name="pernah_umroh"
                                            @checked(old('pernah_umroh', $member->pernah_umroh))>
                                        <label class="form-check-label" for="pernah_umroh">
                                            Pernah Umroh?
                                        </label>
                                    </div>
                                    @error('pernah_umroh')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('pernah_haji') is-invalid @enderror"
                                            type="checkbox" value="1" id="pernah_haji" name="pernah_haji"
                                            @checked(old('pernah_haji', $member->pernah_haji))>
                                        <label class="form-check-label" for="pernah_haji">
                                            Pernah Haji?
                                        </label>
                                    </div>
                                    @error('pernah_haji')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_keluarga_terdekat" class="form-label">Nama Keluarga Terdekat</label>
                                    <input type="text"
                                        class="form-control @error('nama_keluarga_terdekat') is-invalid @enderror"
                                        id="nama_keluarga_terdekat" name="nama_keluarga_terdekat"
                                        value="{{ old('nama_keluarga_terdekat', $member->nama_keluarga_terdekat) }}"
                                        placeholder="Nama Keluarga Terdekat">
                                    @error('nama_keluarga_terdekat')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kontak_keluarga_terdekat" class="form-label">Kontak Keluarga
                                        Terdekat</label>
                                    <input type="text"
                                        class="form-control @error('kontak_keluarga_terdekat') is-invalid @enderror"
                                        id="kontak_keluarga_terdekat" name="kontak_keluarga_terdekat"
                                        value="{{ old('kontak_keluarga_terdekat', $member->kontak_keluarga_terdekat) }}"
                                        placeholder="Kontak Keluarga Terdekat">
                                    @error('kontak_keluarga_terdekat')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="{{ route('member.profile', ['mode' => 'show']) }}" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // When provinsi dropdown changes
            $('#provinsi').change(function() {
                // Get selected provinsi value
                var selectedProvinsi = $(this).val();

                // Make AJAX request to get kabupaten data
                $.ajax({
                    url: '/get-kabupaten',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        provinsi: selectedProvinsi
                    },
                    success: function(data) {
                        // Clear and update kabupaten dropdown
                        $('#kabupaten').empty();
                        $('#kabupaten').append(
                            '<option value="" selected disabled>Pilih Kabupaten</option>');

                        // Add new kabupaten options
                        $.each(data, function(key, value) {
                            $('#kabupaten').append('<option value="' + value.kabupaten +
                                '">' + value.kabupaten + '</option>');
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