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
                    <form action="/admin/konten" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control  @error('judul') is-invalid @enderror"
                                        id="judul" name="judul" value="{{ old('judul') }}" placeholder="Judul">
                                    @error('judul')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control  @error('gambar') is-invalid @enderror"
                                        id="gambar" name="gambar">
                                    @error('gambar')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="isi_konten" class="form-label">Isi Konten</label>
                                    <textarea class="form-control @error('isi_konten') is-invalid @enderror" id="isi_konten" name="isi_konten"
                                        rows="10" placeholder="Isi Konten">{{ old('isi_konten') }}</textarea>
                                    @error('isi_konten')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/konten" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <img src="" class="img-thumbnail img-preview">
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
        if ($("#isi_konten").length) {
            tinymce.init({
                selector: '#isi_konten',
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
    </script>
@endsection
