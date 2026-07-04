@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card class="lg:col-span-2">
            <form action="/admin/galeri" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id ?? null }}">

                <div class="mb-4">
                    <label for="jenis" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis</label>
                    <select id="jenis" name="jenis"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Jenis</option>
                        <option value="gambar" @selected('gambar' == old('jenis'))>Gambar</option>
                        <option value="video" @selected('video' == old('jenis'))>Video</option>
                    </select>
                    @error('jenis')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Nama" name="nama" :value="old('nama')" placeholder="Nama" />
                <x-form-textarea label="Deskripsi" name="deskripsi" :value="old('deskripsi')" placeholder="Deskripsi" />

                <div class="mb-4">
                    <label for="file_path" class="mb-1.5 block text-sm font-medium text-stone-700">File</label>
                    <input type="file" id="file_path" name="file_path"
                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    @error('file_path')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <x-button variant="secondary" :href="'/admin/paket/' . $paket->id . '/galeri'">Kembali</x-button>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card>

        <x-card title="Pratinjau">
            <img src="" class="img-preview aspect-4/3 w-full rounded-lg object-cover">
        </x-card>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('file_path').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => document.querySelector('.img-preview').src = e.target.result;
            reader.readAsDataURL(file);
        });
    </script>
@endsection
