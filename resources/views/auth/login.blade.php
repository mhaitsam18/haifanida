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
                            <h2>Log In</h2>
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required
                                                data-error="Please enter your Username or Email"
                                                placeholder="Username or Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="password"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-condition">
                                        <div class="agree-label">
                                            <input type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember">
                                                Ingat Saya <a class="forget" href="/logout">Lupa Kata
                                                    Sandi?</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <button type="submit" class="default-btn btn-bg-two">
                                            Log In
                                        </button>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <a href="{{ url('/auth/google') }}" class="btn btn-google">
                                            <i class="fa-brands fa-google"></i> Log In dengan Google
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <p class="account-desc">
                                            Tidak Punya Akun?
                                            <a href="/register">Daftar Sekarang</a>
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
