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
                    <form action="/admin/penerbangan/{{ $penerbangan->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $penerbangan->id }}">
                        <input type="hidden" name="paket_id" id="paket_id" value="{{ $penerbangan->paket_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="maskapai_id" class="form-label">Maskapai</label>
                                    <select class="form-select  @error('maskapai_id') is-invalid @enderror" id="maskapai_id"
                                        name="maskapai_id">
                                        <option value="" selected disabled>Pilih Maskapai</option>
                                        @foreach ($maskapais as $maskapai)
                                            <option value="{{ $maskapai->id }}" @selected($maskapai->id == old('maskapai_id', $penerbangan->maskapai_id))>
                                                {{ $maskapai->nama_maskapai }}</option>
                                        @endforeach
                                    </select>
                                    @error('maskapai_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_penerbangan" class="form-label">Nomor Penerbangan</label>
                                    <input type="text"
                                        class="form-control  @error('nomor_penerbangan') is-invalid @enderror"
                                        id="nomor_penerbangan" name="nomor_penerbangan"
                                        value="{{ old('nomor_penerbangan', $penerbangan->nomor_penerbangan) }}"
                                        placeholder="Nomor Penerbangan">
                                    @error('nomor_penerbangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_pnr" class="form-label">PNR</label>
                                    <input type="text" class="form-control  @error('nomor_pnr') is-invalid @enderror"
                                        id="nomor_pnr" name="nomor_pnr"
                                        value="{{ old('nomor_pnr', $penerbangan->nomor_pnr) }}" placeholder="PNR">
                                    @error('nomor_pnr')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <input type="text" class="form-control  @error('kelas') is-invalid @enderror"
                                        id="kelas" name="kelas" value="{{ old('kelas', $penerbangan->kelas) }}"
                                        placeholder="Kelas">
                                    @error('kelas')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kuota" class="form-label">Kuota</label>
                                    <input type="number" class="form-control  @error('kuota') is-invalid @enderror"
                                        id="kuota" name="kuota" value="{{ old('kuota', $penerbangan->kuota) }}"
                                        placeholder="Kuota">
                                    @error('kuota')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan_penerbangan" class="form-label">Keterangan Penerbangan</label>
                                    <textarea class="form-control  @error('keterangan_penerbangan') is-invalid @enderror" id="keterangan_penerbangan"
                                        name="keterangan_penerbangan" placeholder="Keterangan Penerbangan">{{ old('keterangan_penerbangan', $penerbangan->keterangan_penerbangan) }}</textarea>
                                    @error('keterangan_penerbangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" class="form-control  @error('total_harga') is-invalid @enderror"
                                        id="total_harga" name="total_harga"
                                        value="{{ old('total_harga', $penerbangan->total_harga) }}"
                                        placeholder="Total Harga">
                                    @error('total_harga')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="bandara_asal" class="form-label">Bandara Asal</label>
                                    <input type="text" class="form-control  @error('bandara_asal') is-invalid @enderror"
                                        id="bandara_asal" name="bandara_asal"
                                        value="{{ old('bandara_asal', $penerbangan->bandara_asal) }}"
                                        placeholder="Bandara Asal">
                                    @error('bandara_asal')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="bandara_tujuan" class="form-label">Bandara Tujuan</label>
                                    <input type="text"
                                        class="form-control  @error('bandara_tujuan') is-invalid @enderror"
                                        id="bandara_tujuan" name="bandara_tujuan"
                                        value="{{ old('bandara_tujuan', $penerbangan->bandara_tujuan) }}"
                                        placeholder="Bandara Tujuan">
                                    @error('bandara_tujuan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_keberangkatan" class="form-label">Waktu Keberangkatan</label>
                                    <input type="datetime-local"
                                        class="form-control  @error('waktu_keberangkatan') is-invalid @enderror"
                                        id="waktu_keberangkatan" name="waktu_keberangkatan"
                                        value="{{ old('waktu_keberangkatan', $penerbangan->waktu_keberangkatan) }}"
                                        placeholder="Waktu Keberangkatan">
                                    @error('waktu_keberangkatan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_kedatangan" class="form-label">Waktu Kedatangan</label>
                                    <input type="datetime-local"
                                        class="form-control  @error('waktu_kedatangan') is-invalid @enderror"
                                        id="waktu_kedatangan" name="waktu_kedatangan"
                                        value="{{ old('waktu_kedatangan', $penerbangan->waktu_kedatangan) }}"
                                        placeholder="Waktu Kedatangan">
                                    @error('waktu_kedatangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status_penerbangan" class="form-label">Status Penerbangan</label>
                                    <select class="form-select  @error('status_penerbangan') is-invalid @enderror"
                                        id="status_penerbangan" name="status_penerbangan">
                                        <option value="" selected disabled>Pilih Status Penerbangan</option>
                                        <option value="On Schedule" @selected(old('status_penerbangan', $penerbangan->status_penerbangan) == 'On Schedule')>On Schedule</option>
                                        <option value="Delay" @selected(old('status_penerbangan', $penerbangan->status_penerbangan) == 'Delay')>Delay</option>
                                        <option value="Canceled" @selected(old('status_penerbangan', $penerbangan->status_penerbangan) == 'Canceled')>Canceled</option>
                                        <option value="Emergency Landing" @selected(old('status_penerbangan', $penerbangan->status_penerbangan) == 'Emergency Landing')>Emergency Landing
                                        </option>
                                        <option value="Failed" @selected(old('status_penerbangan', $penerbangan->status_penerbangan) == 'Failed')>Failed</option>
                                        <option value="Landed Safely" @selected(old('status_penerbangan', $penerbangan->status_penerbangan) == 'Landed Safely')>Landed Safely</option>
                                        <option value="Accident" @selected(old('status_penerbangan', $penerbangan->status_penerbangan) == 'Accident')>Accident</option>
                                        <option value="Crash" @selected(old('status_penerbangan', $penerbangan->status_penerbangan) == 'Crash')>Crash</option>
                                    </select>
                                    @error('status_penerbangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tipe_penerbangan" class="form-label">Tipe Penerbangan</label>
                                    <select class="form-select  @error('tipe_penerbangan') is-invalid @enderror"
                                        id="tipe_penerbangan" name="tipe_penerbangan">
                                        <option value="" selected disabled>Pilih Tipe Penerbangan</option>
                                        <option value="Langsung" @selected(old('tipe_penerbangan', $penerbangan->tipe_penerbangan) == 'Langsung')>Langsung / Direct</option>
                                        <option value="Transit" @selected(old('tipe_penerbangan', $penerbangan->tipe_penerbangan) == 'Transit')>Transit / Connecting</option>
                                    </select>
                                    @error('tipe_penerbangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gate_penerbangan" class="form-label">Gate Penerbangan</label>
                                    <input type="text"
                                        class="form-control  @error('gate_penerbangan') is-invalid @enderror"
                                        id="gate_penerbangan" name="gate_penerbangan"
                                        value="{{ old('gate_penerbangan', $penerbangan->gate_penerbangan) }}"
                                        placeholder="Gate Penerbangan">
                                    @error('gate_penerbangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/paket/{{ $penerbangan->paket_id }}/penerbangan"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
