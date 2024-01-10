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
                    <form action="/admin/pemesanan/{{ $pemesanan->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $pemesanan->id }}">
                        <input type="hidden" name="paket_id" id="paket_id" value="{{ $pemesanan->paket_id }}">
                        {{-- <input type="hidden" name="user_id" id="user_id" value="{{ $pemesanan->user_id }}"> --}}
                        <h4 class="mb-3">{{ $paket->nama_paket ?? null }}</h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Pemesan</label>
                                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id"
                                        name="user_id">
                                        <option value="">Pilih Pemesan</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @selected($user->id == old('user_id', $pemesanan->user_id))>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="Tertunda" @selected('Tertunda' == old('user_id', $pemesanan->user_id))>Tertunda</option>
                                        <option value="dikonfirmasi" @selected('dikonfirmasi' == old('user_id', $pemesanan->user_id))>dikonfirmasi</option>
                                        <option value="diterima" @selected('diterima' == old('user_id', $pemesanan->user_id))>diterima</option>
                                        <option value="ditolak" @selected('ditolak' == old('user_id', $pemesanan->user_id))>ditolak</option>
                                        <option value="dibatalkan" @selected('dibatalkan' == old('user_id', $pemesanan->user_id))>dibatalkan</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_pesan" class="form-label">Tanggal Pemesanan</label>
                                    <input type="date" class="form-control @error('tanggal_pesan') is-invalid @enderror"
                                        id="tanggal_pesan" name="tanggal_pesan"
                                        value="{{ old('tanggal_pesan', $pemesanan->tanggal_pesan) }}"
                                        placeholder="Tanggal Pemesanan">
                                    @error('tanggal_pesan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_orang" class="form-label">Jumlah Jema'ah / Wisatawan</label>
                                    <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror"
                                        id="jumlah_orang" name="jumlah_orang"
                                        value="{{ old('jumlah_orang', $pemesanan->jumlah_orang) }}"
                                        placeholder="Jumlah Jema'ah / Wisatawan">
                                    @error('jumlah_orang')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" class="form-control @error('total_harga') is-invalid @enderror"
                                        id="total_harga" name="total_harga"
                                        value="{{ old('total_harga', $pemesanan->total_harga) }}"
                                        placeholder="Total Harga">
                                    @error('total_harga')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                    <input type="text"
                                        class="form-control @error('metode_pembayaran') is-invalid @enderror"
                                        id="metode_pembayaran" name="metode_pembayaran"
                                        value="{{ old('metode_pembayaran', $pemesanan->metode_pembayaran, 'Cash') }}"
                                        placeholder="Metode Pembayaran">
                                    @error('metode_pembayaran')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('is_pembayaran_lunas') is-invalid @enderror"
                                            type="checkbox" value="1" id="is_pembayaran_lunas"
                                            name="is_pembayaran_lunas" @checked(old('is_pembayaran_lunas', $pemesanan->is_pembayaran_lunas))>
                                        <label class="form-check-label" for="is_pembayaran_lunas">
                                            Sudah Lunas?
                                        </label>
                                    </div>
                                    @error('is_pembayaran_lunas')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_pelunasan" class="form-label">Tanggal Pelunasan</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_pelunasan') is-invalid @enderror"
                                        id="tanggal_pelunasan" name="tanggal_pelunasan"
                                        value="{{ old('tanggal_pelunasan', $pemesanan->tanggal_pelunasan) }}"
                                        placeholder="Tanggal Pelunasan">
                                    @error('tanggal_pelunasan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/paket/{{ $pemesanan->paket_id }}/pemesanan"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
