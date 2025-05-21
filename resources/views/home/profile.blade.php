@extends('layouts.main')

@section('content')

    <div class="section-title text-center">
        @if ($mode == 'edit')
            <h2>Edit Profile</h2>
        @else
            <h2>Profile</h2>
        @endif
    </div>
    <!-- MODIFIED-- -->
   <div class="container pb-70 mb-5 bg-light">
       <div class="row ms-3">
    <!-- --MODIFIED -->
        @if ($mode == 'edit')

            <!-- Left column: Photo -->
            <!-- MODIFIED-- -->
            <div class="col-lg-4 mt-3">
                @if ($user->photo)
                    <img src="/storage/{{ $user->photo }}" class="img-fluid rounded" alt="Profile Photo">
            <!-- --MODIFIED -->
                @endif
            </div>
            <!-- Right column: Form -->
            <div class="col-lg-8 p-3">
                <form action="{{ route('member.profile') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone-number">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                    </div>
                    @if (!$user->google_id)
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password', $user->password) }}">
                        </div>
                    @endif
                    <a href="{{ route('member.profile', ['mode' => 'show']) }}" class="default-btn btn-bg-two border-radius-50" type="submit">Save</a>
                    <a href="{{ route('member.profile', ['mode' => 'show']) }}" class="default-btn btn-bg-one border-radius-50">Cancel</a>

                </form>
            </div>

        @else

            <!-- Left Column: Photo -->
            <!-- MODIFIED-- -->
            <div class="col-lg-4 mt-3">
                @if($user->photo)
                    <img src="/storage/{{ $user->photo }}" class="img-fluid rounded" alt="Profile Photo show">
            <!-- --MODIFIED -->
                @endif
            </div>

            <!-- Right Column: Data -->
            <div class="col-lg-8 p-3">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" readonly class="form-control-plaintext p-2 border" value="{{ $user->name }}">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" readonly class="form-control-plaintext p-2 border" value="{{ $user->email }}">
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" readonly class="form-control-plaintext p-2 border" value="{{ $user->username }}">
                </div>

                <div class="mb-3">
                    <label>Phone Number</label>
                    <input type="text" readonly class="form-control-plaintext p-2 border" value="{{ $user->phone_number }}">
                </div>

                <a href="{{ route('member.profile', ['mode' => 'edit']) }}" class="default-btn btn-bg-two border-radius-50">Edit Profile</a>
                <!-- MODIFIED-- -->
                 <!-- TODO: Implementasi page untuk mengelola identitas dan berkas member -->
                <a href="#" class="default-btn btn-bg-two border-radius-50">Kelola identitas dan berkas</a>
                <!-- --MODIFIED -->
            </div>
        @endif
    </div>
</div>

@endsection

