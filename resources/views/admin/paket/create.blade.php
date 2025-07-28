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
                    <form action="/admin/paket" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="kantor_id" id="kantor_id" value="{{ $kantor->id ?? null }}">
                        <div class="row">
                            <div class="col-lg-4">
                                {{-- <div class="mb-3">
                                    <label for="kode_paket" class="form-label">Kode Paket</label>
                                    <input type="text" class="form-control  @error('kode_paket') is-invalid @enderror"
                                        id="kode_paket" name="kode_paket" value="{{ old('kode_paket') }}"
                                        placeholder="Kode Paket">
                                    @error('kode_paket')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                                <div class="mb-3">
                                    <label for="nama_paket" class="form-label">Nama Paket</label>
                                    <input type="text" class="form-control  @error('nama_paket') is-invalid @enderror"
                                        id="nama_paket" name="nama_paket" value="{{ old('nama_paket') }}"
                                        placeholder="Nama Paket">
                                    @error('nama_paket')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="destinasi" class="form-label">Destinasi</label>
                                    <input type="text" class="form-control  @error('destinasi') is-invalid @enderror"
                                        id="destinasi" name="destinasi" value="{{ old('destinasi') }}"
                                        placeholder="Destinasi">
                                    @error('destinasi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_paket" class="form-label">Jenis Paket</label>
                                    <select class="form-select  @error('jenis_paket') is-invalid @enderror" id="jenis_paket"
                                        name="jenis_paket">
                                        <option value="" selected disabled>Pilih Jenis Paket</option>
                                        <option value="umroh" @selected(old('jenis_paket') == 'umroh')>Umroh</option>
                                        <option value="haji" @selected(old('jenis_paket') == 'haji')>Haji</option>
                                        <option value="wisata halal" @selected(old('jenis_paket') == 'wisata halal')> Wisata Halal</option>
                                    </select>
                                    @error('jenis_paket')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="fasilitas" class="form-label">Fasilitas</label>
                                    <textarea class="form-control  @error('fasilitas') is-invalid @enderror" id="fasilitas" name="fasilitas"
                                        placeholder="Fasilitas">{{ old('fasilitas') }}</textarea>
                                    @error('fasilitas')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}

                                <!-- Fasilitas (pakai CKEditor) -->
                                <div class="form-group">
                                    <label for="fasilitas">Fasilitas</label>
                                    <textarea name="fasilitas" id="editor" class="form-control" rows="8">{{ old('fasilitas', $paket->fasilitas ?? '') }}</textarea>
                                </div>

                                <!-- CKEditor Script -->
                                <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
                                <script>
                                    CKEDITOR.replace('editor');
                                </script>

                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="durasi" class="form-label">Durasi (hari)</label>
                                    <input type="number" class="form-control  @error('durasi') is-invalid @enderror"
                                        id="durasi" name="durasi" value="{{ old('durasi') }}" placeholder="Durasi">
                                    @error('durasi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control  @error('harga') is-invalid @enderror"
                                        id="harga" name="harga" value="{{ old('harga') }}" placeholder="harga">
                                    @error('Harga')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    {{-- <textarea class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                        placeholder="Deskripsi">{{ old('deskripsi') }}</textarea> --}}

                                    <textarea name="deskripsi" id="editor2" class="form-control" rows="8">{{ old('deskripsi', $paket->deskripsi ?? '') }}</textarea>
                                    @error('deskripsi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                <script>
                                    CKEDITOR.replace('editor2');
                                </script>
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_keberangkatan" class="form-label">Tempat Keberangkatan</label>
                                    <input type="text"
                                        class="form-control  @error('tempat_keberangkatan') is-invalid @enderror"
                                        id="tempat_keberangkatan" name="tempat_keberangkatan"
                                        value="{{ old('tempat_keberangkatan') }}" placeholder="Tempat Keberangkatan">
                                    @error('tempat_keberangkatan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_kepulangan" class="form-label">Tempat Kepulangan</label>
                                    <input type="text"
                                        class="form-control  @error('tempat_kepulangan') is-invalid @enderror"
                                        id="tempat_kepulangan" name="tempat_kepulangan"
                                        value="{{ old('tempat_kepulangan') }}" placeholder="Tempat Kepulangan">
                                    @error('tempat_kepulangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date"
                                        class="form-control  @error('tanggal_mulai') is-invalid @enderror"
                                        id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                                        placeholder="Tanggal Mulai">
                                    @error('tanggal_mulai')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date"
                                        class="form-control  @error('tanggal_selesai') is-invalid @enderror"
                                        id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                                        placeholder="Tanggal Selesai">
                                    @error('tanggal_selesai')
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
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input type="hidden" name="published_at" value="">
                                        <input class="form-check-input @error('published_at') is-invalid @enderror"
                                            type="checkbox" value="{{ now() }}" id="published_at"
                                            name="published_at"
                                            @checked(old('published_at', isset($paket) && $paket->published_at))>
                                        <label class="form-check-label" for="published_at">
                                            Terbitkan?
                                        </label>
                                    </div>
                                    @error('published_at')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/paket" class="btn btn-secondary float-end m-2">Kembali</a>
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
    <script src="/assets-nobleui/vendors/tinymce/tinymce.min.js"></script>
    <script src="/assets-nobleui/vendors/simplemde/simplemde.min.js"></script>

    <!-- Custom js for this page -->
    <script src="/assets-nobleui/js/tinymce.js"></script>
    <script src="/assets-nobleui/js/simplemde.js"></script>
    <script src="/assets-nobleui/js/ace.js"></script>
    <!-- End custom js for this page -->
    <script>
        if ($("#fasilitas").length) {
            tinymce.init({
                selector: '#fasilitas',
                height: 400,
                default_text_color: 'red',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                image_advtab: true,
                templates: [{
                        title: 'Test template 1',
                        content: 'Test 1'
                    },
                    {
                        title: 'Test template 2',
                        content: 'Test 2'
                    }
                ],
                content_css: []
            });
        }
        if ($("#deskripsi").length) {
            tinymce.init({
                selector: '#deskripsi',
                height: 400,
                default_text_color: 'red',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                image_advtab: true,
                templates: [{
                        title: 'Test template 1',
                        content: 'Test 1'
                    },
                    {
                        title: 'Test template 2',
                        content: 'Test 2'
                    }
                ],
                content_css: []
            });
        }
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
