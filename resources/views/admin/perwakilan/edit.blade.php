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
                    {{-- <form action="/admin/index/{{ $index->id }}" method="post">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $index->id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="index" class="form-label">index</label>
                                    <input type="text" class="form-control  @error('index') is-invalid @enderror"
                                        id="index" name="index" value="{{ old('index', $index->index) }}"
                                        placeholder="index">
                                    @error('index')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/index" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
