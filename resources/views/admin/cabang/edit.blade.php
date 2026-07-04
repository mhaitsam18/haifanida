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
                    <form action="/admin/cabang/{{ $cabang->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="nama_kantor" class="form-label">Nama Cabang</label>
                                    <input type="text" class="form-control  @error('nama_kantor') is-invalid @enderror"
                                        id="nama_kantor" name="nama_kantor"
                                        value="{{ old('nama_kantor', $cabang->nama_kantor) }}" placeholder="Nama Cabang">
                                    @error('nama_kantor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="induk_kantor_id" class="form-label">Perwakilan Induk</label>
                                    <select class="form-select  @error('induk_kantor_id') is-invalid @enderror"
                                        id="induk_kantor_id" name="induk_kantor_id">
                                        <option value="" selected>Tidak ada (langsung di bawah Pusat)</option>
                                        @foreach ($perwakilans as $perwakilan)
                                            <option value="{{ $perwakilan->id }}"
                                                @selected($perwakilan->id == old('induk_kantor_id', $cabang->induk_kantor_id))>
                                                {{ $perwakilan->nama_kantor }}</option>
                                        @endforeach
                                    </select>
                                    @error('induk_kantor_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_ketua" class="form-label">Nama Ketua</label>
                                    <input type="text" class="form-control  @error('nama_ketua') is-invalid @enderror"
                                        id="nama_ketua" name="nama_ketua"
                                        value="{{ old('nama_ketua', $cabang->nama_ketua) }}" placeholder="Nama Ketua">
                                    @error('nama_ketua')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kontak_kantor" class="form-label">Kontak</label>
                                    <input type="text" class="form-control  @error('kontak_kantor') is-invalid @enderror"
                                        id="kontak_kantor" name="kontak_kantor"
                                        value="{{ old('kontak_kantor', $cabang->kontak_kantor) }}" placeholder="Kontak">
                                    @error('kontak_kantor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="surat_izin" class="form-label">Nomor Surat Izin</label>
                                    <input type="text" class="form-control  @error('surat_izin') is-invalid @enderror"
                                        id="surat_izin" name="surat_izin"
                                        value="{{ old('surat_izin', $cabang->surat_izin) }}" placeholder="Nomor Surat Izin">
                                    @error('surat_izin')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="provinsi_id" class="form-label">Provinsi</label>
                                    <select class="form-select @error('provinsi_id') is-invalid @enderror"
                                        id="provinsi_id" name="provinsi_id">
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        @foreach ($provinsis as $provinsi)
                                            <option value="{{ $provinsi->id }}"
                                                @selected($provinsi->id == old('provinsi_id', $cabang->kabupaten->provinsi_id ?? null))>
                                                {{ $provinsi->provinsi }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kabupaten_id" class="form-label">Kabupaten / Kota</label>
                                    <select class="form-select @error('kabupaten_id') is-invalid @enderror"
                                        id="kabupaten_id" name="kabupaten_id">
                                        <option value="" selected disabled>Pilih Kabupaten</option>
                                        @foreach ($kabupatens as $kabupaten)
                                            <option value="{{ $kabupaten->id }}"
                                                @selected($kabupaten->id == old('kabupaten_id', $cabang->kabupaten_id))>
                                                {{ $kabupaten->kabupaten }}</option>
                                        @endforeach
                                    </select>
                                    @error('kabupaten_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control  @error('kecamatan') is-invalid @enderror"
                                        id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $cabang->kecamatan) }}"
                                        placeholder="Kecamatan">
                                    @error('kecamatan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_kantor" class="form-label">Detail Alamat</label>
                                    <textarea class="form-control  @error('alamat_kantor') is-invalid @enderror" id="alamat_kantor"
                                        name="alamat_kantor" placeholder="Alamat">{{ old('alamat_kantor', $cabang->alamat_kantor) }}</textarea>
                                    @error('alamat_kantor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kode_pos" class="form-label">Kode Pos</label>
                                    <input type="number" class="form-control  @error('kode_pos') is-invalid @enderror"
                                        id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $cabang->kode_pos) }}"
                                        placeholder="Kode Pos">
                                    @error('kode_pos')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/cabang" class="btn btn-secondary float-end m-2">Kembali</a>
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
            $('#provinsi_id').change(function() {
                var selectedProvinsi = $(this).val();
                $.ajax({
                    url: '/get-kabupaten',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        provinsi_id: selectedProvinsi,
                    },
                    success: function(data) {
                        $('#kabupaten_id').empty();
                        $('#kabupaten_id').append(
                            '<option value="" selected disabled>Pilih Kabupaten</option>');
                        $.each(data, function(key, value) {
                            $('#kabupaten_id').append('<option value="' + value.id +
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
