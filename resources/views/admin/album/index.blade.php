@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah Album
                </button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Album" maxWidth="max-w-4xl">
            <form action="/admin/album" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <x-form-input label="Judul Album" name="judul" placeholder="cth. Kloter Keberangkatan 16 Juli 2026" />
                        <x-form-error name="judul" />

                        <x-form-textarea label="Deskripsi (opsional)" name="deskripsi" placeholder="Deskripsi singkat album" />
                        <x-form-error name="deskripsi" />

                        <x-form-input label="Tanggal (opsional)" name="tanggal" type="date" />
                        <x-form-error name="tanggal" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Cover (opsional)</label>
                            <input type="file" name="cover" accept="image/*" @change="preview($event)"
                                class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                            <p class="mt-1 text-xs text-stone-500">Jika kosong, foto pertama yang diunggah akan menjadi cover.</p>
                            <x-form-error name="cover" />
                        </div>
                    </div>

                    <div>
                        <x-card title="Pratinjau Cover">
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

    <x-data-table searchPlaceholder="Cari album...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Cover</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Jumlah Foto</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($albums as $album)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">
                            @if ($album->cover)
                                <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->judul }}" class="h-16 w-24 rounded-lg object-cover">
                            @else
                                <div class="flex h-16 w-24 items-center justify-center rounded-lg bg-cream-100 text-stone-400"><i class="bx bx-image"></i></div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-stone-800">{{ $album->judul }}</div>
                            <div class="mt-1 max-w-md text-xs text-stone-500">{{ \Illuminate\Support\Str::limit($album->deskripsi, 80) }}</div>
                        </td>
                        <td class="px-4 py-3">{{ $album->tanggal ? \Carbon\Carbon::parse($album->tanggal)->translatedFormat('d F Y') : '—' }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ $album->galeris_count }} foto</x-badge></td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/album/{{ $album->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Kelola Foto</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/album/' . $album->id" />

                                <x-modal title="Edit Album" maxWidth="max-w-4xl">
                                    <form action="/admin/album/{{ $album->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <div class="grid gap-6 lg:grid-cols-3">
                                            <div class="lg:col-span-2">
                                                <x-form-input label="Judul Album" name="judul" :value="$album->judul" />
                                                <x-form-error name="judul" />

                                                <x-form-textarea label="Deskripsi (opsional)" name="deskripsi" :value="$album->deskripsi" />
                                                <x-form-error name="deskripsi" />

                                                <x-form-input label="Tanggal (opsional)" name="tanggal" type="date" :value="$album->tanggal" />
                                                <x-form-error name="tanggal" />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Ganti Cover (opsional)</label>
                                                    <input type="file" name="cover" accept="image/*" @change="preview($event)"
                                                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                                    <x-form-error name="cover" />
                                                </div>
                                            </div>

                                            <div>
                                                <x-card title="Cover">
                                                    <img :src="previewUrl || '{{ $album->cover ? asset('storage/' . $album->cover) : '' }}'" class="aspect-4/3 w-full rounded-lg object-cover">
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
