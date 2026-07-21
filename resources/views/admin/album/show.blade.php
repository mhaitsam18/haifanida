@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah Foto
                </button>
                <x-button variant="secondary" href="/admin/album"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            </x-slot:actions>
        </x-page-header>

        {{-- Album summary --}}
        <div class="mb-6 flex flex-wrap items-center gap-4 rounded-2xl border border-cream-200 bg-cream-50 p-4">
            @if ($album->cover)
                <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->judul }}" class="h-20 w-32 rounded-lg object-cover">
            @endif
            <div>
                <div class="font-display text-lg font-semibold text-maroon-900">{{ $album->judul }}</div>
                <div class="text-sm text-stone-600">
                    {{ $album->tanggal ? \Carbon\Carbon::parse($album->tanggal)->translatedFormat('d F Y') : 'Tanpa tanggal' }}
                    &middot; {{ $galeris->total() }} foto/video
                </div>
                @if ($album->deskripsi)
                    <div class="mt-1 max-w-xl text-sm text-stone-500">{{ $album->deskripsi }}</div>
                @endif
            </div>
        </div>

        <x-modal title="Tambah Foto ke Album" maxWidth="max-w-4xl">
            <form action="{{ route('admin.album.foto.store', $album) }}" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis</label>
                            <select name="jenis"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="gambar" selected>Gambar</option>
                                <option value="video">Video</option>
                            </select>
                            <x-form-error name="jenis" />
                        </div>

                        <x-form-input label="Nama (opsional)" name="nama" placeholder="Default: judul album" />
                        <x-form-error name="nama" />
                        <x-form-textarea label="Deskripsi (opsional)" name="deskripsi" placeholder="Deskripsi" />
                        <x-form-error name="deskripsi" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">File</label>
                            <input type="file" name="file_path" @change="preview($event)"
                                class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                            <x-form-error name="file_path" />
                        </div>
                    </div>

                    <div>
                        <x-card title="Pratinjau">
                            <img x-show="previewUrl" :src="previewUrl" class="aspect-4/3 w-full rounded-lg object-cover">
                        </x-card>
                    </div>
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                    <x-button type="submit">
                        <span x-show="!submitting">Simpan</span>
                        <span x-show="submitting">Menyimpan...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
    </div>

    @if ($galeris->count())
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
            @foreach ($galeris as $galeri)
                <div class="group relative overflow-hidden rounded-xl border border-cream-200 bg-cream-50">
                    @if ($galeri->jenis === 'video')
                        <video src="{{ asset('storage/' . $galeri->file_path) }}" class="aspect-4/3 w-full object-cover" controls preload="metadata"></video>
                    @else
                        <img src="{{ asset('storage/' . $galeri->file_path) }}" alt="{{ $galeri->nama }}" loading="lazy" class="aspect-4/3 w-full object-cover">
                    @endif
                    <div class="flex items-center justify-between gap-2 px-3 py-2">
                        <div class="truncate text-xs text-stone-600">
                            {{ $galeri->nama }}
                            @if ($galeri->paket_id)
                                <span class="ml-1 rounded bg-cream-200 px-1.5 py-0.5 text-[10px] text-stone-500" title="Foto ini juga tampil di galeri paket">paket</span>
                            @endif
                        </div>
                        <x-delete-form :action="route('admin.album.foto.destroy', [$album, $galeri])" />
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $galeris->links() }}</div>
    @else
        <div class="rounded-2xl border border-cream-200 bg-cream-50 px-6 py-16 text-center">
            <i class="bx bx-image-add text-5xl text-maroon-300"></i>
            <h3 class="font-display mt-4 text-lg font-semibold text-maroon-900">Album ini masih kosong</h3>
            <p class="mt-2 text-sm text-stone-600">Unggah foto pertama dengan tombol "Tambah Foto" di atas.</p>
        </div>
    @endif
@endsection
