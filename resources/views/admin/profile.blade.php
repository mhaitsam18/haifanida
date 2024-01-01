@extends('admin.layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{ $title }}</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Profil Saya</h6>
                        <div class="dropdown mb-2">
                            {{-- <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye"
                                        class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="trash" class="icon-sm me-2"></i> <span
                                        class="">Delete</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="printer" class="icon-sm me-2"></i> <span
                                        class="">Print</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="download" class="icon-sm me-2"></i> <span
                                        class="">Download</span></a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="mt-2">
                        <form action="/admin/profile/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('role') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                                    placeholder="Nama Lengkap">
                                @error('name')
                                    <div class="text-danger fs-6">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Email"
                                    value="{{ old('email', auth()->user()->email) }}">
                                @error('email')
                                    <div class="text-danger fs-6">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Username"
                                    value="{{ old('username', auth()->user()->username) }}">
                                @error('username')
                                    <div class="text-danger fs-6">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Nomor Ponsel</label>
                                <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number" placeholder="Nomor Ponsel"
                                    value="{{ old('phone_number', auth()->user()->phone_number) }}"
                                    pattern="^(?:\+|0)[0-9\s\-\*#\,]+$">
                                @error('phone_number')
                                    <div class="text-danger fs-6">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="photo" class="form-label">Foto</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    id="photo" name="photo">
                                <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                                    class="img-thumbnail img-preview">
                                @error('photo')
                                    <div class="text-danger fs-6">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="mb-3 row">
                                <div class="col-sm-2">Foto</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                                                class="img-thumbnail img-preview">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{-- <label class="input-group-text" for="photo">Foto</label> --}}
                                                <input type="file"
                                                    class="form-control @error('photo') is-invalid @enderror img-input"
                                                    id="photo" name="photo">
                                                @error('photo')
                                                    <div class="text-danger fs-6">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-haifa">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Ubah Kata Sandi</h6>
                        <div class="dropdown mb-2">
                            {{-- <button class="btn p-0" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye"
                                        class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="trash" class="icon-sm me-2"></i> <span
                                        class="">Delete</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="printer" class="icon-sm me-2"></i> <span
                                        class="">Print</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="download" class="icon-sm me-2"></i> <span
                                        class="">Download</span></a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <form action="/admin/password/{{ auth()->user()->id }}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Kata Sandi saat ini</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" placeholder="Kata Sandi Saat Ini">
                                @error('current_password')
                                    <div class="text-danger fs-6">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi Baru</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Kata Sandi Saat Ini">
                                @error('password')
                                    <div class="text-danger fs-6">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Konfirmasi Kata Sandi">
                                @error('password_confirmation')
                                    <div class="text-danger fs-6">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-haifa">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#photo').on('change', function() {
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
