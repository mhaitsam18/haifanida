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
                    <form action="/admin/paket-ekstra" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="paket_id" id="paket_id" value="{{ $paket->id ?? null }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="ekstra_id" class="form-label">Ekstra</label>
                                    <select class="form-select  @error('ekstra_id') is-invalid @enderror" id="ekstra_id"
                                        name="ekstra_id">
                                        <option value="" selected disabled>Pilih Ekstra</option>
                                        @foreach ($ekstras as $ekstra)
                                            <option value="{{ $ekstra->id }}" @selected($ekstra->id == old('ekstra_id'))>
                                                {{ $ekstra->nama_ekstra }}</option>
                                        @endforeach
                                    </select>
                                    @error('ekstra_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control  @error('harga') is-invalid @enderror"
                                        id="harga" name="harga" value="{{ old('harga') }}" placeholder="Harga">
                                    @error('harga')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/paket/{{ $paket->id }}/paket-ekstra"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
