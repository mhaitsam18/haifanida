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
                    <form action="/admin/penginapan/{{ $penginapan->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $penginapan->id }}">
                        <input type="hidden" name="paket_id" id="paket_id" value="{{ $penginapan->paket_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="hotel_id" class="form-label">Hotel</label>
                                    <select class="form-select  @error('hotel_id') is-invalid @enderror" id="hotel_id"
                                        name="hotel_id">
                                        <option value="" selected disabled>Pilih Hotel</option>
                                        @foreach ($hotels as $hotel)
                                            <option value="{{ $hotel->id }}" @selected($hotel->id == old('hotel_id', $penginapan->hotel_id))>
                                                {{ $hotel->nama_hotel }}</option>
                                        @endforeach
                                    </select>
                                    @error('hotel_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_reservasi" class="form-label">Nomor Reservasi</label>
                                    <input type="text"
                                        class="form-control  @error('nomor_reservasi') is-invalid @enderror"
                                        id="nomor_reservasi" name="nomor_reservasi"
                                        value="{{ old('nomor_reservasi', $penginapan->nomor_reservasi) }}"
                                        placeholder="Nomor Reservasi">
                                    @error('nomor_reservasi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_check_in" class="form-label">Tanggal Check In</label>
                                    <input type="date"
                                        class="form-control  @error('tanggal_check_in') is-invalid @enderror"
                                        id="tanggal_check_in" name="tanggal_check_in"
                                        value="{{ old('tanggal_check_in', $penginapan->tanggal_check_in) }}"
                                        placeholder="Tanggal Check In">
                                    @error('tanggal_check_in')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_check_out" class="form-label">Tanggal Check Out</label>
                                    <input type="date"
                                        class="form-control  @error('tanggal_check_out') is-invalid @enderror"
                                        id="tanggal_check_out" name="tanggal_check_out"
                                        value="{{ old('tanggal_check_out', $penginapan->tanggal_check_out) }}"
                                        placeholder="Tanggal Check Out">
                                    @error('tanggal_check_out')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_kamar" class="form-label">Jumlah Kamar</label>
                                    <input type="number" class="form-control  @error('jumlah_kamar') is-invalid @enderror"
                                        id="jumlah_kamar" name="jumlah_kamar"
                                        value="{{ old('jumlah_kamar', $penginapan->jumlah_kamar) }}"
                                        placeholder="Jumlah Kamar">
                                    @error('jumlah_kamar')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" class="form-control  @error('total_harga') is-invalid @enderror"
                                        id="total_harga" name="total_harga"
                                        value="{{ old('total_harga', $penginapan->total_harga) }}"
                                        placeholder="Total Harga">
                                    @error('total_harga')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan_hotel" class="form-label">Keterangan Hotel</label>
                                    <textarea class="form-control  @error('keterangan_hotel') is-invalid @enderror" id="keterangan_hotel"
                                        name="keterangan_hotel" placeholder="Keterangan Hotel">{{ old('keterangan_hotel', $penginapan->keterangan_hotel) }}</textarea>
                                    @error('keterangan_hotel')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/paket/{{ $penginapan->paket_id }}/penginapan"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
