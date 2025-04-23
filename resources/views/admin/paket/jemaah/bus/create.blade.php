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
                    <form action="/admin/bus-jemaah" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="bus_id" class="form-label">bus</label>
                                    <select class="form-select  @error('bus_id') is-invalid @enderror" id="bus_id"
                                        name="bus_id">
                                        <option value="" selected disabled>Pilih bus</option>
                                        @foreach ($buses as $item_bus)
                                            <option value="{{ $item_bus->id }}" @selected($item_bus->id == old('bus_id', $bus->id ?? null))>
                                                {{ $item_bus->nomor_rombongan }}</option>
                                        @endforeach
                                    </select>
                                    @error('bus_id')
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
                                            <option value="{{ $item_jemaah->id }}" @selected($item_jemaah->id == old('jemaah_id', $jemaah->id ?? null))>
                                                {{ $item_jemaah->nama_lengkap }}</option>
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
                                    <input type="text" class="form-control @error('nomor_kursi') is-invalid @enderror"
                                        id="nomor_kursi" name="nomor_kursi" value="{{ old('nomor_kursi') }}"
                                        placeholder="Nomor Kursi">
                                    @error('nomor_kursi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                @if ($jemaah)
                                    <a href="/admin/jemaah/{{ $jemaah->id }}/bus"
                                        class="btn btn-secondary float-end m-2">Kembali</a>
                                @elseif($bus)
                                    <a href="/admin/bus/{{ $bus->id }}"
                                        class="btn btn-secondary float-end m-2">Kembali</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
