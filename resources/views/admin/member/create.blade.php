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
                    <form action="/admin/member" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap (Sesuai KTP)</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}"
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
                                        id="email" name="email" value="{{ old('email') }}" placeholder="Email">
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
                                        id="username" name="username" value="{{ old('username') }}" placeholder="Username">
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
                                        id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                        placeholder="Nomor Ponsel">
                                    @error('phone_number')
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
                                                <img src="" class="img-thumbnail img-preview">
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
                                    <label for="password" class="form-label">Kata Sandi</label>
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
                                <a href="/admin/member" class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection

@section('script')
    <!-- Style lainnya -->

    <!-- Tambahkan script jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-oP6HI/t1dWC72dtFZlG5o5ZI7bA17GNE2qF/3c5z9I="
        crossorigin="anonymous"></script> --}}

    <script>
        $(document).ready(function() {
            // Menangkap peristiwa input pada bidang username
            $('#username').on('input', function() {
                var username = $(this).val();

                // Mengirim permintaan AJAX untuk memeriksa ketersediaan username
                $.ajax({
                    url: '/check-username/' + username,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'available') {
                            // Username tersedia
                            $('#username-availability').text('Username tersedia').css('color',
                                'green');
                        } else {
                            // Username sudah digunakan
                            $('#username-availability').text('Username sudah digunakan').css(
                                'color', 'red');
                        }
                    }
                });
            });

            // Menangkap peristiwa input pada bidang email
            $('#email').on('input', function() {
                var email = $(this).val();

                // Mengirim permintaan AJAX untuk memeriksa ketersediaan email
                $.ajax({
                    url: '/check-email/' + email,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'available') {
                            // Email tersedia
                            $('#email-availability').text('Email tersedia').css('color',
                                'green');
                        } else {
                            // Email sudah digunakan
                            $('#email-availability').text('Email sudah digunakan').css('color',
                                'red');
                        }
                    }
                });
            });
        });
    </script>

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
