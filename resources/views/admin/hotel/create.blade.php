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
                    <form action="/admin/hotel" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="kode_hotel" class="form-label">Kode Hotel</label>
                                    <input type="text" class="form-control  @error('kode_hotel') is-invalid @enderror"
                                        id="kode_hotel" name="kode_hotel" value="{{ old('kode_hotel') }}"
                                        placeholder="Kode Hotel">
                                    @error('kode_hotel')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_hotel" class="form-label">Nama Hotel</label>
                                    <input type="text" class="form-control  @error('nama_hotel') is-invalid @enderror"
                                        id="nama_hotel" name="nama_hotel" value="{{ old('nama_hotel') }}"
                                        placeholder="Nama Hotel">
                                    @error('nama_hotel')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="bintang">Bintang</label>
                                    <div class="" id="bintang">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('bintang') is-invalid @enderror"
                                                type="radio" name="bintang" id="nol" value="0"
                                                @checked(old('bintang') == '0')>
                                            <label class="form-check-label" for="nol">0</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('bintang') is-invalid @enderror"
                                                type="radio" name="bintang" id="satu" value="1"
                                                @checked(old('bintang') == '1')>
                                            <label class="form-check-label" for="satu">1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('bintang') is-invalid @enderror"
                                                type="radio" name="bintang" id="dua" value="2"
                                                @checked(old('bintang') == '2')>
                                            <label class="form-check-label" for="dua">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('bintang') is-invalid @enderror"
                                                type="radio" name="bintang" id="tiga" value="3"
                                                @checked(old('bintang') == '3')>
                                            <label class="form-check-label" for="tiga">3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('bintang') is-invalid @enderror"
                                                type="radio" name="bintang" id="empat" value="4"
                                                @checked(old('bintang') == '4')>
                                            <label class="form-check-label" for="empat">4</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('bintang') is-invalid @enderror"
                                                type="radio" name="bintang" id="lima" value="5"
                                                @checked(old('bintang') == '5')>
                                            <label class="form-check-label" for="lima">5</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('bintang') is-invalid @enderror"
                                                type="radio" name="bintang" id="enam" value="6"
                                                @checked(old('bintang') == '6')>
                                            <label class="form-check-label" for="enam">6</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('bintang') is-invalid @enderror"
                                                type="radio" name="bintang" id="tujuh" value="7"
                                                @checked(old('bintang') == '7')>
                                            <label class="form-check-label" for="tujuh">7</label>
                                        </div>
                                    </div>
                                    @error('bintang')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="bintang_setaraf" class="form-label">Bintang Setaraf</label>
                                    <input type="text"
                                        class="form-control  @error('bintang_setaraf') is-invalid @enderror"
                                        id="bintang_setaraf" name="bintang_setaraf" value="{{ old('bintang_setaraf') }}"
                                        placeholder="Bintang Setaraf">
                                    @error('bintang_setaraf')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" class="form-control  @error('kota') is-invalid @enderror"
                                        id="kota" name="kota" value="{{ old('kota') }}" placeholder="Kota">
                                    @error('kota')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="negara" class="form-label">Negara</label>
                                    <input type="text" class="form-control  @error('negara') is-invalid @enderror"
                                        id="negara" name="negara" value="{{ old('negara') }}" placeholder="Negara">
                                    @error('negara')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea type="text" class="form-control  @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                        placeholder="Alamat">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="link_gmaps" class="form-label">Link Gmaps</label>
                                    <input type="url" class="form-control  @error('link_gmaps') is-invalid @enderror"
                                        id="link_gmaps" name="link_gmaps" value="{{ old('link_gmaps') }}"
                                        placeholder="Link Gmaps">
                                    @error('link_gmaps')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea type="text" class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi"
                                        name="deskripsi" placeholder="deskripsi">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control  @error('gambar') is-invalid @enderror"
                                        id="gambar" name="gambar" value="{{ old('gambar') }}" placeholder="Gambar">
                                    @error('gambar')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/hotel" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                            <div class="col-lg-4">
                                <img src="" alt="" class="img-thumbnail img-fluid img-preview">
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
            $('#gambar').on('change', function() {
                const file = $(this).prop('files')[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
