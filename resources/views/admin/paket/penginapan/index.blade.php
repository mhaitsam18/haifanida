@extends('admin.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Data Hotel / Penginapan" maxWidth="max-w-4xl">
            <form action="/admin/penginapan" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id ?? '' }}">

                <div class="grid gap-x-6 md:grid-cols-2">
                    <div>
                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Hotel</label>
                            <select name="hotel_id"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Hotel</option>
                                @foreach ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->nama_hotel }}</option>
                                @endforeach
                            </select>
                            <x-form-error name="hotel_id" />
                        </div>
                        <x-form-input label="Nomor Reservasi" name="nomor_reservasi" placeholder="Nomor Reservasi" />
                        <x-form-error name="nomor_reservasi" />
                        <x-form-input label="Tanggal Check In" name="tanggal_check_in" type="date" />
                        <x-form-input label="Tanggal Check Out" name="tanggal_check_out" type="date" />
                    </div>
                    <div>
                        <x-form-input label="Jumlah Kamar" name="jumlah_kamar" type="number" placeholder="Jumlah Kamar" />
                        <x-form-error name="jumlah_kamar" />
                        <x-form-input label="Total Harga" name="total_harga" type="number" placeholder="Total Harga" />
                        <x-form-error name="total_harga" />
                        <x-form-textarea label="Keterangan Hotel" name="keterangan_hotel" placeholder="Keterangan Hotel" />
                        <x-form-error name="keterangan_hotel" />
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

    <x-data-table searchPlaceholder="Cari penginapan...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Hotel</th>
                    <th class="px-4 py-3">No. Reservasi</th>
                    <th class="px-4 py-3">Check In</th>
                    <th class="px-4 py-3">Check Out</th>
                    <th class="px-4 py-3">Jumlah Kamar</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($paket->penginapans as $penginapan)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $penginapan->hotel->nama_hotel }}</td>
                        <td class="px-4 py-3">{{ $penginapan->nomor_reservasi }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($penginapan->tanggal_check_in)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($penginapan->tanggal_check_out)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ $penginapan->jumlah_kamar }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($penginapan->total_harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $penginapan->keterangan_hotel }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/penginapan/{{ $penginapan->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Kamar</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/penginapan/' . $penginapan->id" />

                                <x-modal title="Edit Hotel / Penginapan" maxWidth="max-w-4xl">
                                    <form action="/admin/penginapan/{{ $penginapan->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="paket_id" value="{{ $penginapan->paket_id }}">

                                        <div class="grid gap-x-6 md:grid-cols-2">
                                            <div>
                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Hotel</label>
                                                    <select name="hotel_id"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Hotel</option>
                                                        @foreach ($hotels as $hotel)
                                                            <option value="{{ $hotel->id }}" @selected($hotel->id == $penginapan->hotel_id)>{{ $hotel->nama_hotel }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-form-error name="hotel_id" />
                                                </div>
                                                <x-form-input label="Nomor Reservasi" name="nomor_reservasi" :value="$penginapan->nomor_reservasi" placeholder="Nomor Reservasi" />
                                                <x-form-error name="nomor_reservasi" />
                                                <x-form-input label="Tanggal Check In" name="tanggal_check_in" type="date" :value="$penginapan->tanggal_check_in" />
                                                <x-form-input label="Tanggal Check Out" name="tanggal_check_out" type="date" :value="$penginapan->tanggal_check_out" />
                                            </div>
                                            <div>
                                                <x-form-input label="Jumlah Kamar" name="jumlah_kamar" type="number" :value="$penginapan->jumlah_kamar" placeholder="Jumlah Kamar" />
                                                <x-form-error name="jumlah_kamar" />
                                                <x-form-input label="Total Harga" name="total_harga" type="number" :value="$penginapan->total_harga" placeholder="Total Harga" />
                                                <x-form-error name="total_harga" />
                                                <x-form-textarea label="Keterangan Hotel" name="keterangan_hotel" :value="$penginapan->keterangan_hotel" placeholder="Keterangan Hotel" />
                                                <x-form-error name="keterangan_hotel" />
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
