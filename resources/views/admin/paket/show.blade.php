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

        <x-card class="lg:col-span-2">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="font-display text-lg font-semibold text-maroon-900">Ekstra Paket</h3>
                <x-button :href="'/admin/paket/' . $paket->id . '/ekstra/create'" class="px-3! py-1.5! text-xs"><i class="bx bx-plus"></i> Tambah</x-button>
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
                                    <div class="flex gap-2">
                                        <a href="/admin/paket-ekstra/{{ $ekstra->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/paket-ekstra/' . $ekstra->id" />
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

        <x-card class="lg:col-span-3">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="font-display text-lg font-semibold text-maroon-900">Penginapan</h3>
                <x-button :href="'/admin/paket/' . $paket->id . '/penginapan/create'" class="px-3! py-1.5! text-xs"><i class="bx bx-plus"></i> Tambah</x-button>
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
                                    <div class="flex gap-2">
                                        <a href="/admin/penginapan/{{ $penginapan->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Kamar</a>
                                        <a href="/admin/penginapan/{{ $penginapan->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/penginapan/' . $penginapan->id" />
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

        <x-card class="lg:col-span-3">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="font-display text-lg font-semibold text-maroon-900">Penerbangan</h3>
                <x-button :href="'/admin/paket/' . $paket->id . '/penerbangan/create'" class="px-3! py-1.5! text-xs"><i class="bx bx-plus"></i> Tambah</x-button>
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
                                    <div class="flex gap-2">
                                        <a href="/admin/penerbangan/{{ $penerbangan->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/penerbangan/' . $penerbangan->id" />
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

        <x-card class="lg:col-span-2">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="font-display text-lg font-semibold text-maroon-900">Data Grup</h3>
                <x-button :href="'/admin/paket/' . $paket->id . '/grup/create'" class="px-3! py-1.5! text-xs"><i class="bx bx-plus"></i> Tambah</x-button>
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
                                    <div class="flex gap-2">
                                        <a href="/admin/grup/{{ $grup->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                        <a href="/admin/grup/{{ $grup->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/grup/' . $grup->id" />
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

        <x-card class="lg:col-span-1">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="font-display text-lg font-semibold text-maroon-900">Data Bus</h3>
                <x-button :href="'/admin/paket/' . $paket->id . '/bus/create'" class="px-3! py-1.5! text-xs"><i class="bx bx-plus"></i> Tambah</x-button>
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
                                    <div class="flex gap-2">
                                        <a href="/admin/bus/{{ $bus->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Penumpang</a>
                                        <a href="/admin/bus/{{ $bus->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/bus/' . $bus->id" />
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
                                        <a href="/admin/paket/{{ $paket->id }}/jemaah/{{ $jemaah->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/jemaah/' . $jemaah->id" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-card class="lg:col-span-3">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="font-display text-lg font-semibold text-maroon-900">Galeri</h3>
                <x-button :href="'/admin/paket/' . $paket->id . '/galeri/create'" class="px-3! py-1.5! text-xs"><i class="bx bx-plus"></i> Tambah Foto</x-button>
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
    </div>
@endsection
