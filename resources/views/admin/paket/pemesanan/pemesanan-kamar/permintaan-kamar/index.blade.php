@extends('admin.layouts.app')

@section('content')
    <div x-data="{...modalForm(), permintaanKhusus: false}">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                @if ($pemesananKamar)
                    <x-button variant="secondary" :href="'/admin/pemesanan/' . $pemesananKamar->pemesanan_id . '/pemesanan-kamar'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                @endif
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Permintaan Kamar">
            <form action="/admin/permintaan-kamar" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="pemesanan_kamar_id" value="{{ $pemesananKamar->id ?? '' }}">

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Permintaan</label>
                    <select name="permintaan" @change="permintaanKhusus = ($event.target.value === 'permintaan_khusus')"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Permintaan</option>
                        @foreach ($permintaans as $permintaan)
                            <option value="{{ $permintaan->nama_ekstra }}">{{ $permintaan->nama_ekstra }}</option>
                        @endforeach
                        <option value="permintaan_khusus">Permintaan Tidak Tersedia</option>
                    </select>
                    <x-form-error name="permintaan" />
                </div>

                <div class="mb-4" x-show="permintaanKhusus">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Permintaan Khusus</label>
                    <input type="text" name="permintaan_khusus" placeholder="Masukkan Permintaan Khusus"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                </div>

                <x-form-input label="Harga" name="harga" type="number" placeholder="Total Harga" />
                <x-form-error name="harga" />
                <x-form-textarea label="Keterangan" name="keterangan" placeholder="Keterangan" />
                <x-form-error name="keterangan" />

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

    <x-data-table searchPlaceholder="Cari permintaan...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Permintaan</th>
                    <th class="px-4 py-3">Tambahan Harga</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($permintaanKamars as $permintaan)
                    @php $isKhusus = !$permintaans->pluck('nama_ekstra')->contains($permintaan->permintaan); @endphp
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $permintaan->permintaan }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($permintaan->harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $permintaan->keterangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="{...modalForm(), permintaanKhusus: {{ $isKhusus ? 'true' : 'false' }}}">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/permintaan-kamar/' . $permintaan->id" />

                                <x-modal title="Edit Permintaan Kamar">
                                    <form action="/admin/permintaan-kamar/{{ $permintaan->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="pemesanan_kamar_id" value="{{ $permintaan->pemesanan_kamar_id }}">

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Permintaan</label>
                                            <select name="permintaan" @change="permintaanKhusus = ($event.target.value === 'permintaan_khusus')"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Permintaan</option>
                                                @foreach ($permintaans as $item_permintaan)
                                                    <option value="{{ $item_permintaan->nama_ekstra }}" @selected($item_permintaan->nama_ekstra == $permintaan->permintaan)>{{ $item_permintaan->nama_ekstra }}</option>
                                                @endforeach
                                                <option value="permintaan_khusus" @selected($isKhusus)>Permintaan Tidak Tersedia</option>
                                            </select>
                                            <x-form-error name="permintaan" />
                                        </div>

                                        <div class="mb-4" x-show="permintaanKhusus">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Permintaan Khusus</label>
                                            <input type="text" name="permintaan_khusus" :value="'{{ $isKhusus ? $permintaan->permintaan : '' }}'" placeholder="Masukkan Permintaan Khusus"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                        </div>

                                        <x-form-input label="Harga" name="harga" type="number" :value="$permintaan->harga" placeholder="Total Harga" />
                                        <x-form-error name="harga" />
                                        <x-form-textarea label="Keterangan" name="keterangan" :value="$permintaan->keterangan" placeholder="Keterangan" />
                                        <x-form-error name="keterangan" />

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
