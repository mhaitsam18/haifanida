@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card class="lg:col-span-2">
            <form action="/admin/maskapai/{{ $maskapai->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <x-form-input label="Kode Maskapai" name="kode_maskapai" :value="old('kode_maskapai', $maskapai->kode_maskapai)" placeholder="Kode Maskapai" />
                <x-form-input label="Nama Maskapai" name="nama_maskapai" :value="old('nama_maskapai', $maskapai->nama_maskapai)" placeholder="Nama Maskapai" />
                <x-form-input label="Negara Asal" name="negara_asal" :value="old('negara_asal', $maskapai->negara_asal)" placeholder="Negara Asal" />
                <x-form-textarea label="Deskripsi" name="deskripsi" :value="old('deskripsi', $maskapai->deskripsi)" placeholder="Deskripsi" />

                <div class="mb-4">
                    <label for="logo" class="mb-1.5 block text-sm font-medium text-stone-700">Logo</label>
                    <input type="file" id="logo" name="logo"
                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    @error('logo')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <x-button variant="secondary" href="/admin/maskapai">Kembali</x-button>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card>

        <x-card title="Pratinjau Logo">
            <img src="{{ $maskapai->logo ? asset('storage/' . $maskapai->logo) : '' }}" alt="" class="img-preview aspect-4/3 w-full rounded-lg object-contain">
        </x-card>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('logo').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => document.querySelector('.img-preview').src = e.target.result;
            reader.readAsDataURL(file);
        });
    </script>
@endsection
