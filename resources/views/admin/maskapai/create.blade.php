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
                    <form action="/admin/maskapai" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="kode_maskapai" class="form-label">Kode Maskapai</label>
                                    <input type="text" class="form-control  @error('kode_maskapai') is-invalid @enderror"
                                        id="kode_maskapai" name="kode_maskapai" value="{{ old('kode_maskapai') }}"
                                        placeholder="Kode Maskapai">
                                    @error('kode_maskapai')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_maskapai" class="form-label">Nama Maskapai</label>
                                    <input type="text" class="form-control  @error('nama_maskapai') is-invalid @enderror"
                                        id="nama_maskapai" name="nama_maskapai" value="{{ old('nama_maskapai') }}"
                                        placeholder="Nama Maskapai">
                                    @error('nama_maskapai')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="negara_asal" class="form-label">Negara Asal</label>
                                    <input type="text" class="form-control  @error('negara_asal') is-invalid @enderror"
                                        id="negara_asal" name="negara_asal" value="{{ old('negara_asal') }}"
                                        placeholder="Negara Asal">
                                    @error('negara_asal')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                        placeholder="Deskripsi">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control  @error('logo') is-invalid @enderror"
                                        id="logo" name="logo" value="{{ old('logo') }}" placeholder="Logo">
                                    @error('logo')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/maskapai" class="btn btn-secondary float-end m-2">Kembali</a>
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
            $('#logo').on('change', function() {
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
