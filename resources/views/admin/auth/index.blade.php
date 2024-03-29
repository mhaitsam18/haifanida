@extends('admin.auth.layouts.main')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <style>
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
    </style> --}}
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card d-flex align-items-center">
                <div class="row">
                    <div class="col-md-4 pe-md-0">
                        <div class="text-center">
                            <img src="/assets/img/logos/logo-full.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-md-8 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">Haifa
                                Nida<span>Admin</span></a>
                            <h5 class="text-muted fw-normal mb-4">Selamat Datang di Halaman Admin! Silahkan
                                Log In.</h5>
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
                            <form action="/login" method="post" class="forms-sample">
                                @csrf
                                <input type="hidden" name="role" value="admin">
                                <div class="mb-3">
                                    <label for="email_or_username" class="form-label">Email atau
                                        Username</label>
                                    <input type="text"
                                        class="form-control @error('email_or_username') is-invalid @enderror"
                                        name="email_or_username" id="email_or_username" placeholder="Email atau Username"
                                        value="{{ old('email_or_username') }}">
                                    @error('email_or_username')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" autocomplete="current-password"
                                        placeholder="Kata Sandi">
                                    @error('password')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-haifa me-2 mb-2 mb-md-0 text-white">Login</button>
                                    <a href="{{ url('/auth/google') }}"
                                        class="btn btn-outline-haifa btn-icon-text mb-2 mb-md-0">
                                        {{-- <i class="btn-icon-prepend" data-feather="google"></i> --}}
                                        <i class="fa-brands fa-google"></i>
                                        Login with google
                                    </a>
                                </div>
                                <a href="/admin/forgot-password" class="d-block mt-3 text-muted">Lupa Kata
                                    Sandi?</a>
                                <a href="/" class="d-block mt-3 text-muted">Halaman Web</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
