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
                    <form action="/admin/berkas-jemaah/{{ $berkasJemaah->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $berkasJemaah->id }}">
                        <input type="hidden" name="jemaah_id" id="jemaah_id" value="{{ $berkasJemaah->jemaah_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="berkas_id" class="form-label">Nama Berkas</label>
                                    <select class="form-select  @error('berkas_id') is-invalid @enderror" id="berkas_id"
                                        name="berkas_id">
                                        <option value="" selected disabled>Pilih Berkas</option>
                                        @foreach ($berkass as $item_berkas)
                                            <option value="{{ $item_berkas->id }}" @selected($item_berkas->id == old('berkas_id', $berkasJemaah->berkas_id, $berkas->id ?? null))>
                                                {{ $item_berkas->nama_berkas }}</option>
                                        @endforeach
                                    </select>
                                    @error('berkas_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" value="{{ old('status', $berkasJemaah->status) }}"
                                        placeholder="Status">
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="tertunda" @selected(old('status', $berkasJemaah->status) == 'tertunda')>Tertunda</option>
                                        <option value="diverifikasi" @selected(old('status', $berkasJemaah->status) == 'diverifikasi')>diverifikasi</option>
                                        <option value="ditolak" @selected(old('status', $berkasJemaah->status) == 'ditolak')>ditolak</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="file_path" class="form-label">File Berkas</label>
                                    <input type="file" class="form-control @error('file_path') is-invalid @enderror"
                                        id="file_path" name="file_path"
                                        value="{{ old('file_path', $berkasJemaah->file_path) }}" placeholder="File Berkas">
                                    @error('file_path')
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
