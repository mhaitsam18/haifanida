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
                    <form action="/admin/isu-perjalanan" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="grup_id" id="grup_id" value="{{ $grup->id ?? null }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="masalah" class="form-label">Masalah</label>
                                    <input type="text" class="form-control  @error('masalah') is-invalid @enderror"
                                        id="masalah" name="masalah" value="{{ old('masalah') }}"
                                        placeholder="Nama Agenda">
                                    @error('masalah')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="solusi" class="form-label">Solusi</label>
                                    <input type="text" class="form-control  @error('solusi') is-invalid @enderror"
                                        id="solusi" name="solusi" value="{{ old('solusi') }}" placeholder="Solusi">
                                    @error('solusi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_pelaporan" class="form-label">Waktu Pelaporan</label>
                                    <input type="datetime-local"
                                        class="form-control  @error('waktu_pelaporan') is-invalid @enderror"
                                        id="waktu_pelaporan" name="waktu_pelaporan" value="{{ old('waktu_pelaporan') }}"
                                        placeholder="Waktu Pelaporan">
                                    @error('waktu_pelaporan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_penyelesaian" class="form-label">Waktu Penyelesaian</label>
                                    <input type="datetime-local"
                                        class="form-control  @error('waktu_penyelesaian') is-invalid @enderror"
                                        id="waktu_penyelesaian" name="waktu_penyelesaian"
                                        value="{{ old('waktu_penyelesaian') }}" placeholder="Waktu Penyelesaian">
                                    @error('waktu_penyelesaian')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('status') is-invalid @enderror"
                                            type="checkbox" value="1" id="status" name="status"
                                            @checked(old('status'))>
                                        <label class="form-check-label" for="status">
                                            Dalam Penanganan?
                                        </label>
                                    </div>
                                    @error('status')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/grup/{{ $grup->id }}/isu-perjalanan"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
