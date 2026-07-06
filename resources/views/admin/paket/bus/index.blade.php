@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                @if ($paket)
                    <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                @endif
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Bus" maxWidth="max-w-2xl">
            <form action="/admin/bus" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id ?? null }}">

                <x-form-input label="Nomor Rombongan" name="nomor_rombongan" placeholder="Nomor Rombongan" />
                <x-form-error name="nomor_rombongan" />
                <x-form-input label="Nomor Polisi" name="nomor_polisi" placeholder="Nomor Polisi" />
                <x-form-error name="nomor_polisi" />
                <x-form-input label="Merek / PO" name="merek" placeholder="Merek / PO" />
                <x-form-error name="merek" />
                <x-form-input label="Kapasitas" name="kapasitas" type="number" placeholder="Kapasitas" />
                <x-form-error name="kapasitas" />
                <x-form-textarea label="Fasilitas" name="fasilitas" placeholder="Fasilitas" />
                <x-form-error name="fasilitas" />

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

    <x-data-table searchPlaceholder="Cari bus...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">No. Rombongan</th>
                    <th class="px-4 py-3">No. Polisi</th>
                    <th class="px-4 py-3">Merek</th>
                    <th class="px-4 py-3">Kapasitas</th>
                    <th class="px-4 py-3">Fasilitas</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($paket->buses as $bus)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $bus->nomor_rombongan }}</td>
                        <td class="px-4 py-3">{{ $bus->nomor_polisi }}</td>
                        <td class="px-4 py-3">{{ $bus->merek }}</td>
                        <td class="px-4 py-3">{{ $bus->kapasitas }}</td>
                        <td class="px-4 py-3 text-stone-500">{!! $bus->fasilitas !!}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/bus/{{ $bus->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Penumpang</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/bus/' . $bus->id" />

                                <x-modal title="Edit Bus" maxWidth="max-w-2xl">
                                    <form action="/admin/bus/{{ $bus->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="paket_id" value="{{ $bus->paket_id }}">

                                        <x-form-input label="Nomor Rombongan" name="nomor_rombongan" :value="$bus->nomor_rombongan" placeholder="Nomor Rombongan" />
                                        <x-form-error name="nomor_rombongan" />
                                        <x-form-input label="Nomor Polisi" name="nomor_polisi" :value="$bus->nomor_polisi" placeholder="Nomor Polisi" />
                                        <x-form-error name="nomor_polisi" />
                                        <x-form-input label="Merek / PO" name="merek" :value="$bus->merek" placeholder="Merek / PO" />
                                        <x-form-error name="merek" />
                                        <x-form-input label="Kapasitas" name="kapasitas" type="number" :value="$bus->kapasitas" placeholder="Kapasitas" />
                                        <x-form-error name="kapasitas" />
                                        <x-form-textarea label="Fasilitas" name="fasilitas" :value="$bus->fasilitas" placeholder="Fasilitas" />
                                        <x-form-error name="fasilitas" />

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
