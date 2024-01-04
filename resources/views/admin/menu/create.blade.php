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
                    <form action="/admin/menu" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="menu" class="form-label">Menu</label>
                                    <input type="text" class="form-control  @error('menu') is-invalid @enderror"
                                        id="menu" name="menu" value="{{ old('menu') }}" placeholder="Menu">
                                    @error('menu')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">Parent</label>
                                    <select class="form-select  @error('parent_id') is-invalid @enderror" id="parent_id"
                                        name="parent_id">
                                        <option value="" selected>Pilih Parent</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{ $menu->id }}" @selected(old('parent_id') == $menu->id)>
                                                {{ $menu->order . ' | ' . $menu->menu }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('has_dropdown') is-invalid @enderror"
                                            type="checkbox" value="1" id="has_dropdown" name="has_dropdown"
                                            @checked(old('has_dropdown'))>
                                        <label class="form-check-label" for="has_dropdown">
                                            Ada Dropdown?
                                        </label>
                                    </div>
                                    @error('has_dropdown')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror"
                                            type="checkbox" value="1" id="is_active" name="is_active"
                                            @checked(old('is_active'))>
                                        <label class="form-check-label" for="is_active">
                                            Apakah Aktif?
                                        </label>
                                    </div>
                                    @error('is_active')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="url" class="form-label">URL</label>
                                        <input type="text" class="form-control  @error('url') is-invalid @enderror"
                                            id="url" name="url" value="{{ old('url') }}" placeholder="URL">
                                        @error('url')
                                            <div class="text-danger fs-6">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Ikon</label>
                                        <input type="text" class="form-control  @error('icon') is-invalid @enderror"
                                            id="icon" name="icon" value="{{ old('icon') }}" placeholder="Ikon">
                                        @error('icon')
                                            <div class="text-danger fs-6">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="order" class="form-label">Nomor Urut</label>
                                        <input type="number" class="form-control  @error('order') is-invalid @enderror"
                                            id="order" name="order" value="{{ old('order') }}"
                                            placeholder="Nomor Urut">
                                        @error('order')
                                            <div class="text-danger fs-6">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/menu" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
