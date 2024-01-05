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
                    <form action="/admin/kantor/{{ $kantor->id }}" method="post">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $kantor->id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="nama_kantor" class="form-label">Nama Kantor</label>
                                    <input type="text" class="form-control  @error('nama_kantor') is-invalid @enderror"
                                        id="nama_kantor" name="nama_kantor"
                                        value="{{ old('nama_kantor', $kantor->nama_kantor) }}" placeholder="Nama Kantor">
                                    @error('nama_kantor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_ketua" class="form-label">Nama Ketua/Pimpinan</label>
                                    <input type="text" class="form-control  @error('nama_ketua') is-invalid @enderror"
                                        id="nama_ketua" name="nama_ketua"
                                        value="{{ old('nama_ketua', $kantor->nama_ketua) }}"
                                        placeholder="Nama Ketua/Pimpinan">
                                    @error('nama_ketua')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kontak_kantor" class="form-label">Kontak Kantor</label>
                                    <input type="text" class="form-control  @error('kontak_kantor') is-invalid @enderror"
                                        id="kontak_kantor" name="kontak_kantor"
                                        value="{{ old('kontak_kantor', $kantor->kontak_kantor) }}"
                                        placeholder="Kontak Kantor">
                                    @error('kontak_kantor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="provinsi_id" class="form-label">Provinsi</label>
                                    <select class="form-select @error('provinsi_id') is-invalid @enderror" id="provinsi_id"
                                        name="provinsi_id">
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        @foreach ($provinsis as $provinsi)
                                            <option value="{{ $provinsi->id }}" @selected($provinsi->id == old('provinsi_id', $kantor->kabupaten->provinsi_id))>
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
                                            <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == old('kabupaten_id', $kantor->kabupaten_id))>
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
                                    <label for="alamat_kantor" class="form-label">Detail Alamat</label>
                                    <textarea class="form-control  @error('alamat_kantor') is-invalid @enderror" id="alamat_kantor" name="alamat_kantor"
                                        value="" placeholder="Alamat Kantor">{{ old('alamat_kantor', $kantor->alamat_kantor) }}</textarea>
                                    @error('alamat_kantor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kode_pos" class="form-label">Kode Pos</label>
                                    <input type="number" class="form-control  @error('kode_pos') is-invalid @enderror"
                                        id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $kantor->kode_pos) }}"
                                        placeholder="Kode Pos">
                                    @error('kode_pos')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kantor" class="form-label">Jenis Kantor</label>
                                    <select class="form-select  @error('jenis_kantor') is-invalid @enderror"
                                        id="jenis_kantor" name="jenis_kantor"
                                        value="{{ old('jenis_kantor', $kantor->jenis_kantor) }}"
                                        placeholder="Jenis Kantor">
                                        <option value="" selected disabled>Pilih Jenis Kantor</option>
                                        <option value="pusat" @selected(old('jenis_kantor', $kantor->jenis_kantor) == 'pusat')>Pusat</option>
                                        <option value="perwakilan" @selected(old('jenis_kantor', $kantor->jenis_kantor) == 'perwakilan')>Perwakilan</option>
                                        <option value="cabang" @selected(old('jenis_kantor', $kantor->jenis_kantor) == 'cabang')>Cabang</option>
                                        <option value="agen" @selected(old('jenis_kantor', $kantor->jenis_kantor) == 'agen')>Agen</option>
                                    </select>
                                    @error('jenis_kantor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="foto_kantor" class="form-label">Foto Kantor</label>
                                    <input type="file" class="form-control  @error('foto_kantor') is-invalid @enderror"
                                        id="foto_kantor" name="foto_kantor">
                                    @error('foto_kantor')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/kantor" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset('storage/' . $kantor->foto_kantor) }}" alt=""
                                    class="img-thumbnail img-fluid img-preview">
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
            $('#foto_kantor').on('change', function() {
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
