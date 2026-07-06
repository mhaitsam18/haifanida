@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div x-data="{ menuOpen: false }" class="relative mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-xl font-bold text-maroon-900">{{ $title }}</h1>
        <div class="relative">
            <button type="button" @click="menuOpen = !menuOpen" class="rounded-lg border border-cream-300 bg-cream-50 px-3 py-2 text-sm font-medium text-stone-600 hover:bg-cream-100">
                <i class="bx bx-dots-horizontal-rounded"></i> Lihat
            </button>
            <div x-show="menuOpen" @click.outside="menuOpen = false" x-cloak
                class="absolute right-0 z-20 mt-2 w-56 rounded-lg border border-cream-200 bg-cream-50 py-1 text-sm shadow-lg">
                <a href="/admin/paket/{{ $paket->id }}/jemaah" class="block px-4 py-2 hover:bg-cream-100">Lihat Jema'ah</a>
                <a href="/admin/paket/{{ $paket->id }}/ekstra" class="block px-4 py-2 hover:bg-cream-100">Lihat Paket Ekstra</a>
                <a href="/admin/paket/{{ $paket->id }}/penginapan" class="block px-4 py-2 hover:bg-cream-100">Lihat Penginapan</a>
                <a href="/admin/paket/{{ $paket->id }}/penerbangan" class="block px-4 py-2 hover:bg-cream-100">Lihat Penerbangan</a>
                <a href="/admin/paket/{{ $paket->id }}/grup" class="block px-4 py-2 hover:bg-cream-100">Lihat Grup</a>
                <a href="/admin/paket/{{ $paket->id }}/bus" class="block px-4 py-2 hover:bg-cream-100">Lihat Bus</a>
                <a href="/admin/paket/{{ $paket->id }}/galeri" class="block px-4 py-2 hover:bg-cream-100">Lihat Galeri</a>
            </div>
        </div>
    </div>

    <x-card class="mb-6">
        <div class="flex flex-col gap-6 md:flex-row">
            @if ($paket->gambar)
                <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}" class="h-48 w-full rounded-xl object-cover md:w-64">
            @endif
            <div class="flex-1">
                <h2 class="font-display text-xl font-semibold text-maroon-900">{{ $paket->nama_paket }}</h2>
                <div class="prose prose-sm mt-2 max-w-none text-stone-600">{!! $paket->deskripsi !!}</div>

                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <ul class="space-y-1 text-sm text-stone-600">
                        <li>Destinasi : {{ $paket->destinasi }}</li>
                        <li>Jenis Paket : {{ $paket->jenis_paket }}</li>
                        <li>Durasi : {{ $paket->durasi }} Hari</li>
                        <li>Harga : Rp.{{ number_format($paket->harga, 2, ',', '.') }}</li>
                        <li>
                            Kuota Jemaah :
                            @if ($paket->kuota_jemaah !== null)
                                <x-badge :variant="$jemaahs->count() >= $paket->kuota_jemaah ? 'danger' : 'success'">{{ $jemaahs->count() }} / {{ $paket->kuota_jemaah }} terisi</x-badge>
                            @else
                                <x-badge variant="info">Tidak dibatasi</x-badge>
                            @endif
                        </li>
                    </ul>
                    <ul class="space-y-1 text-sm text-stone-600">
                        <li>Tempat Keberangkatan : {{ $paket->tempat_keberangkatan }}</li>
                        <li>Tempat Kepulangan : {{ $paket->tempat_kepulangan }}</li>
                        <li>Tanggal Keberangkatan : {{ Carbon::parse($paket->tanggal_mulai)->isoFormat('LL') }}</li>
                        <li>Tanggal Kepulangan : {{ Carbon::parse($paket->tanggal_selesai)->isoFormat('LL') }}</li>
                    </ul>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <x-button :href="'/admin/paket/' . $paket->id . '/pemesanan'"><i class="bx bx-show"></i> Lihat Pemesanan Paket</x-button>
                    <x-button :href="'/admin/paket/' . $paket->id . '/jemaah'"><i class="bx bx-show"></i> Lihat Data Jema'ah</x-button>
                    <x-button variant="secondary" href="/admin/paket">Kembali</x-button>
                </div>
            </div>
        </div>
    </x-card>

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card title="Fasilitas" class="lg:col-span-1">
            <div class="prose prose-sm max-w-none">{!! $paket->fasilitas !!}</div>
        </x-card>

        <div x-data="modalForm()" class="lg:col-span-2">
            <x-card>
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="font-display text-lg font-semibold text-maroon-900">Ekstra Paket</h3>
                    <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-plus"></i> Tambah
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                            <tr>
                                <th class="px-3 py-2">#</th>
                                <th class="px-3 py-2">Ekstra</th>
                                <th class="px-3 py-2">Harga Bawaan</th>
                                <th class="px-3 py-2">Harga</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200">
                            @forelse ($paket->paketEkstras as $ekstra)
                                <tr>
                                    <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2">{{ $ekstra->ekstra->nama_ekstra }}</td>
                                    <td class="px-3 py-2">Rp.{{ number_format($ekstra->ekstra->harga_default, 2, ',', '.') }}</td>
                                    <td class="px-3 py-2">Rp.{{ number_format($ekstra->harga ?? $ekstra->ekstra->harga_default, 2, ',', '.') }}</td>
                                    <td class="px-3 py-2">
                                        <div class="flex gap-2" x-data="modalForm()">
                                            <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                            <x-delete-form :action="'/admin/paket-ekstra/' . $ekstra->id" />

                                            <x-modal title="Edit Paket Ekstra">
                                                <form action="/admin/paket-ekstra/{{ $ekstra->id }}" method="post" @submit="submit">
                                                    @method('put')
                                                    @csrf
                                                    <input type="hidden" name="paket_id" value="{{ $ekstra->paket_id }}">

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra</label>
                                                        <select name="ekstra_id" x-ref="{{ 'harga_ref_' . $ekstra->id }}"
                                                            @change="$refs['harga_input_' + {{ $ekstra->id }}].value = $event.target.options[$event.target.selectedIndex].dataset.harga"
                                                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                            <option value="" selected disabled>Pilih Ekstra</option>
                                                            @foreach ($ekstras as $item_ekstra)
                                                                <option value="{{ $item_ekstra->id }}" data-harga="{{ $item_ekstra->harga_default }}" @selected($item_ekstra->id == $ekstra->ekstra_id)>{{ $item_ekstra->nama_ekstra }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-form-error name="ekstra_id" />
                                                    </div>

                                                    <x-form-input label="Harga" name="harga" type="number" :value="$ekstra->harga" placeholder="Harga" x-ref="{{ 'harga_input_' . $ekstra->id }}" />
                                                    <x-form-error name="harga" />

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
                            @empty
                                <tr><td colspan="5" class="px-3 py-4 text-stone-500">Data ekstra belum tersedia</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>

            <x-modal title="Tambah Data Paket Ekstra">
                <form action="/admin/paket-ekstra" method="post" @submit="submit">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra</label>
                        <select name="ekstra_id" x-ref="harga"
                            @change="$refs.harga_input.value = $event.target.options[$event.target.selectedIndex].dataset.harga"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Ekstra</option>
                            @foreach ($ekstras as $item_ekstra)
                                <option value="{{ $item_ekstra->id }}" data-harga="{{ $item_ekstra->harga_default }}">{{ $item_ekstra->nama_ekstra }}</option>
                            @endforeach
                        </select>
                        <x-form-error name="ekstra_id" />
                    </div>

                    <x-form-input label="Harga" name="harga" type="number" placeholder="Harga" x-ref="harga_input" />
                    <x-form-error name="harga" />

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

        <div x-data="modalForm()" class="lg:col-span-3">
            <x-card>
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="font-display text-lg font-semibold text-maroon-900">Penginapan</h3>
                    <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-plus"></i> Tambah
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                            <tr>
                                <th class="px-3 py-2">#</th>
                                <th class="px-3 py-2">Hotel</th>
                                <th class="px-3 py-2">No. Reservasi</th>
                                <th class="px-3 py-2">Check In</th>
                                <th class="px-3 py-2">Check Out</th>
                                <th class="px-3 py-2">Jumlah Kamar</th>
                                <th class="px-3 py-2">Harga</th>
                                <th class="px-3 py-2">Keterangan</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200">
                            @forelse ($paket->penginapans as $penginapan)
                                <tr>
                                    <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2">{{ $penginapan->hotel->nama_hotel }}</td>
                                    <td class="px-3 py-2">{{ $penginapan->nomor_reservasi }}</td>
                                    <td class="px-3 py-2">{{ Carbon::parse($penginapan->tanggal_check_in)->isoFormat('LL') }}</td>
                                    <td class="px-3 py-2">{{ Carbon::parse($penginapan->tanggal_check_out)->isoFormat('LL') }}</td>
                                    <td class="px-3 py-2">{{ $penginapan->jumlah_kamar }}</td>
                                    <td class="px-3 py-2">Rp.{{ number_format($penginapan->total_harga, 2, ',', '.') }}</td>
                                    <td class="px-3 py-2">{{ $penginapan->keterangan_hotel }}</td>
                                    <td class="px-3 py-2">
                                        <div class="flex gap-2" x-data="modalForm()">
                                            <a href="/admin/penginapan/{{ $penginapan->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Kamar</a>
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
                            @empty
                                <tr><td colspan="9" class="px-3 py-4 text-stone-500">Data penginapan belum tersedia</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>

            <x-modal title="Tambah Data Hotel / Penginapan" maxWidth="max-w-4xl">
                <form action="/admin/penginapan" method="post" @submit="submit">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">

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

        <div x-data="modalForm()" class="lg:col-span-3">
            <x-card>
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="font-display text-lg font-semibold text-maroon-900">Penerbangan</h3>
                    <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-plus"></i> Tambah
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                            <tr>
                                <th class="px-3 py-2">#</th>
                                <th class="px-3 py-2">Maskapai</th>
                                <th class="px-3 py-2">No. Penerbangan</th>
                                <th class="px-3 py-2">PNR</th>
                                <th class="px-3 py-2">Kelas</th>
                                <th class="px-3 py-2">Kuota</th>
                                <th class="px-3 py-2">Harga Tiket</th>
                                <th class="px-3 py-2">Asal</th>
                                <th class="px-3 py-2">Tujuan</th>
                                <th class="px-3 py-2">Berangkat</th>
                                <th class="px-3 py-2">Tiba</th>
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200">
                            @forelse ($paket->penerbangans as $penerbangan)
                                <tr>
                                    <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2">{{ $penerbangan->maskapai->nama_maskapai }}</td>
                                    <td class="px-3 py-2">{{ $penerbangan->nomor_penerbangan }}</td>
                                    <td class="px-3 py-2">{{ $penerbangan->nomor_pnr }}</td>
                                    <td class="px-3 py-2">{{ $penerbangan->kelas }}</td>
                                    <td class="px-3 py-2">{{ $penerbangan->kuota }}</td>
                                    <td class="px-3 py-2">Rp.{{ number_format($penerbangan->total_harga, 2, ',', '.') }}</td>
                                    <td class="px-3 py-2">{{ $penerbangan->bandara_asal }}</td>
                                    <td class="px-3 py-2">{{ $penerbangan->bandara_tujuan }}</td>
                                    <td class="px-3 py-2">{{ Carbon::parse($penerbangan->waktu_keberangkatan)->isoFormat('LL') }}</td>
                                    <td class="px-3 py-2">{{ Carbon::parse($penerbangan->waktu_kedatangan)->isoFormat('LL') }}</td>
                                    <td class="px-3 py-2">{{ $penerbangan->status_penerbangan }}</td>
                                    <td class="px-3 py-2">
                                        <div class="flex gap-2" x-data="modalForm()">
                                            <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                            <x-delete-form :action="'/admin/penerbangan/' . $penerbangan->id" />

                                            <x-modal title="Edit Maskapai / Penerbangan" maxWidth="max-w-4xl">
                                                <form action="/admin/penerbangan/{{ $penerbangan->id }}" method="post" @submit="submit">
                                                    @method('put')
                                                    @csrf
                                                    <input type="hidden" name="paket_id" value="{{ $penerbangan->paket_id }}">

                                                    <div class="grid gap-x-6 md:grid-cols-2">
                                                        <div>
                                                            <div class="mb-4">
                                                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Maskapai</label>
                                                                <select name="maskapai_id"
                                                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                                    <option value="" selected disabled>Pilih Maskapai</option>
                                                                    @foreach ($maskapais as $maskapai)
                                                                        <option value="{{ $maskapai->id }}" @selected($maskapai->id == $penerbangan->maskapai_id)>{{ $maskapai->nama_maskapai }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <x-form-error name="maskapai_id" />
                                                            </div>
                                                            <x-form-input label="Nomor Penerbangan" name="nomor_penerbangan" :value="$penerbangan->nomor_penerbangan" placeholder="Nomor Penerbangan" />
                                                            <x-form-error name="nomor_penerbangan" />
                                                            <x-form-input label="PNR" name="nomor_pnr" :value="$penerbangan->nomor_pnr" placeholder="PNR" />
                                                            <x-form-error name="nomor_pnr" />
                                                            <x-form-input label="Kelas" name="kelas" :value="$penerbangan->kelas" placeholder="Kelas" />
                                                            <x-form-error name="kelas" />
                                                            <x-form-input label="Kuota" name="kuota" type="number" :value="$penerbangan->kuota" placeholder="Kuota" />
                                                            <x-form-error name="kuota" />
                                                            <x-form-textarea label="Keterangan Penerbangan" name="keterangan_penerbangan" :value="$penerbangan->keterangan_penerbangan" placeholder="Keterangan Penerbangan" />
                                                            <x-form-error name="keterangan_penerbangan" />
                                                            <x-form-input label="Total Harga" name="total_harga" type="number" :value="$penerbangan->total_harga" placeholder="Total Harga" />
                                                            <x-form-error name="total_harga" />
                                                        </div>
                                                        <div>
                                                            <x-form-input label="Bandara Asal" name="bandara_asal" :value="$penerbangan->bandara_asal" placeholder="Bandara Asal" />
                                                            <x-form-error name="bandara_asal" />
                                                            <x-form-input label="Bandara Tujuan" name="bandara_tujuan" :value="$penerbangan->bandara_tujuan" placeholder="Bandara Tujuan" />
                                                            <x-form-error name="bandara_tujuan" />
                                                            <x-form-input label="Waktu Keberangkatan" name="waktu_keberangkatan" type="datetime-local" :value="$penerbangan->waktu_keberangkatan" />
                                                            <x-form-input label="Waktu Kedatangan" name="waktu_kedatangan" type="datetime-local" :value="$penerbangan->waktu_kedatangan" />

                                                            <div class="mb-4">
                                                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Status Penerbangan</label>
                                                                <select name="status_penerbangan"
                                                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                                    <option value="" selected disabled>Pilih Status Penerbangan</option>
                                                                    @foreach (['On Schedule', 'Delay', 'Canceled', 'Emergency Landing', 'Failed', 'Landed Safely', 'Accident', 'Crash'] as $status)
                                                                        <option value="{{ $status }}" @selected($penerbangan->status_penerbangan == $status)>{{ $status }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <x-form-error name="status_penerbangan" />
                                                            </div>

                                                            <div class="mb-4">
                                                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Penerbangan</label>
                                                                <select name="tipe_penerbangan"
                                                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                                    <option value="" selected disabled>Pilih Tipe Penerbangan</option>
                                                                    <option value="Langsung" @selected($penerbangan->tipe_penerbangan == 'Langsung')>Langsung / Direct</option>
                                                                    <option value="Transit" @selected($penerbangan->tipe_penerbangan == 'Transit')>Transit / Connecting</option>
                                                                </select>
                                                                <x-form-error name="tipe_penerbangan" />
                                                            </div>

                                                            <x-form-input label="Gate Penerbangan" name="gate_penerbangan" :value="$penerbangan->gate_penerbangan" placeholder="Gate Penerbangan" />
                                                            <x-form-error name="gate_penerbangan" />
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
                            @empty
                                <tr><td colspan="13" class="px-3 py-4 text-stone-500">Data penerbangan belum tersedia</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>

            <x-modal title="Tambah Data Maskapai / Penerbangan" maxWidth="max-w-4xl">
                <form action="/admin/penerbangan" method="post" @submit="submit">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                    <div class="grid gap-x-6 md:grid-cols-2">
                        <div>
                            <div class="mb-4">
                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Maskapai</label>
                                <select name="maskapai_id"
                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                    <option value="" selected disabled>Pilih Maskapai</option>
                                    @foreach ($maskapais as $maskapai)
                                        <option value="{{ $maskapai->id }}">{{ $maskapai->nama_maskapai }}</option>
                                    @endforeach
                                </select>
                                <x-form-error name="maskapai_id" />
                            </div>
                            <x-form-input label="Nomor Penerbangan" name="nomor_penerbangan" placeholder="Nomor Penerbangan" />
                            <x-form-error name="nomor_penerbangan" />
                            <x-form-input label="PNR" name="nomor_pnr" placeholder="PNR" />
                            <x-form-error name="nomor_pnr" />
                            <x-form-input label="Kelas" name="kelas" placeholder="Kelas" />
                            <x-form-error name="kelas" />
                            <x-form-input label="Kuota" name="kuota" type="number" placeholder="Kuota" />
                            <x-form-error name="kuota" />
                            <x-form-textarea label="Keterangan Penerbangan" name="keterangan_penerbangan" placeholder="Keterangan Penerbangan" />
                            <x-form-error name="keterangan_penerbangan" />
                            <x-form-input label="Total Harga" name="total_harga" type="number" placeholder="Total Harga" />
                            <x-form-error name="total_harga" />
                        </div>
                        <div>
                            <x-form-input label="Bandara Asal" name="bandara_asal" placeholder="Bandara Asal" />
                            <x-form-error name="bandara_asal" />
                            <x-form-input label="Bandara Tujuan" name="bandara_tujuan" placeholder="Bandara Tujuan" />
                            <x-form-error name="bandara_tujuan" />
                            <x-form-input label="Waktu Keberangkatan" name="waktu_keberangkatan" type="datetime-local" />
                            <x-form-input label="Waktu Kedatangan" name="waktu_kedatangan" type="datetime-local" />

                            <div class="mb-4">
                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Status Penerbangan</label>
                                <select name="status_penerbangan"
                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                    <option value="" selected disabled>Pilih Status Penerbangan</option>
                                    @foreach (['On Schedule', 'Delay', 'Canceled', 'Emergency Landing', 'Failed', 'Landed Safely', 'Accident', 'Crash'] as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                                <x-form-error name="status_penerbangan" />
                            </div>

                            <div class="mb-4">
                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Penerbangan</label>
                                <select name="tipe_penerbangan"
                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                    <option value="" selected disabled>Pilih Tipe Penerbangan</option>
                                    <option value="Langsung">Langsung / Direct</option>
                                    <option value="Transit">Transit / Connecting</option>
                                </select>
                                <x-form-error name="tipe_penerbangan" />
                            </div>

                            <x-form-input label="Gate Penerbangan" name="gate_penerbangan" placeholder="Gate Penerbangan" />
                            <x-form-error name="gate_penerbangan" />
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

        <div x-data="modalForm()" class="lg:col-span-2">
            <x-card>
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="font-display text-lg font-semibold text-maroon-900">Data Grup</h3>
                    <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-plus"></i> Tambah
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                            <tr>
                                <th class="px-3 py-2">#</th>
                                <th class="px-3 py-2">Agen</th>
                                <th class="px-3 py-2">Nama Grup</th>
                                <th class="px-3 py-2">Ketua</th>
                                <th class="px-3 py-2">Kuota</th>
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200">
                            @forelse ($paket->grups as $grup)
                                <tr>
                                    <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2">{{ $grup->agen->user->name ?? '-' }}</td>
                                    <td class="px-3 py-2">{{ optional($grup->grup)->nama_grup ?? '-' }}</td>
                                    <td class="px-3 py-2">{{ $grup->ketua_grup }}</td>
                                    <td class="px-3 py-2">{{ $grup->kuota_grup }}</td>
                                    <td class="px-3 py-2">{{ $grup->status_grup }}</td>
                                    <td class="px-3 py-2">
                                        <div class="flex gap-2" x-data="modalForm()">
                                            <a href="/admin/grup/{{ $grup->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                            <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                            <x-delete-form :action="'/admin/grup/' . $grup->id" />

                                            <x-modal title="Edit Grup" maxWidth="max-w-3xl">
                                                <form action="/admin/grup/{{ $grup->id }}" method="post" @submit="submit">
                                                    @method('put')
                                                    @csrf
                                                    <input type="hidden" name="paket_id" value="{{ $grup->paket_id }}">

                                                    <div class="grid gap-x-6 md:grid-cols-2">
                                                        <div>
                                                            <div class="mb-4">
                                                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Agen</label>
                                                                <select name="agen_id"
                                                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                                    <option value="">Pilih Agen</option>
                                                                    @foreach ($agens as $item_agen)
                                                                        <option value="{{ $item_agen->id }}" @selected($item_agen->id == $grup->agen_id)>{{ $item_agen->user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <x-form-error name="agen_id" />
                                                            </div>
                                                            <x-form-input label="Nama Grup" name="nama_grup" :value="$grup->nama_grup" placeholder="Nama Grup" required />
                                                            <x-form-error name="nama_grup" />
                                                            <x-form-input label="Ketua Grup" name="ketua_grup" :value="$grup->ketua_grup" placeholder="Ketua Grup" />
                                                            <x-form-error name="ketua_grup" />
                                                        </div>
                                                        <div>
                                                            <x-form-input label="Status Grup" name="status_grup" :value="$grup->status_grup" placeholder="Status Grup" />
                                                            <x-form-error name="status_grup" />
                                                            <x-form-input label="Kuota Grup" name="kuota_grup" type="number" :value="$grup->kuota_grup" placeholder="Kuota Grup" />
                                                            <x-form-error name="kuota_grup" />
                                                            <x-form-textarea label="Keterangan Grup" name="keterangan_grup" :value="$grup->keterangan_grup" placeholder="Keterangan Grup" />
                                                            <x-form-error name="keterangan_grup" />
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
                            @empty
                                <tr><td colspan="7" class="px-3 py-4 text-stone-500">Data grup belum tersedia</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>

            <x-modal title="Tambah Grup" maxWidth="max-w-3xl">
                <form action="/admin/grup" method="post" @submit="submit">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                    <div class="grid gap-x-6 md:grid-cols-2">
                        <div>
                            <div class="mb-4">
                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Agen</label>
                                <select name="agen_id"
                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                    <option value="">Pilih Agen</option>
                                    @foreach ($agens as $item_agen)
                                        <option value="{{ $item_agen->id }}">{{ $item_agen->user->name }}</option>
                                    @endforeach
                                </select>
                                <x-form-error name="agen_id" />
                            </div>
                            <x-form-input label="Nama Grup" name="nama_grup" placeholder="Nama Grup" required />
                            <x-form-error name="nama_grup" />
                            <x-form-input label="Ketua Grup" name="ketua_grup" placeholder="Ketua Grup" />
                            <x-form-error name="ketua_grup" />
                        </div>
                        <div>
                            <x-form-input label="Status Grup" name="status_grup" placeholder="Status Grup" />
                            <x-form-error name="status_grup" />
                            <x-form-input label="Kuota Grup" name="kuota_grup" type="number" placeholder="Kuota Grup" />
                            <x-form-error name="kuota_grup" />
                            <x-form-textarea label="Keterangan Grup" name="keterangan_grup" placeholder="Keterangan Grup" />
                            <x-form-error name="keterangan_grup" />
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

        <div x-data="modalForm()" class="lg:col-span-1">
            <x-card>
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="font-display text-lg font-semibold text-maroon-900">Data Bus</h3>
                    <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-plus"></i> Tambah
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                            <tr>
                                <th class="px-3 py-2">#</th>
                                <th class="px-3 py-2">No. Rombongan</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200">
                            @forelse ($paket->buses as $bus)
                                <tr>
                                    <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2">{{ $bus->nomor_rombongan }}</td>
                                    <td class="px-3 py-2">
                                        <div class="flex gap-2" x-data="modalForm()">
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
                            @empty
                                <tr><td colspan="3" class="px-3 py-4 text-stone-500">Data bus belum tersedia</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>

            <x-modal title="Tambah Bus" maxWidth="max-w-2xl">
                <form action="/admin/bus" method="post" @submit="submit">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">

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

        <x-card class="lg:col-span-3" title="Data Jemaah">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Grup</th>
                            <th class="px-3 py-2">Nama Lengkap</th>
                            <th class="px-3 py-2">Email</th>
                            <th class="px-3 py-2">Nomor Ponsel</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @foreach ($jemaahs as $jemaah)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ optional($jemaah->grup)->nama_grup ?? '-' }}</td>
                                <td class="px-3 py-2">{{ $jemaah->nama_lengkap }}</td>
                                <td class="px-3 py-2">{{ $jemaah->email }}</td>
                                <td class="px-3 py-2">{{ $jemaah->nomor_telepon }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex gap-2">
                                        <a href="/admin/paket/{{ $paket->id }}/jemaah/{{ $jemaah->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                        <x-delete-form :action="'/admin/jemaah/' . $jemaah->id" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>

        <div x-data="modalForm()" class="lg:col-span-3">
            <x-card>
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="font-display text-lg font-semibold text-maroon-900">Galeri</h3>
                    <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-plus"></i> Tambah Foto
                    </button>
                </div>
                @if ($paket->galeris->count() > 0)
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6">
                        @foreach ($paket->galeris as $galeri)
                            <img src="{{ asset('storage/' . $galeri->file_path) }}" alt="{{ $galeri->nama }}" title="{{ $galeri->nama }}" class="aspect-square w-full rounded-lg object-cover">
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-stone-500">Tidak Ada Foto</p>
                @endif
            </x-card>

            <x-modal title="Tambah Galeri" maxWidth="max-w-4xl">
                <form action="/admin/galeri" method="post" enctype="multipart/form-data" @submit="submit">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">

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
    </div>
@endsection
