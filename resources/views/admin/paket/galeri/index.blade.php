@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Galeri" maxWidth="max-w-4xl">
            <form action="/admin/galeri" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id ?? null }}">

                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis</label>
                            <select name="jenis"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Jenis</option>
                                <option value="gambar">Gambar</option>
                                <option value="video">Video</option>
                            </select>
                            <x-form-error name="jenis" />
                        </div>

                        <x-form-input label="Nama" name="nama" placeholder="Nama" />
                        <x-form-error name="nama" />
                        <x-form-textarea label="Deskripsi" name="deskripsi" placeholder="Deskripsi" />
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

    <x-data-table searchPlaceholder="Cari galeri...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Deskripsi</th>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($galeries as $galeri)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ $galeri->jenis }}</x-badge></td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $galeri->nama }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $galeri->deskripsi }}</td>
                        <td class="px-4 py-3"><img src="{{ asset('storage/' . $galeri->file_path) }}" alt="{{ $galeri->nama }}" class="h-16 w-24 rounded-lg object-cover"></td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/galeri/' . $galeri->id" />

                                <x-modal title="Edit Galeri" maxWidth="max-w-4xl">
                                    <form action="/admin/galeri/{{ $galeri->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="paket_id" value="{{ $galeri->paket_id }}">

                                        <div class="grid gap-6 lg:grid-cols-3">
                                            <div class="lg:col-span-2">
                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis</label>
                                                    <select name="jenis"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Jenis</option>
                                                        <option value="gambar" @selected($galeri->jenis == 'gambar')>Gambar</option>
                                                        <option value="video" @selected($galeri->jenis == 'video')>Video</option>
                                                    </select>
                                                    <x-form-error name="jenis" />
                                                </div>

                                                <x-form-input label="Nama" name="nama" :value="$galeri->nama" placeholder="Nama" />
                                                <x-form-error name="nama" />
                                                <x-form-textarea label="Deskripsi" name="deskripsi" :value="$galeri->deskripsi" placeholder="Deskripsi" />
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
                                                    <img :src="previewUrl || '{{ asset('storage/' . $galeri->file_path) }}'" class="aspect-4/3 w-full rounded-lg object-cover">
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
