@extends('layouts.main')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .btn-google {
            background-color: #4285F4;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-google:hover {
            background-color: #357AE8;
        }
    </style>
@endsection
@section('content')
    @php
        use Carbon\Carbon;
    @endphp


    <div class="user-area pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="user-img">
                        <img src="/assets/img/mekkah/aviator70.jpg" alt="Images" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="user-form">
                        <div class="contact-form">
                            <h2>Daftar</h2>
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger mb-3 mx-auto" role="alert">
                                    {{ session('loginError') }}
                                </div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success mb-3 mx-auto" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session()->has('status'))
                                <div class="alert alert-info mb-3 mx-auto" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="/register" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" required data-error="Masukkan Nama Lengkap"
                                                placeholder="Nama Lengkap" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger fs-6">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- ... -->
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror" name="username"
                                                id="username" required data-error="Masukkan Username"
                                                placeholder="Username" value="{{ old('username') }}">
                                            @error('username')
                                                <div class="text-danger fs-6">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <!-- Tambahkan elemen span untuk menampilkan pesan ketersediaan -->
                                            <span id="username-availability"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" required data-error="Masukkan Email"
                                                placeholder="Email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger fs-6">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <!-- Tambahkan elemen span untuk menampilkan pesan ketersediaan -->
                                            <span id="email-availability"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" id="phone_number" required
                                                data-error="Masukkan phone_number" placeholder="Nomor Ponsel"
                                                value="{{ old('phone_number') }}">
                                            @error('phone_number')
                                                <div class="text-danger fs-6">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- ... -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                type="password" name="password" id="password" placeholder="Kata Sandi">
                                            @error('password')
                                                <div class="text-danger fs-6">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                                type="password" name="password_confirmation" id="password_confirmation"
                                                placeholder="Konfirmasi Kata Sandi">
                                            @error('password_confirmation')
                                                <div class="text-danger fs-6">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <button type="submit" class="default-btn btn-bg-two">
                                            Daftar
                                        </button>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <a href="{{ url('/auth/google') }}" class="btn btn-google">
                                            <i class="fa-brands fa-google"></i> Daftar dengan Google
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <p class="account-desc">
                                            Sudah Punya Akun?
                                            <a href="/login">Log In Sekarang</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endsection
