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
                    <form action="/admin/sertifikat-jemaah/{{ $sertifikatJemaah->id }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $sertifikatJemaah->id }}">
                        <input type="hidden" name="jemaah_id" id="jemaah_id" value="{{ $sertifikatJemaah->jemaah_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="nomor_sertifikat" class="form-label">Nomor Sertifikat</label>
                                    <input type="text"
                                        class="form-control @error('nomor_sertifikat') is-invalid @enderror"
                                        id="nomor_sertifikat" name="nomor_sertifikat"
                                        value="{{ old('nomor_sertifikat', $sertifikatJemaah->nomor_sertifikat) }}"
                                        placeholder="Nomor Sertifikat">
                                    @error('nomor_sertifikat')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_penerbitan" class="form-label">Tanggal Penerbitan</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_penerbitan') is-invalid @enderror"
                                        id="tanggal_penerbitan" name="tanggal_penerbitan"
                                        value="{{ old('tanggal_penerbitan', $sertifikatJemaah->tanggal_penerbitan) }}"
                                        placeholder="Tanggal Penerbitan">
                                    @error('tanggal_penerbitan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                                        id="tanggal_kadaluarsa" name="tanggal_kadaluarsa"
                                        value="{{ old('tanggal_kadaluarsa', $sertifikatJemaah->tanggal_kadaluarsa) }}"
                                        placeholder="Tanggal Kadaluarsa">
                                    @error('tanggal_kadaluarsa')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_sertifikat" class="form-label">Jenis Sertifikat</label>
                                    <input type="text"
                                        class="form-control @error('jenis_sertifikat') is-invalid @enderror"
                                        id="jenis_sertifikat" name="jenis_sertifikat"
                                        value="{{ old('jenis_sertifikat', $sertifikatJemaah->jenis_sertifikat) }}"
                                        placeholder="Jenis Sertifikat">
                                    @error('jenis_sertifikat')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sertifikat" class="form-label">File sertifikat</label>
                                    <input type="file" class="form-control @error('sertifikat') is-invalid @enderror"
                                        id="sertifikat" name="sertifikat"
                                        value="{{ old('sertifikat', $sertifikatJemaah->sertifikat) }}"
                                        placeholder="File sertifikat">
                                    @error('sertifikat')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="javascript:history.back()" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <img src="{{ asset('storage/' . $sertifikatJemaah->sertifikat) }}"
                                class="img-thumbnail img-preview">
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
            $('#sertifikat').on('change', function() {
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
