@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                @if ($bus)
                    <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-plus"></i> Tambah
                    </button>
                    <x-button variant="secondary" :href="'/admin/paket/' . $bus->paket_id . '/bus'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                @endif
            </x-slot:actions>
        </x-page-header>

        @if ($bus)
            <x-modal title="Tambah Penumpang" maxWidth="max-w-2xl">
                <form action="/admin/penumpang" method="post" @submit="submit">
                    @csrf
                    <input type="hidden" name="bus_id" value="{{ $bus->id }}">

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Jemaah</label>
                        <select name="jemaah_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih jemaah</option>
                            @foreach ($createJemaahs as $jemaah)
                                <option value="{{ $jemaah->id }}">{{ $jemaah->nama_lengkap }}</option>
                            @endforeach
                        </select>
                        <x-form-error name="jemaah_id" />
                    </div>

                    <x-form-input label="Nomor Kursi" name="nomor_kursi" type="number" placeholder="Nomor Kursi" />
                    <x-form-error name="nomor_kursi" />

                    <div class="mt-4 flex justify-end gap-2">
                        <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                        <x-button type="submit">
                            <span x-show="!submitting">Simpan</span>
                            <span x-show="submitting">Menyimpan...</span>
                        </x-button>
                    </div>
                </form>
            </x-modal>
        @endif
    </div>

    <x-data-table searchPlaceholder="Cari penumpang...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nomor Kursi</th>
                    <th class="px-4 py-3">Nama Penumpang</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($penumpangs as $penumpang)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $penumpang->nomor_kursi }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $penumpang->jemaah->nama_lengkap }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/penumpang/' . $penumpang->id" />

                                <x-modal title="Edit Penumpang" maxWidth="max-w-2xl">
                                    <form action="/admin/penumpang/{{ $penumpang->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="bus_id" value="{{ $penumpang->bus_id }}">

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Jemaah</label>
                                            <select name="jemaah_id"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih jemaah</option>
                                                @foreach ($editJemaahsPerPenumpang[$penumpang->id] as $jemaah)
                                                    <option value="{{ $jemaah->id }}" @selected($jemaah->id == $penumpang->jemaah_id)>{{ $jemaah->nama_lengkap }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="jemaah_id" />
                                        </div>

                                        <x-form-input label="Nomor Kursi" name="nomor_kursi" type="number" :value="$penumpang->nomor_kursi" placeholder="Nomor Kursi" />
                                        <x-form-error name="nomor_kursi" />

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
