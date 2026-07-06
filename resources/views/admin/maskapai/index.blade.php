@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Maskapai" maxWidth="max-w-4xl">
            <form action="/admin/maskapai" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <x-form-input label="Kode Maskapai" name="kode_maskapai" placeholder="Kode Maskapai" />
                        <x-form-error name="kode_maskapai" />

                        <x-form-input label="Nama Maskapai" name="nama_maskapai" placeholder="Nama Maskapai" />
                        <x-form-error name="nama_maskapai" />

                        <x-form-input label="Negara Asal" name="negara_asal" placeholder="Negara Asal" />
                        <x-form-error name="negara_asal" />

                        <x-form-textarea label="Deskripsi" name="deskripsi" placeholder="Deskripsi" />
                        <x-form-error name="deskripsi" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Logo</label>
                            <input type="file" name="logo" @change="preview($event)"
                                class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                            <x-form-error name="logo" />
                        </div>
                    </div>

                    <div>
                        <x-card title="Pratinjau Logo">
                            <img x-show="previewUrl" :src="previewUrl" alt="" class="aspect-4/3 w-full rounded-lg object-contain">
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

    <x-data-table searchPlaceholder="Cari maskapai...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Nama Maskapai</th>
                    <th class="px-4 py-3">Negara Asal</th>
                    <th class="px-4 py-3">Deskripsi</th>
                    <th class="px-4 py-3">Logo</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($maskapais as $maskapai)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $maskapai->kode_maskapai }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $maskapai->nama_maskapai }}</td>
                        <td class="px-4 py-3">{{ $maskapai->negara_asal }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $maskapai->deskripsi }}</td>
                        <td class="px-4 py-3">
                            @if ($maskapai->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($maskapai->logo))
                                <img src="{{ asset('storage/' . $maskapai->logo) }}" alt="{{ $maskapai->nama_maskapai }}" class="h-12 w-12 rounded-lg object-contain">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/maskapai/' . $maskapai->id" />

                                <x-modal title="Edit Maskapai" maxWidth="max-w-4xl">
                                    <form action="/admin/maskapai/{{ $maskapai->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <div class="grid gap-6 lg:grid-cols-3">
                                            <div class="lg:col-span-2">
                                                <x-form-input label="Kode Maskapai" name="kode_maskapai" :value="$maskapai->kode_maskapai" placeholder="Kode Maskapai" />
                                                <x-form-error name="kode_maskapai" />

                                                <x-form-input label="Nama Maskapai" name="nama_maskapai" :value="$maskapai->nama_maskapai" placeholder="Nama Maskapai" />
                                                <x-form-error name="nama_maskapai" />

                                                <x-form-input label="Negara Asal" name="negara_asal" :value="$maskapai->negara_asal" placeholder="Negara Asal" />
                                                <x-form-error name="negara_asal" />

                                                <x-form-textarea label="Deskripsi" name="deskripsi" :value="$maskapai->deskripsi" placeholder="Deskripsi" />
                                                <x-form-error name="deskripsi" />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Logo</label>
                                                    <input type="file" name="logo" @change="preview($event)"
                                                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                                    <x-form-error name="logo" />
                                                </div>
                                            </div>

                                            <div>
                                                <x-card title="Pratinjau Logo">
                                                    <img :src="previewUrl || '{{ $maskapai->logo ? asset('storage/' . $maskapai->logo) : '' }}'" alt="" class="aspect-4/3 w-full rounded-lg object-contain">
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
