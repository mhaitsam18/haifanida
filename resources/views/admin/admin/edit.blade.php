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
                    <form action="/admin/user-admin/{{ $admin->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $admin->id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $admin->user->name) }}"
                                        placeholder="Nama">
                                    @error('name')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $admin->user->email) }}"
                                        placeholder="Email">
                                    <span id="email-availability"></span>
                                    @error('email')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ old('username', $admin->user->username) }}"
                                        placeholder="Username">
                                    <span id="username-availability"></span>
                                    @error('username')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Nomor Ponsel</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $admin->user->phone_number) }}"
                                        placeholder="Nomor Ponsel">
                                    @error('phone_number')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kantor_id" class="form-label">Kantor</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select @error('kantor_id') is-invalid @enderror"
                                            placeholder="Pilih Kantor" aria-label="Pilih Kantor"
                                            aria-describedby="button-edit-kantor" id="kantor_id" name="kantor_id">
                                            <option value="" selected>Pilih Kantor</option>
                                            @foreach ($kantors as $kantor)
                                                <option value="{{ $kantor->id }}" @selected($kantor->id == old('kantor_id', $admin->kantor_id))>
                                                    {{ $kantor->nama_kantor }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <a href="/admin/kantor/{{ old('kantor_id', $admin->kantor_id) }}/edit"
                                            class="btn btn-outline-secondary" type="button" id="button-edit-kantor">Edit
                                            Kantor</a>
                                    </div>
                                    @error('kantor_id')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2">Foto</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img src="{{ asset('storage/' . $admin->user->photo) }}"
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
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input @error('is_superadmin') is-invalid @enderror"
                                            type="checkbox" value="1" id="is_superadmin" name="is_superadmin"
                                            @checked(old('is_superadmin', $admin->is_superadmin))>
                                        <label class="form-check-label" for="is_superadmin">
                                            SuperAdmin?
                                        </label>
                                    </div>
                                    @error('is_superadmin')
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
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/user-admin" class="btn btn-secondary float-end m-2">Kembali</a>
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
