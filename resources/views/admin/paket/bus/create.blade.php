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
                    <form action="/admin/bus" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="paket_id" id="paket_id" value="{{ $paket->id ?? null }}">
                        <h4 class="mb-3">{{ $paket->nama_paket ?? null }}</h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="nomor_rombongan" class="form-label">Nomor Rombongan</label>
                                    <input type="text"
                                        class="form-control @error('nomor_rombongan') is-invalid @enderror"
                                        id="nomor_rombongan" name="nomor_rombongan" value="{{ old('nomor_rombongan') }}"
                                        placeholder="Nomor Rombongan">
                                    @error('nomor_rombongan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
                                    <input type="text" class="form-control @error('nomor_polisi') is-invalid @enderror"
                                        id="nomor_polisi" name="nomor_polisi" value="{{ old('nomor_polisi') }}"
                                        placeholder="Nomor Polisi">
                                    @error('nomor_polisi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="merek" class="form-label">Merek / PO</label>
                                    <input type="text" class="form-control @error('merek') is-invalid @enderror"
                                        id="merek" name="merek" value="{{ old('merek') }}" placeholder="Merek / PO">
                                    @error('merek')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                        id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}"
                                        placeholder="Kapasitas">
                                    @error('kapasitas')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="fasilitas" class="form-label">Fasilitas</label>
                                    <textarea class="form-control  @error('fasilitas') is-invalid @enderror" id="fasilitas" name="fasilitas"
                                        placeholder="Fasilitas">{{ old('fasilitas') }}</textarea>
                                    @error('fasilitas')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/{{ $paket ? 'paket/' . $paket->id . '/' : '' }}bus"
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
    </script>
@endsection
