@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary py-4">
                    <h2 class="text-center text-white mb-0">
                        @if ($mode == 'edit')
                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                        @else
                            <i class="fas fa-user me-2"></i>Profile
                        @endif
                    </h2>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        @if ($mode == 'edit')
                            <!-- Left column: Photo -->
                            <div class="col-lg-4">
                                <div class="text-center position-relative">
                                    <div class="profile-photo-container mb-4">
                                        <img src="{{ $user->photo ? asset('assets/storage/user-photo/' . $user->photo) : asset('assets/storage/user-photo/not-found.jpg') }}"
                                            class="rounded-circle border shadow-sm"
                                            alt="Profile Photo"
                                            style="width: 200px; height: 200px; object-fit: cover;">
                                    </div>
                                    
                                    <form action="{{ route('member.profile.update-photo') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="custom-file-upload">
                                                <input type="file" name="photo" class="form-control" accept="image/*" id="photo-upload">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm">
                                            <i class="fas fa-camera me-2"></i>Update Photo
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- Right column: Form -->
                            <div class="col-lg-8">
                                <form action="{{ route('member.profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4 form-floating">
                                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
                                        <label for="name">Name</label>
                                    </div>
                                    <div class="mb-4 form-floating">
                                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="mb-4 form-floating">
                                        <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $user->username) }}">
                                        <label for="username">Username</label>
                                    </div>
                                    <div class="mb-4 form-floating">
                                        <input type="number" name="phone_number" class="form-control" id="phone" value="{{ old('phone_number', $user->phone_number) }}">
                                        <label for="phone">Phone Number</label>
                                    </div>
                                    @if (!$user->google_id)
                                        <div class="mb-4 form-floating">
                                            <input type="password" name="password" class="form-control" id="password">
                                            <label for="password">Password</label>
                                        </div>
                                    @endif
                                    <div class="mt-4 d-flex gap-3">
                                        <button type="submit" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm">
                                            <i class="fas fa-save me-2"></i>Save Changes
                                        </button>
                                        <a href="{{ route('member.profile', ['mode' => 'show']) }}" class="btn btn-light btn-lg px-4 rounded-pill shadow-sm">
                                            <i class="fas fa-times me-2"></i>Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        @else
                            <!-- Left Column: Photo -->
                            <div class="col-lg-4">
                                <div class="text-center">
                                    <div class="profile-photo-container mb-4">
                                        <img src="{{ $user->photo ? asset('assets/storage/user-photo/' . $user->photo) : asset('assets/storage/user-photo/not-found.jpg') }}"
                                            class="rounded-circle border shadow-sm"
                                            alt="Profile Photo"
                                            style="width: 200px; height: 200px; object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                            <!-- Right Column: Data -->
                            <div class="col-lg-8">
                                <div class="mb-4">
                                    <label class="form-label text-muted small">Name</label>
                                    <div class="form-control-lg bg-light rounded-3 p-3">
                                        <i class="fas fa-user me-2 text-primary"></i>{{ $user->name }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted small">Email</label>
                                    <div class="form-control-lg bg-light rounded-3 p-3">
                                        <i class="fas fa-envelope me-2 text-primary"></i>{{ $user->email }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted small">Username</label>
                                    <div class="form-control-lg bg-light rounded-3 p-3">
                                        <i class="fas fa-at me-2 text-primary"></i>{{ $user->username }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted small">Phone Number</label>
                                    <div class="form-control-lg bg-light rounded-3 p-3">
                                        <i class="fas fa-phone me-2 text-primary"></i>{{ $user->phone_number }}
                                    </div>
                                </div>
                                <div class="mt-4 d-flex gap-3">
                                    <a href="{{ route('member.profile', ['mode' => 'edit']) }}" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm">
                                        <i class="fas fa-user-edit me-2"></i>Edit Profile
                                    </a>
                                    <a href="/member/identitas" class="btn btn-light btn-lg px-4 rounded-pill shadow-sm">
                                        <i class="fas fa-id-card me-2"></i>Kelola Identitas dan Berkas
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-photo-container {
    position: relative;
    display: inline-block;
    padding: 8px;
    background: linear-gradient(45deg, #4e73df, #36b9cc);
    border-radius: 50%;
}

.profile-photo-container img {
    border: 4px solid white;
}

.custom-file-upload {
    position: relative;
    overflow: hidden;
    margin-bottom: 1rem;
}

.form-control:focus {
    border-color: #0056b3;
    box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
}

.card-header.bg-gradient-primary {
    background: linear-gradient(45deg, #0056b3, #007bff);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
    color: #0056b3;
}
</style>

@endsection

