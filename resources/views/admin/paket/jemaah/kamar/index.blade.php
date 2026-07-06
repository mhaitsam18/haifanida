@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                @if ($jemaah)
                    <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-plus"></i> Tambah
                    </button>
                    <x-button variant="secondary" :href="'/admin/jemaah/' . $jemaah->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                @endif
            </x-slot:actions>
        </x-page-header>

        @if ($jemaah)
            <x-modal title="Tambah Data Penghuni / Tamu">
                <form action="/admin/kamar-jemaah" method="post" @submit="submit">
                    @csrf
                    <input type="hidden" name="jemaah_id" value="{{ $jemaah->id }}">

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Kamar</label>
                        <select name="kamar_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Kamar</option>
                            @foreach ($kamars as $item_kamar)
                                <option value="{{ $item_kamar->id }}">{{ $item_kamar->nomor_kamar }}</option>
                            @endforeach
                        </select>
                        <x-form-error name="kamar_id" />
                    </div>

                    <div class="flex justify-end gap-2">
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

    <x-data-table searchPlaceholder="Cari kamar...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nomor Kamar</th>
                    <th class="px-4 py-3">Tipe Kamar</th>
                    <th class="px-4 py-3">Kapasitas</th>
                    <th class="px-4 py-3">Kota</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($kamarJemaahs as $tamu)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $tamu->kamar->nomor_kamar }}</td>
                        <td class="px-4 py-3">{{ $tamu->kamar->tipe_kamar }}</td>
                        <td class="px-4 py-3">{{ $tamu->kamar->kapasitas }}</td>
                        <td class="px-4 py-3">{{ $tamu->kamar->paketHotel->hotel->kota }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/kamar/{{ $tamu->kamar_id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Anggota Kamar</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/kamar-jemaah/' . $tamu->id" />

                                <x-modal title="Edit Data Penghuni / Tamu">
                                    <form action="/admin/kamar-jemaah/{{ $tamu->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Kamar</label>
                                            <select name="kamar_id"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Kamar</option>
                                                @foreach ($kamars as $item_kamar)
                                                    <option value="{{ $item_kamar->id }}" @selected($item_kamar->id == $tamu->kamar_id)>{{ $item_kamar->nomor_kamar }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="kamar_id" />
                                        </div>

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Jemaah</label>
                                            <select name="jemaah_id"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Jemaah</option>
                                                @foreach ($jemaahs as $item_jemaah)
                                                    <option value="{{ $item_jemaah->id }}" @selected($item_jemaah->id == $tamu->jemaah_id)>{{ $item_jemaah->nama_lengkap }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="jemaah_id" />
                                        </div>

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
