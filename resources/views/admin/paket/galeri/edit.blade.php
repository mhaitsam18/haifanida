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
                    <form action="/admin/galeri/{{ $galeri->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $galeri->id }}">
                        <input type="hidden" name="paket_id" id="paket_id" value="{{ $galeri->paket_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis</label>
                                    <select class="form-select  @error('jenis') is-invalid @enderror" id="jenis"
                                        name="jenis">
                                        <option value="" selected disabled>Pilih Jenis</option>
                                        <option value="gambar" @selected('gambar' == old('jenis', $galeri->jenis))>Gambar</option>
                                        <option value="video" @selected('video' == old('jenis', $galeri->jenis))>Video</option>
                                    </select>
                                    @error('jenis')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control  @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $galeri->nama) }}"
                                        placeholder="Nama">
                                    @error('nama')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                        placeholder="Deskripsi">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="file_path" class="form-label">File</label>
                                    <input type="file" class="form-control  @error('file_path') is-invalid @enderror"
                                        id="file_path" name="file_path" value="{{ old('file_path', $galeri->file_path) }}"
                                        placeholder="File">
                                    @error('file_path')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/paket/{{ $galeri->paket_id }}/galeri"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset('storage/' . $galeri->file_path) }}" class="img-thumbnail img-preview">
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
            $('#file_path').on('change', function() {
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
