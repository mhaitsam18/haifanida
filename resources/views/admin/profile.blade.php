@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card title="Profil Saya" class="lg:col-span-2">
            <form action="/admin/profile/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <x-form-input label="Nama Lengkap" name="name" :value="old('name', auth()->user()->name)" placeholder="Nama Lengkap" />
                <x-form-input label="Email" name="email" type="email" :value="old('email', auth()->user()->email)" placeholder="Email" />
                <x-form-input label="Username" name="username" :value="old('username', auth()->user()->username)" placeholder="Username" />
                <x-form-input label="Nomor Ponsel" name="phone_number" type="tel" pattern="^(?:\+|0)[0-9\s\-\*#\,]+$" :value="old('phone_number', auth()->user()->phone_number)" placeholder="Nomor Ponsel" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                    <div class="flex items-center gap-4">
                        <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : '' }}" class="img-preview h-16 w-16 rounded-full border border-cream-200 object-cover">
                        <input type="file" id="photo" name="photo"
                            class="block flex-1 text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    </div>
                    @error('photo')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card>

        <x-card title="Ubah Kata Sandi">
            <form action="/admin/password/{{ auth()->user()->id }}" method="post">
                @method('put')
                @csrf
                <x-form-input label="Kata Sandi Saat Ini" name="current_password" type="password" placeholder="Kata Sandi Saat Ini" />
                <x-form-input label="Kata Sandi Baru" name="password" type="password" placeholder="Kata Sandi Baru" />
                <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />

                <div class="flex justify-end">
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('photo').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => document.querySelector('.img-preview').src = e.target.result;
            reader.readAsDataURL(file);
        });
    </script>
@endsection
