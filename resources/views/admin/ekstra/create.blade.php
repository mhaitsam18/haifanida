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
                        {{-- <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="tambah" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="tambah">
                                <a class="dropdown-item d-flex align-items-center" href="/admin/ekstra/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div> --}}
                    </div>
                    <form action="/admin/ekstra" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="nama_ekstra" class="form-label">Nama Ekstra</label>
                                    <input type="text" class="form-control  @error('nama_ekstra') is-invalid @enderror"
                                        id="nama_ekstra" name="nama_ekstra" value="{{ old('nama_ekstra') }}"
                                        placeholder="Nama Ekstra">
                                    @error('nama_ekstra')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga_default" class="form-label">Harga Default / Harga Bawaan</label>
                                    <input type="text" class="form-control  @error('harga_default') is-invalid @enderror"
                                        id="harga_default" name="harga_default" value="{{ old('harga_default') }}"
                                        placeholder="Harga Default / Harga Bawaan">
                                    @error('harga_default')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_ekstra" class="form-label">Jenis Ekstra</label>
                                    <select class="form-select  @error('jenis_ekstra') is-invalid @enderror"
                                        id="jenis_ekstra" name="jenis_ekstra">
                                        <option value="">Jenis Ekstra</option>
                                        <option value="perlengkapan" @selected(old('jenis_ekstra') == 'perlengkapan')>Perlengkapan</option>
                                        <option value="jasa" @selected(old('jenis_ekstra') == 'jasa')>Jasa</option>
                                        <option value="permintaan kamar" @selected(old('jenis_ekstra') == 'permintaan kamar')>permintaan kamar
                                        </option>
                                        <option value="tipe kamar" @selected(old('jenis_ekstra') == 'tipe kamar')>Tipe Kamar</option>
                                        <option value="pesawat" @selected(old('jenis_ekstra') == 'pesawat')>Pesawat</option>
                                    </select>
                                    @error('jenis_ekstra')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                        placeholder="Deskripsi">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/ekstra" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
