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
                    <form action="/admin/penumpang" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="bus_id" id="bus_id" value="{{ $bus->id ?? null }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="jemaah_id" class="form-label">Jemaah</label>
                                    <select class="form-select @error('jemaah_id') is-invalid @enderror" id="jemaah_id"
                                        name="jemaah_id">
                                        <option value="" selected disabled>Pilih jemaah</option>
                                        @foreach ($jemaahs as $jemaah)
                                            <option value="{{ $jemaah->id }}" @selected(old('jemaah_id') == $jemaah->id)>
                                                {{ $jemaah->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jemaah_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_kursi" class="form-label">Nomor Kursi</label>
                                    <input type="number" class="form-control @error('nomor_kursi') is-invalid @enderror"
                                        id="nomor_kursi" name="nomor_kursi" value="{{ old('nomor_kursi') }}"
                                        placeholder="Nomor Kursi">
                                    @error('nomor_kursi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/{{ $bus ? 'bus/' . $bus->id . '/' : '' }}penumpang"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
