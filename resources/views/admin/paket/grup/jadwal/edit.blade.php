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
                    <form action="/admin/jadwal/{{ $jadwal->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $jadwal->id }}">
                        <input type="hidden" name="grup_id" id="grup_id" value="{{ $jadwal->grup_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="nama_agenda" class="form-label">Nama Agenda</label>
                                    <input type="text" class="form-control  @error('nama_agenda') is-invalid @enderror"
                                        id="nama_agenda" name="nama_agenda"
                                        value="{{ old('nama_agenda', $jadwal->nama_agenda) }}" placeholder="Nama Agenda">
                                    @error('nama_agenda')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control  @error('lokasi') is-invalid @enderror"
                                        id="lokasi" name="lokasi" value="{{ old('lokasi', $jadwal->lokasi) }}"
                                        placeholder="Lokasi">
                                    @error('lokasi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                    <input type="datetime-local"
                                        class="form-control  @error('waktu_mulai') is-invalid @enderror" id="waktu_mulai"
                                        name="waktu_mulai" value="{{ old('waktu_mulai', $jadwal->waktu_mulai) }}"
                                        placeholder="Waktu Mulai">
                                    @error('waktu_mulai')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                    <input type="datetime-local"
                                        class="form-control  @error('waktu_selesai') is-invalid @enderror"
                                        id="waktu_selesai" name="waktu_selesai"
                                        value="{{ old('waktu_selesai', $jadwal->waktu_selesai) }}"
                                        placeholder="Waktu Selesai">
                                    @error('waktu_selesai')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control  @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                        placeholder="Keterangan">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/grup/{{ $jadwal->grup_id }}/jadwal"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
