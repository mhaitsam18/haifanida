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
            <div class="col-lg-4 mt-3">
                <div class="text-center">
                    <img src="{{ $user->photo ? asset('assets/storage/user-photo/' . $user->photo) : asset('assets/storage/user-photo/not-found.jpg') }}" 
                         class="rounded mb-3" 
                         alt="Profile Photo" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                    
                    <form action="{{ route('member.profile.update-photo') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Photo</button>
                    </form>
                </div>
            </div>
            <!-- Right column: Form -->
            <div class="col-lg-8 p-3">
                <form action="{{ route('member.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
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
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="default-btn btn-bg-two border-radius-50">Save Changes</button>
                        <a href="{{ route('member.profile', ['mode' => 'show']) }}" class="default-btn btn-bg-one border-radius-50">Cancel</a>
                    </div>
                </form>
            </div>

        @else

            <!-- Left Column: Photo -->
            <div class="col-lg-4 mt-3">
                <div class="text-center">
                    <img src="{{ $user->photo ? asset('assets/storage/user-photo/' . $user->photo) : asset('assets/storage/user-photo/not-found.jpg') }}" 
                         class="rounded" 
                         alt="Profile Photo" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                </div>
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
                <a href="/member/identitas" class="default-btn btn-bg-two border-radius-50">Kelola identitas dan berkas</a>
                <!-- --MODIFIED -->
            </div>
        @endif
    </div>
</div>

@endsection

