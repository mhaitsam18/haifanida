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

        <x-modal title="Tambah Ekstra">
            <form action="/admin/ekstra" method="post" @submit="submit">
                @csrf
                <x-form-input label="Nama Ekstra" name="nama_ekstra" placeholder="Nama Ekstra" />
                <x-form-error name="nama_ekstra" />

                <x-form-input label="Harga Default / Harga Bawaan" name="harga_default" placeholder="Harga Default / Harga Bawaan" />
                <x-form-error name="harga_default" />

                <div class="mb-4">
                    <label for="jenis_ekstra" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Ekstra</label>
                    <select id="jenis_ekstra" name="jenis_ekstra"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="">Jenis Ekstra</option>
                        <option value="perlengkapan">Perlengkapan</option>
                        <option value="jasa">Jasa</option>
                        <option value="permintaan kamar">Permintaan Kamar</option>
                        <option value="tipe kamar">Tipe Kamar</option>
                        <option value="pesawat">Pesawat</option>
                    </select>
                    <x-form-error name="jenis_ekstra" />
                </div>

                <x-form-textarea label="Deskripsi" name="deskripsi" placeholder="Deskripsi" />
                <x-form-error name="deskripsi" />

                <div class="flex justify-end gap-2">
                    <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                    <x-button type="submit">
                        <span x-show="!submitting">Simpan</span>
                        <span x-show="submitting">Menyimpan...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
    </div>

    <x-data-table searchPlaceholder="Cari ekstra...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Ekstra</th>
                    <th class="px-4 py-3">Harga Bawaan</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Deskripsi</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($ekstras as $ekstra)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $ekstra->nama_ekstra }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($ekstra->harga_default, 2, ',', '.') }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ $ekstra->jenis_ekstra }}</x-badge></td>
                        <td class="px-4 py-3 text-stone-500">{{ $ekstra->deskripsi }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/ekstra/' . $ekstra->id" />

                                <x-modal title="Edit Ekstra">
                                    <form action="/admin/ekstra/{{ $ekstra->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <x-form-input label="Nama Ekstra" name="nama_ekstra" :value="$ekstra->nama_ekstra" placeholder="Nama Ekstra" />
                                        <x-form-error name="nama_ekstra" />

                                        <x-form-input label="Harga Default / Harga Bawaan" name="harga_default" :value="$ekstra->harga_default" placeholder="Harga Default / Harga Bawaan" />
                                        <x-form-error name="harga_default" />

                                        <div class="mb-4">
                                            <label for="jenis_ekstra_{{ $ekstra->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Ekstra</label>
                                            <select id="jenis_ekstra_{{ $ekstra->id }}" name="jenis_ekstra"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="">Jenis Ekstra</option>
                                                <option value="perlengkapan" @selected($ekstra->jenis_ekstra == 'perlengkapan')>Perlengkapan</option>
                                                <option value="jasa" @selected($ekstra->jenis_ekstra == 'jasa')>Jasa</option>
                                                <option value="permintaan kamar" @selected($ekstra->jenis_ekstra == 'permintaan kamar')>Permintaan Kamar</option>
                                                <option value="tipe kamar" @selected($ekstra->jenis_ekstra == 'tipe kamar')>Tipe Kamar</option>
                                                <option value="pesawat" @selected($ekstra->jenis_ekstra == 'pesawat')>Pesawat</option>
                                            </select>
                                            <x-form-error name="jenis_ekstra" />
                                        </div>

                                        <x-form-textarea label="Deskripsi" name="deskripsi" :value="$ekstra->deskripsi" placeholder="Deskripsi" />
                                        <x-form-error name="deskripsi" />

                                        <div class="flex justify-end gap-2">
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
