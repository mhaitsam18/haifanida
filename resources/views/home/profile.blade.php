@extends('layouts.main')

@section('content')
    <!-- {{ $title = '' }} -->

    <div class="section-title text-center">
        @if ($mode == 'edit')
            <h2>Edit Profile</h2>
        @else
            <h2>Profile</h2>
        @endif
    </div>
   <div class="container pb-70">
    <div class="row">
        @if ($mode == 'edit')

            <!-- Left column: Photo -->
            <div class="col-lg-4">
                @if ($user->photo)
                    <img src="{{ asset('storage/user-photo/ . $user->photo') }}" class="img-fluid rounded" alt="Profile Photo">
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
            <div class="col-lg-4">
                @if($user->photo)
                    <img src="{{ asset('storage/user-photo/ . $user->photo') }}" class="img-fluid rounded" alt="Profile Photo">
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
            </div>
        @endif
    </div>
</div>

@endsection

