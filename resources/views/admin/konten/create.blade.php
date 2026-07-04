@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div class="grid gap-6 lg:grid-cols-2">
        <x-card>
            <form action="/admin/konten" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <x-form-input label="Nama Konten" name="nama" :value="old('nama')" placeholder="Nama" />
                <x-form-input label="Judul" name="judul" :value="old('judul')" placeholder="Judul" />

                <div class="mb-4">
                    <label for="gambar" class="mb-1.5 block text-sm font-medium text-stone-700">Gambar</label>
                    <input type="file" id="gambar" name="gambar"
                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    @error('gambar')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-textarea label="Isi Konten" name="isi_konten" :value="old('isi_konten')" :rows="10" placeholder="Isi Konten" />

                <div class="flex justify-end gap-2">
                    <x-button variant="secondary" href="/admin/konten">Kembali</x-button>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card>

        <x-card title="Pratinjau Gambar">
            <img src="" class="img-preview aspect-4/3 w-full rounded-lg object-cover">
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
            selector: '#isi_konten',
            height: 400,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace wordcount visualblocks visualchars code fullscreen',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            license_key: 'gpl',
        });
    </script>
@endsection
