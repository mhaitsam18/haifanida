@extends('admin.auth.layouts.main')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card d-flex align-items-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">Haifa
                                Nida<span>Admin</span></a>
                            <h5 class="text-muted fw-normal mb-4">Kami akan mengirim link atur ulang kata sandi ke email
                                Anda..</h5>
                            <p></p>
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
                            <form action="/forgot-password" method="post" class="forms-sample">
                                @csrf
                                <input type="hidden" name="role" value="admin">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-haifa me-2 mb-2 mb-md-0 text-white">Kirim</button>
                                </div>
                                <a href="/login-admin" class="d-block mt-3 text-muted">Kembali ke Halaman Log
                                    in?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
