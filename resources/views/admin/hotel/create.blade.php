@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card class="lg:col-span-2">
            <form action="/admin/hotel" method="post" enctype="multipart/form-data">
                @csrf
                <x-form-input label="Kode Hotel" name="kode_hotel" :value="old('kode_hotel')" placeholder="Kode Hotel" />
                <x-form-input label="Nama Hotel" name="nama_hotel" :value="old('nama_hotel')" placeholder="Nama Hotel" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Bintang</label>
                    <div class="flex flex-wrap gap-3">
                        @for ($i = 0; $i <= 7; $i++)
                            <label class="flex items-center gap-1.5 text-sm text-stone-700">
                                <input type="radio" name="bintang" value="{{ $i }}" class="text-maroon-700 focus:ring-maroon-400" @checked(old('bintang') == (string) $i)>
                                {{ $i }}
                            </label>
                        @endfor
                    </div>
                    @error('bintang')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Bintang Setaraf" name="bintang_setaraf" :value="old('bintang_setaraf')" placeholder="Bintang Setaraf" />
                <x-form-input label="Kota" name="kota" :value="old('kota')" placeholder="Kota" />
                <x-form-input label="Negara" name="negara" :value="old('negara')" placeholder="Negara" />
                <x-form-textarea label="Alamat" name="alamat" :value="old('alamat')" placeholder="Alamat" />
                <x-form-input label="Link Gmaps" name="link_gmaps" type="url" :value="old('link_gmaps')" placeholder="Link Gmaps" />
                <x-form-textarea label="Deskripsi" name="deskripsi" :value="old('deskripsi')" placeholder="Deskripsi" />

                <div class="mb-4">
                    <label for="gambar" class="mb-1.5 block text-sm font-medium text-stone-700">Gambar</label>
                    <input type="file" id="gambar" name="gambar"
                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    @error('gambar')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <x-button variant="secondary" href="/admin/hotel">Kembali</x-button>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card>

        <x-card title="Pratinjau Gambar">
            <img src="" alt="" class="img-preview aspect-4/3 w-full rounded-lg object-cover">
        </x-card>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('gambar').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => document.querySelector('.img-preview').src = e.target.result;
            reader.readAsDataURL(file);
        });
    </script>
@endsection
