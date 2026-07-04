@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/user-admin" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="role" value="admin">

            <x-form-input label="Nama" name="name" :value="old('name')" placeholder="Nama" />

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
                <label for="kantor_id" class="mb-1.5 block text-sm font-medium text-stone-700">Kantor</label>
                <select id="kantor_id" name="kantor_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected>Pilih Kantor</option>
                    @foreach ($kantors as $kantor)
                        <option value="{{ $kantor->id }}" @selected($kantor->id == old('kantor_id'))>{{ $kantor->nama_kantor }}</option>
                    @endforeach
                </select>
                @error('kantor_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

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

            <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                <input type="checkbox" value="1" name="is_superadmin" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('is_superadmin'))>
                SuperAdmin?
            </label>

            <x-form-input label="Kata Sandi" name="password" type="password" placeholder="Kata Sandi" />
            <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" href="/admin/user-admin">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
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
