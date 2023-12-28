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
                            <h2>Lupa Kata Sandi</h2>
                            <p>Kami akan mengirim anda link ke Email Anda</p>
                            <form action="/forgot-password" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" required data-error="Masukkan Email Anda"
                                                placeholder="Email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger fs-6">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <button type="submit" class="default-btn btn-bg-two">
                                            Kirim
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <p class="account-desc">
                                            Kembali ke halaman
                                            <a href="/login">Log In</a>
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
