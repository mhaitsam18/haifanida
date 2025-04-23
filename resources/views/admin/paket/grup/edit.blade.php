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
                    <form action="/admin/grup/{{ $grup->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $grup->id }}">
                        <input type="hidden" name="paket_id" id="paket_id" value="{{ $grup->paket_id }}">
                        <h4 class="mb-3">{{ $grup->paket->nama_paket ?? null }}</h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="agen_id" class="form-label">Agen</label>
                                    <select class="form-select @error('agen_id') is-invalid @enderror" id="agen_id"
                                        name="agen_id">
                                        <option value="">Pilih Agen</option>
                                        @foreach ($agens as $agen)
                                            <option value="{{ $agen->id }}" @selected($agen->id == old('agen_id', $grup->agen_id))>
                                                {{ $agen->user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('agen_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_grup" class="form-label">Nama Grup</label>
                                    <input type="text" class="form-control @error('nama_grup') is-invalid @enderror"
                                        id="nama_grup" name="nama_grup" value="{{ old('nama_grup', $grup->nama_grup) }}"
                                        placeholder="Nama Grup">
                                    @error('nama_grup')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ketua_grup" class="form-label">Ketua Grup</label>
                                    <input type="text" class="form-control @error('ketua_grup') is-invalid @enderror"
                                        id="ketua_grup" name="ketua_grup"
                                        value="{{ old('ketua_grup', $grup->ketua_grup) }}" placeholder="Ketua Grup">
                                    @error('ketua_grup')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status_grup" class="form-label">Status Grup</label>
                                    <input type="text" class="form-control @error('status_grup') is-invalid @enderror"
                                        id="status_grup" name="status_grup"
                                        value="{{ old('status_grup', $grup->status_grup) }}" placeholder="Status Grup">
                                    @error('status_grup')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kuota_grup" class="form-label">Kuota Grup</label>
                                    <input type="number" class="form-control @error('kuota_grup') is-invalid @enderror"
                                        id="kuota_grup" name="kuota_grup"
                                        value="{{ old('kuota_grup', $grup->kuota_grup) }}" placeholder="Kuota Grup">
                                    @error('kuota_grup')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan_grup" class="form-label">Keterangan Grup</label>
                                    <textarea class="form-control @error('keterangan_grup') is-invalid @enderror" id="keterangan_grup"
                                        name="keterangan_grup" placeholder="Keterangan Grup">{{ old('keterangan_grup', $grup->keterangan_grup) }}</textarea>
                                    @error('keterangan_grup')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/paket/{{ $grup->paket_id }}/grup"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
