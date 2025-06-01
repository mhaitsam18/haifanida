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
                    <form action="/admin/pembayaran/{{ $pembayaran->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $pembayaran->id }}">
                        <input type="hidden" name="pemesanan_id" id="pemesanan_id" value="{{ $pembayaran->pemesanan_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                                    <input type="number"
                                        class="form-control @error('jumlah_pembayaran') is-invalid @enderror"
                                        id="jumlah_pembayaran" name="jumlah_pembayaran"
                                        value="{{ old('jumlah_pembayaran', $pembayaran->jumlah_pembayaran) }}"
                                        placeholder="Jumlah Pembayaran">
                                    @error('jumlah_pembayaran')
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
                                        value="{{ old('metode_pembayaran', $pembayaran->metode_pembayaran) }}"
                                        placeholder="(Transfer / QRIS / dll.)">
                                    @error('metode_pembayaran')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                                        id="tanggal_pembayaran" name="tanggal_pembayaran"
                                        value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran) }}"
                                        placeholder="Tanggal Pembayaran">
                                    @error('tanggal_pembayaran')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                                {{-- MODIFIED --}}
                                <div class="mb-3">
                                    <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                                        id="tanggal_pembayaran" name="tanggal_pembayaran"
                                        value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran ? \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('Y-m-d') : '') }}"
                                        placeholder="Tanggal Pembayaran"
                                        readonly> <!-- Tambahkan readonly jika admin hanya memverifikasi status -->
                                    @error('tanggal_pembayaran')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                @enderror
                                </div>
                                {{-- END MODIFIED --}}
                                <div class="mb-3">
                                    <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                                    <input type="file"
                                        class="form-control @error('bukti_pembayaran') is-invalid @enderror"
                                        id="bukti_pembayaran" name="bukti_pembayaran"
                                        value="{{ old('bukti_pembayaran', $pembayaran->bukti_pembayaran) }}">
                                    @error('bukti_pembayaran')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                                    <select class="form-select @error('status_pembayaran') is-invalid @enderror"
                                        id="status_pembayaran" name="status_pembayaran">
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="tertunda" @selected('tertunda' == old('status_pembayaran', $pembayaran->status_pembayaran))>Tertunda</option>
                                        <option value="diterima" @selected('diterima' == old('status_pembayaran', $pembayaran->status_pembayaran))>diterima</option>
                                        <option value="ditolak" @selected('ditolak' == old('status_pembayaran', $pembayaran->status_pembayaran))>ditolak</option>
                                    </select>
                                    @error('status_pembayaran')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                        placeholder="Keterangan">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/{{ $pembayaran->pemesanan_id ? 'pemesanan/' . $pembayaran->pemesanan_id . '/' : '' }}pembayaran"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
