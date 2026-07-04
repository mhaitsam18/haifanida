@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card class="lg:col-span-2">
            <form action="/admin/author" method="post" enctype="multipart/form-data">
                @csrf
                <x-form-input label="Nama Lengkap / Nama Pena" name="name" :value="old('name')" placeholder="Nama Lengkap / Nama Pena" />

                <div>
                    <x-form-input label="Email" name="email" type="email" :value="old('email')" placeholder="Email" />
                    <p id="email-availability" class="-mt-3 mb-3 text-xs"></p>
                </div>
                <div>
                    <x-form-input label="Username" name="username" :value="old('username')" placeholder="Username" />
                    <p id="username-availability" class="-mt-3 mb-3 text-xs"></p>
                </div>

                <x-form-input label="Nomor Ponsel" name="phone_number" :value="old('phone_number')" placeholder="Nomor Ponsel" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                    <div class="flex items-center gap-4">
                        <img src="" class="img-preview h-16 w-16 rounded-full border border-cream-200 object-cover">
                        <input type="file" id="photo" name="photo"
                            class="block flex-1 text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    </div>
                    @error('photo')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Kata Sandi" name="password" type="password" placeholder="Kata Sandi" />
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

            function checkAvailability(inputId, resultId, urlPrefix, label) {
                document.getElementById(inputId).addEventListener('input', function () {
                    if (!this.value) return;
                    fetch(urlPrefix + '/' + encodeURIComponent(this.value), { headers: { 'Accept': 'application/json' } })
                        .then(response => response.json())
                        .then(data => {
                            const available = data.status === 'available';
                            const el = document.getElementById(resultId);
                            el.textContent = available ? label + ' tersedia' : label + ' sudah digunakan';
                            el.style.color = available ? '#15803d' : '#dc2626';
                        });
                });
            }
            checkAvailability('username', 'username-availability', '/check-username', 'Username');
            checkAvailability('email', 'email-availability', '/check-email', 'Email');
        });
    </script>
@endsection
