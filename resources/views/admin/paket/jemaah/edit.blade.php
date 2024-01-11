@extends('admin.layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            {{-- <h4 class="mb-3 mb-md-0">{{ $title }}</h4> --}}
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-2">{{ $title }}</h6>
                    </div>
                    <form action="/admin/jemaah/{{ $jemaah->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $jemaah->id }}">
                        <input type="hidden" name="pemesanan_id" id="pemesanan_id" value="{{ $jemaah->pemesanan_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="mb-3">Data Jemaah</h4>
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap (Sesuai KTP)</label>
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                        id="nama_lengkap" name="nama_lengkap"
                                        value="{{ old('nama_lengkap', $jemaah->nama_lengkap) }}" placeholder="Nama Lengkap">
                                    @error('nama_lengkap')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $jemaah->email) }}"
                                        placeholder="Email">
                                    <span id="email-availability"></span>
                                    @error('email')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">Nomor Ponsel</label>
                                    <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                        id="nomor_telepon" name="nomor_telepon"
                                        value="{{ old('nomor_telepon', $jemaah->nomor_telepon) }}"
                                        placeholder="Nomor Ponsel">
                                    @error('nomor_telepon')
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
                                                <img src="{{ asset('storage/' . $jemaah->foto) }}"
                                                    class="img-thumbnail img-preview">
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    {{-- <label class="input-group-text" for="foto">Foto</label> --}}
                                                    <input type="file"
                                                        class="form-control @error('foto') is-invalid @enderror img-input"
                                                        id="foto" name="foto">
                                                    @error('foto')
                                                        <div class="text-danger fs-6">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="grup_id" class="form-label">Grup</label>
                                    <select class="form-select @error('grup_id') is-invalid @enderror" id="grup_id"
                                        name="grup_id">
                                        <option value="" selected disabled>Pilih Grup</option>
                                        @foreach ($grups as $grup)
                                            <option value="{{ $grup->id }}" @selected($grup->id == old('grup_id', $jemaah->grup_id))>
                                                {{ $grup->nama_grup }}</option>
                                        @endforeach
                                    </select>
                                    @error('grup_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="mahram_id" class="form-label">Mahram (Khusus Jemaah perempuan)</label>
                                    <select class="form-select @error('mahram_id') is-invalid @enderror" id="mahram_id"
                                        name="mahram_id">
                                        <option value="" selected disabled>Pilih Mahram</option>
                                        @foreach ($jemaahs as $item)
                                            <option value="{{ $item->id }}" @selected($item->id == old('mahram_id', $item->mahram_id))>
                                                {{ $item->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                    @error('mahram_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="hubungan_mahram" class="form-label">Hubungan dengan Mahram</label>
                                    <select class="form-select @error('hubungan_mahram') is-invalid @enderror"
                                        id="hubungan_mahram" name="hubungan_mahram">
                                        <option value="" selected disabled>Pilih Hubungan</option>
                                        <option value="Ayah" @selected(old('hubungan_mahram', $jemaah->hubungan_mahram) == 'Ayah')>Ayah</option>
                                        <option value="Anak" @selected(old('hubungan_mahram', $jemaah->hubungan_mahram) == 'Anak')>Anak</option>
                                        <option value="Suami" @selected(old('hubungan_mahram', $jemaah->hubungan_mahram) == 'Suami')>Suami</option>
                                        <option value="Saudara Kandung" @selected(old('hubungan_mahram', $jemaah->hubungan_mahram) == 'Saudara Kandung')>Saudara Kandung
                                        </option> Kandung
                                        <option value="Kakek" @selected(old('hubungan_mahram', $jemaah->hubungan_mahram) == 'Kakek')>Kakek</option>
                                        <option value="Cucu" @selected(old('hubungan_mahram', $jemaah->hubungan_mahram) == 'Cucu')>Cucu</option>
                                        <option value="Paman" @selected(old('hubungan_mahram', $jemaah->hubungan_mahram) == 'Paman')>Paman</option>
                                        <option value="Keponakan" @selected(old('hubungan_mahram', $jemaah->hubungan_mahram) == 'Keponakan')>Keponakan</option>
                                    </select>
                                    @error('hubungan_mahram')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="nomor_ktp" class="form-label">Nomor KTP</label>
                                    <input type="number" class="form-control @error('nomor_ktp') is-invalid @enderror"
                                        id="nomor_ktp" name="nomor_ktp"
                                        value="{{ old('nomor_ktp', $jemaah->nomor_ktp) }}" placeholder="Nomor KTP">
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
                                        value="{{ old('nama_sesuai_paspor', $jemaah->nama_sesuai_paspor) }}"
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
                                        value="{{ old('tempat_lahir', $jemaah->tempat_lahir) }}"
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
                                        value="{{ old('tanggal_lahir', $jemaah->tanggal_lahir) }}"
                                        placeholder="Tanggal Lahir">
                                    @error('tanggal_lahir')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" @selected(old('jenis_kelamin', $jemaah->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                                        <option value="Perempuan" @selected(old('jenis_kelamin', $jemaah->jenis_kelamin) == 'Perempuan')>Perempuan</option>
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
                                                @checked(old('golongan_darah', $jemaah->golongan_darah) == 'A')>
                                            <label class="form-check-label" for="A">A</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('golongan_darah') is-invalid @enderror"
                                                type="radio" name="golongan_darah" id="B" value="B"
                                                @checked(old('golongan_darah', $jemaah->golongan_darah) == 'B')>
                                            <label class="form-check-label" for="B">B</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('golongan_darah') is-invalid @enderror"
                                                type="radio" name="golongan_darah" id="AB" value="AB"
                                                @checked(old('golongan_darah', $jemaah->golongan_darah) == 'AB')>
                                            <label class="form-check-label" for="AB">AB</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('golongan_darah') is-invalid @enderror"
                                                type="radio" name="golongan_darah" id="O" value="O"
                                                @checked(old('golongan_darah', $jemaah->golongan_darah) == 'O')>
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
                                                @checked(old('kewarganegaraan', $jemaah->kewarganegaraan) == 'WNI')>
                                            <label class="form-check-label" for="wni">WNI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('kewarganegaraan') is-invalid @enderror"
                                                type="radio" name="kewarganegaraan" id="wna" value="WNA"
                                                @checked(old('kewarganegaraan', $jemaah->kewarganegaraan) == 'WNA')>
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
                                    <select class="form-select @error('provinsi') is-invalid @enderror" id="provinsi"
                                        name="provinsi">
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        @foreach ($provinsis as $provinsi)
                                            <option value="{{ $provinsi->provinsi }}" @selected($provinsi->provinsi == old('provinsi', $jemaah->provinsi))>
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
                                            <option value="{{ $kabupaten->kabupaten }}" @selected($kabupaten->kabupaten == old('kabupaten', $jemaah->kabupaten))>
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
                                        value="{{ old('kecamatan', $jemaah->kecamatan) }}" placeholder="Kecamatan">
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
                                        value="{{ old('kelurahan', $jemaah->kelurahan) }}"
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
                                        id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $jemaah->kode_pos) }}"
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
                                        placeholder="Detail Alamat">{{ old('alamat', $jemaah->alamat) }}</textarea>
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
                                                @checked(old('tingkat_pendidikan', $jemaah->tingkat_pendidikan) == 'SD')>
                                            <label class="form-check-label" for="sd">SD/MI/Sederajat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="sltp" value="SLTP"
                                                @checked(old('tingkat_pendidikan', $jemaah->tingkat_pendidikan) == 'SLTP')>
                                            <label class="form-check-label" for="sltp">SLTP/SMP/MTs/Sederajat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="slta" value="SLTA"
                                                @checked(old('tingkat_pendidikan', $jemaah->tingkat_pendidikan) == 'SLTA')>
                                            <label class="form-check-label" for="slta">SLTA/SMA/MA/Sederajat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="d1d2d3" value="D1/D2/D3"
                                                @checked(old('tingkat_pendidikan', $jemaah->tingkat_pendidikan) == 'D1/D2/D3')>
                                            <label class="form-check-label" for="d1d2d3">D1/D2/D3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="d4s1" value="D4/S1"
                                                @checked(old('tingkat_pendidikan', $jemaah->tingkat_pendidikan) == 'D4/S1')>
                                            <label class="form-check-label" for="d4s1">D4/S1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="s2" value="S2"
                                                @checked(old('tingkat_pendidikan', $jemaah->tingkat_pendidikan) == 'S2')>
                                            <label class="form-check-label" for="s2">S2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="radio" name="tingkat_pendidikan" id="s3" value="S3"
                                                @checked(old('tingkat_pendidikan', $jemaah->tingkat_pendidikan) == 'S3')>
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
                                        value="{{ old('pekerjaan', $jemaah->pekerjaan) }}" placeholder="Pekerjaan">
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
                                        value="{{ old('nomor_paspor', $jemaah->nomor_paspor) }}"
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
                                        value="{{ old('tempat_dikeluarkan', $jemaah->tempat_dikeluarkan) }}"
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
                                        value="{{ old('tanggal_dikeluarkan', $jemaah->tanggal_dikeluarkan) }}"
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
                                        value="{{ old('tanggal_kadaluarsa', $jemaah->tanggal_kadaluarsa) }}"
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
                                            @checked(old('pernah_umroh', $jemaah->pernah_umroh))>
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
                                            @checked(old('pernah_haji', $jemaah->pernah_haji))>
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
                                        value="{{ old('nama_keluarga_terdekat', $jemaah->nama_keluarga_terdekat) }}"
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
                                        value="{{ old('kontak_keluarga_terdekat', $jemaah->kontak_keluarga_terdekat) }}"
                                        placeholder="Kontak Keluarga Terdekat">
                                    @error('kontak_keluarga_terdekat')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/paket/{{ $paket->id }}/jemaah"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
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
