@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                <x-button variant="secondary" :href="'/admin/paket/' . $penginapan->paket_id . '/penginapan'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Kamar">
            <form action="/admin/kamar" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="paket_hotel_id" value="{{ $paketHotel->id ?? '' }}">

                <x-form-input label="Nomor Kamar" name="nomor_kamar" placeholder="Nomor Kamar" />
                <x-form-error name="nomor_kamar" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Kamar</label>
                    <select name="tipe_kamar"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Tipe Kamar</option>
                        @foreach (['Single', 'Double', 'Triple', 'Quad', 'Suite', 'Lainnya'] as $tipe)
                            <option value="{{ $tipe }}">{{ $tipe }}</option>
                        @endforeach
                    </select>
                    <x-form-error name="tipe_kamar" />
                </div>

                <x-form-input label="Kapasitas" name="kapasitas" type="number" placeholder="Kapasitas" />
                <x-form-error name="kapasitas" />
                <x-form-textarea label="Fasilitas" name="fasilitas" placeholder="Fasilitas" />
                <x-form-error name="fasilitas" />

                <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                    <input type="checkbox" value="1" name="tersedia" class="rounded text-maroon-700 focus:ring-maroon-400">
                    Tersedia?
                </label>

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

    <x-data-table searchPlaceholder="Cari kamar...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nomor Kamar</th>
                    <th class="px-4 py-3">Tipe Kamar</th>
                    <th class="px-4 py-3">Kapasitas</th>
                    <th class="px-4 py-3">Fasilitas</th>
                    <th class="px-4 py-3">Ketersediaan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($kamars as $kamar)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $kamar->nomor_kamar }}</td>
                        <td class="px-4 py-3">{{ $kamar->tipe_kamar }}</td>
                        <td class="px-4 py-3">{{ $kamar->kapasitas }}</td>
                        <td class="px-4 py-3">{{ $kamar->fasilitas }}</td>
                        <td class="px-4 py-3"><x-badge :variant="$kamar->tersedia == 1 ? 'success' : 'danger'">{{ $kamar->tersedia == 1 ? 'Tersedia' : 'Tidak Tersedia' }}</x-badge></td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/kamar/{{ $kamar->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Tamu</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/kamar/' . $kamar->id" />

                                <x-modal title="Edit Kamar">
                                    <form action="/admin/kamar/{{ $kamar->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="paket_hotel_id" value="{{ $kamar->paket_hotel_id }}">

                                        <x-form-input label="Nomor Kamar" name="nomor_kamar" :value="$kamar->nomor_kamar" placeholder="Nomor Kamar" />
                                        <x-form-error name="nomor_kamar" />

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Kamar</label>
                                            <select name="tipe_kamar"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Tipe Kamar</option>
                                                @foreach (['Single', 'Double', 'Triple', 'Quad', 'Suite', 'Lainnya'] as $tipe)
                                                    <option value="{{ $tipe }}" @selected($tipe == $kamar->tipe_kamar)>{{ $tipe }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="tipe_kamar" />
                                        </div>

                                        <x-form-input label="Kapasitas" name="kapasitas" type="number" :value="$kamar->kapasitas" placeholder="Kapasitas" />
                                        <x-form-error name="kapasitas" />
                                        <x-form-textarea label="Fasilitas" name="fasilitas" :value="$kamar->fasilitas" placeholder="Fasilitas" />
                                        <x-form-error name="fasilitas" />

                                        <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                                            <input type="checkbox" value="1" name="tersedia" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($kamar->tersedia)>
                                            Tersedia?
                                        </label>

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
