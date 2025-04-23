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
                    <form action="/admin/index" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="nama_cabang" class="form-label">Nama Cabang</label>
                                    <input type="text" class="form-control  @error('nama_cabang') is-invalid @enderror"
                                        id="nama_cabang" name="nama_cabang" value="{{ old('nama_cabang') }}"
                                        placeholder="Nama Cabang">
                                    @error('nama_cabang')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="perwakilan_id" class="form-label">Perwakilan</label>
                                    <select class="form-select  @error('perwakilan_id') is-invalid @enderror"
                                        id="perwakilan_id" name="perwakilan_id" value="{{ old('perwakilan_id') }}"
                                        placeholder="perwakilan">
                                        <option value="" selected>Pilih Perwakilan</option>
                                        <option value="">Pusat</option>
                                        @foreach ($perwakilans as $perwakilan)
                                            <option value="{{ $perwakilan->id }}" @selected($perwakilan->id == old('perwakilan_id'))>
                                                {{ $perwakilan->nama_perwakilan }}
                                        @endforeach
                                    </select>
                                    @error('perwakilan_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_ketua" class="form-label">Nama Ketua</label>
                                    <input type="text" class="form-control  @error('nama_ketua') is-invalid @enderror"
                                        id="nama_ketua" name="nama_ketua" value="{{ old('nama_ketua') }}"
                                        placeholder="Nama Ketua">
                                    @error('nama_ketua')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kontak" class="form-label">Kontak</label>
                                    <input type="text" class="form-control  @error('kontak') is-invalid @enderror"
                                        id="kontak" name="kontak" value="{{ old('kontak') }}" placeholder="Kontak">
                                    @error('kontak')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="surat_izin" class="form-label">Surat Izin</label>
                                    <input type="file" class="form-control  @error('surat_izin') is-invalid @enderror"
                                        id="surat_izin" name="surat_izin" value="{{ old('surat_izin') }}"
                                        placeholder="Surat Izin">
                                    @error('surat_izin')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kantor_id" class="form-label">Kantor</label>
                                    <select class="form-select  @error('kantor_id') is-invalid @enderror" id="kantor_id"
                                        name="kantor_id" value="{{ old('kantor_id') }}" placeholder="Kantor">
                                        <option value="" selected disabled>Pilih Kantor</option>
                                        @foreach ($kantors as $kantor)
                                            <option value="{{ $kantor->id }}" @selected($kantor->id == old('kantor_id'))>
                                                {{ $kantor->nama_kantor }} |
                                                {{ $kantor->kabupaten->kabupaten }}</option>
                                        @endforeach
                                    </select>
                                    <small><a href="/admin/kantor/create/">Opsi kantor tidak ada? klik di sini</a></small>
                                    @error('kantor_id')
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
