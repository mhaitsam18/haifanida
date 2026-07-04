@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card class="lg:col-span-2">
            <form action="/admin/paket" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kantor_id" value="{{ $kantor->id ?? null }}">

                <x-form-input label="Nama Paket" name="nama_paket" :value="old('nama_paket')" placeholder="Nama Paket" />
                <x-form-input label="Destinasi" name="destinasi" :value="old('destinasi')" placeholder="Destinasi" />

                <div class="mb-4">
                    <label for="jenis_paket" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Paket</label>
                    <select id="jenis_paket" name="jenis_paket"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Jenis Paket</option>
                        <option value="umroh" @selected(old('jenis_paket') == 'umroh')>Umroh</option>
                        <option value="haji" @selected(old('jenis_paket') == 'haji')>Haji</option>
                        <option value="wisata halal" @selected(old('jenis_paket') == 'wisata halal')>Wisata Halal</option>
                    </select>
                    @error('jenis_paket')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Durasi (hari)" name="durasi" type="number" :value="old('durasi')" placeholder="Durasi" />
                <x-form-input label="Harga" name="harga" type="number" :value="old('harga')" placeholder="Harga" />
                <x-form-input label="Tempat Keberangkatan" name="tempat_keberangkatan" :value="old('tempat_keberangkatan')" placeholder="Tempat Keberangkatan" />
                <x-form-input label="Tempat Kepulangan" name="tempat_kepulangan" :value="old('tempat_kepulangan')" placeholder="Tempat Kepulangan" />
                <x-form-input label="Tanggal Mulai" name="tanggal_mulai" type="date" :value="old('tanggal_mulai')" />
                <x-form-input label="Tanggal Selesai" name="tanggal_selesai" type="date" :value="old('tanggal_selesai')" />

                <x-form-textarea label="Fasilitas" name="fasilitas" :value="old('fasilitas')" :rows="8" />
                <x-form-textarea label="Deskripsi" name="deskripsi" :value="old('deskripsi')" :rows="8" />

                <div class="mb-4">
                    <label for="gambar" class="mb-1.5 block text-sm font-medium text-stone-700">Gambar</label>
                    <input type="file" id="gambar" name="gambar"
                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    @error('gambar')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                    <input type="hidden" name="published_at" value="">
                    <input type="checkbox" value="{{ now() }}" name="published_at" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('published_at'))>
                    Terbitkan?
                </label>

                <div class="flex justify-end gap-2">
                    <x-button variant="secondary" href="/admin/paket">Kembali</x-button>
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
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.getElementById('gambar').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => document.querySelector('.img-preview').src = e.target.result;
            reader.readAsDataURL(file);
        });

        tinymce.init({
            selector: '#fasilitas, #deskripsi',
            height: 350,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace wordcount visualblocks visualchars code fullscreen',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            license_key: 'gpl',
        });
    </script>
@endsection
