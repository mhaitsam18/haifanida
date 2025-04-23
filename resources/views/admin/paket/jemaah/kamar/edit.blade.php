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
                    <form action="/admin/kamar-jemaah/{{ $kamarJemaah->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $kamarJemaah->id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="kamar_id" class="form-label">Kamar</label>
                                    <select class="form-select  @error('kamar_id') is-invalid @enderror" id="kamar_id"
                                        name="kamar_id">
                                        <option value="" selected disabled>Pilih Kamar</option>
                                        @foreach ($kamars as $item_kamar)
                                            <option value="{{ $item_kamar->id }}" @selected($item_kamar->id == old('kamar_id', $kamarJemaah->kamar_id))>
                                                {{ $item_kamar->nomor_kamar }}</option>
                                        @endforeach
                                    </select>
                                    @error('kamar_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jemaah_id" class="form-label">Jemaah</label>
                                    <select class="form-select  @error('jemaah_id') is-invalid @enderror" id="jemaah_id"
                                        name="jemaah_id">
                                        <option value="" selected disabled>Pilih Jemaah</option>
                                        @foreach ($jemaahs as $item_jemaah)
                                            <option value="{{ $item_jemaah->id }}" @selected($item_jemaah->id == old('jemaah_id', $kamarJemaah->jemaah_id))>
                                                {{ $item_jemaah->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                    @error('jemaah_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="javascript:history.back()" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
