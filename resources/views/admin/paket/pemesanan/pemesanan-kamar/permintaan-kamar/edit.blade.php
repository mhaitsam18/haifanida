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
                    <form action="/admin/permintaan-kamar/{{ $permintaanKamar->id }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $permintaanKamar->id }}">
                        <input type="hidden" name="pemesanan_kamar_id" id="pemesanan_kamar_id"
                            value="{{ $permintaanKamar->pemesanan_kamar_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="permintaan" class="form-label">Permintaan</label>
                                    <select class="form-select @error('permintaan') is-invalid @enderror" id="permintaan"
                                        name="permintaan">
                                        <option value="" selected disabled>Pilih Permintaan</option>
                                        @foreach ($permintaans as $permintaan)
                                            <option value="{{ $permintaan->nama_ekstra }}" @selected($permintaan->nama_ekstra == old('permintaan', $permintaanKamar->permintaan))>
                                                {{ $permintaan->nama_ekstra }}
                                            </option>
                                        @endforeach
                                        <option value="permintaan_khusus">Permintaan Tidak Tersedia</option>
                                    </select>
                                    @error('permintaan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Field input text untuk permintaan khusus -->
                                <div id="permintaanKhususField" style="display: none;">
                                    <label for="permintaan_khusus" class="form-label">Permintaan Khusus</label>
                                    <input type="text" class="form-control" id="permintaan_khusus"
                                        name="permintaan_khusus" placeholder="Masukkan Permintaan Khusus">
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                        id="harga" name="harga" value="{{ old('harga', $permintaanKamar->harga) }}"
                                        placeholder="Total Harga">
                                    @error('harga')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                        placeholder="Keterangan">{{ old('keterangan', $permintaanKamar->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/{{ $permintaanKamar->pemesanan_kamar_id ? 'pemesanan-kamar/' . $permintaanKamar->pemesanan_kamar_id . '/' : '' }}permintaan-kamar"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#permintaan").change(function() {
                if ($(this).val() === "permintaan_khusus") {
                    $("#permintaanKhususField").show();
                } else {
                    $("#permintaanKhususField").hide();
                }
            });
        });
    </script>
@endsection
