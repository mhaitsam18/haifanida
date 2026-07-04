@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card class="lg:col-span-2">
            <form action="/admin/author/{{ $author->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <x-form-input label="Nama Lengkap / Nama Pena" name="name" :value="old('name', $author->user->name)" placeholder="Nama Lengkap / Nama Pena" />

                <div>
                    <x-form-input label="Email" name="email" type="email" :value="old('email', $author->user->email)" placeholder="Email" />
                    <p id="email-availability" class="-mt-3 mb-3 text-xs"></p>
                </div>
                <div>
                    <x-form-input label="Username" name="username" :value="old('username', $author->user->username)" placeholder="Username" />
                    <p id="username-availability" class="-mt-3 mb-3 text-xs"></p>
                </div>

                <x-form-input label="Nomor Ponsel" name="phone_number" :value="old('phone_number', $author->user->phone_number)" placeholder="Nomor Ponsel" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                    <div class="flex items-center gap-4">
                        <img src="{{ $author->user->photo ? asset('storage/' . $author->user->photo) : '' }}" class="img-preview h-16 w-16 rounded-full border border-cream-200 object-cover">
                        <input type="file" id="photo" name="photo"
                            class="block flex-1 text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    </div>
                    @error('photo')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Kata Sandi Baru" name="password" type="password" placeholder="Kata Sandi Saat Ini" />
                <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />

                <div class="flex justify-end gap-2">
                    <x-button variant="secondary" href="/admin/author">Kembali</x-button>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('photo').addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => document.querySelector('.img-preview').src = e.target.result;
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
