@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        $statusVariant = match (true) {
            $pemesanan->status == 'Tertunda' => 'warning',
            in_array($pemesanan->status, ['diterima', 'dikonfirmasi']) => 'success',
            in_array($pemesanan->status, ['ditolak', 'dibatalkan']) => 'danger',
            default => 'neutral',
        };
    @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <a href="/admin/paket/{{ $pemesanan->paket_id }}/jemaah?pemesanan_id={{ $pemesanan->id }}" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-group"></i> Lihat Jema'ah</a>
            <a href="/admin/pemesanan/{{ $pemesanan->id }}/tagihan" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-file"></i> Lihat Tagihan</a>
            <x-button variant="secondary" :href="'/admin/paket/' . $pemesanan->paket_id . '/pemesanan'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-card class="mb-6">
        <div class="flex flex-col gap-6 md:flex-row md:items-start">
            <img src="{{ asset('storage/' . $pemesanan->paket->gambar) }}" class="h-40 w-full shrink-0 rounded-lg object-cover md:w-56" alt="pemesanan">
            <div class="flex-1">
                <div class="mb-3 flex items-center gap-2">
                    <h5 class="font-display text-base font-semibold text-maroon-900">Detail Pemesanan</h5>
                    <x-badge :variant="$statusVariant">{{ $pemesanan->status }}</x-badge>
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <ul class="space-y-1.5 text-sm text-stone-700">
                        <li><span class="text-stone-500">Nama Paket:</span> {{ $pemesanan->paket->nama_paket }}</li>
                        <li><span class="text-stone-500">Tanggal Pemesanan:</span> {{ Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}</li>
                        <li><span class="text-stone-500">Jumlah Pesanan:</span> {{ $pemesanan->jumlah_orang }} pax</li>
                        <li><span class="text-stone-500">Total Harga:</span> Rp.{{ number_format($pemesanan->total_harga, 2, ',', '.') }}</li>
                    </ul>
                    <ul class="space-y-1.5 text-sm text-stone-700">
                        <li><span class="text-stone-500">Tanggal Pelunasan:</span> {{ $pemesanan->tanggal_pelunasan ? Carbon::parse($pemesanan->tanggal_pelunasan)->isoFormat('LL') : '-' }}</li>
                        <li><span class="text-stone-500">Pembayaran:</span> {{ $pemesanan->metode_pembayaran }}</li>
                        <li class="flex items-center gap-2">
                            <span class="text-stone-500">Status Pelunasan:</span>
                            <x-badge :variant="$pemesanan->is_pembayaran_lunas ? 'success' : 'warning'">{{ $pemesanan->is_pembayaran_lunas ? 'Lunas' : 'Belum Lunas' }}</x-badge>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </x-card>

    <div x-data="modalForm()">
        <x-card class="mb-6">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="font-display text-sm font-semibold text-maroon-900">Pemesanan Kamar</h4>
                <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah Pemesanan Kamar
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Tipe Kamar</th>
                            <th class="px-3 py-2">Jumlah Pengisi</th>
                            <th class="px-3 py-2">Harga</th>
                            <th class="px-3 py-2">Keterangan</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @forelse ($pemesanan->pemesananKamars as $kamar)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $kamar->tipe_kamar }}</td>
                                <td class="px-3 py-2">{{ $kamar->jumlah_pengisi }}</td>
                                <td class="px-3 py-2">Rp.{{ number_format($kamar->harga, 2, ',', '.') }}</td>
                                <td class="px-3 py-2">{{ $kamar->keterangan }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2" x-data="modalForm()">
                                        <a href="/admin/pemesanan-kamar/{{ $kamar->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Permintaan</a>
                                        <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                        <x-delete-form :action="'/admin/pemesanan-kamar/' . $kamar->id" />

                                        <x-modal title="Edit Pemesanan Kamar">
                                            <form class="js-pemesanan-kamar-form" action="/admin/pemesanan-kamar/{{ $kamar->id }}" method="post" @submit="submit">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" name="pemesanan_id" value="{{ $kamar->pemesanan_id }}">

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Kamar</label>
                                                    <select name="tipe_kamar" class="js-tipe-kamar-select js-tipe-kamar-select-edit w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Tipe Kamar</option>
                                                        @foreach ($kamars as $item)
                                                            <option value="{{ $item->nama_ekstra }}" data-harga="{{ $item->harga_default }}" data-keterangan="{{ $item->keterangan }}" @selected($item->nama_ekstra == $kamar->tipe_kamar)>
                                                                {{ $item->nama_ekstra }} | Rp.{{ number_format($item->harga_default, 2, ',', '.') }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-form-error name="tipe_kamar" />
                                                </div>

                                                <x-form-input label="Jumlah Pengisi" name="jumlah_pengisi" type="number" class="js-jumlah-pengisi-input" :value="$kamar->jumlah_pengisi" placeholder="Jumlah Pengisi" max="4" />
                                                <x-form-error name="jumlah_pengisi" />
                                                <p class="js-keterangan-desc -mt-3 mb-4 text-xs text-stone-500"></p>

                                                <x-form-input label="Harga" name="harga" type="number" class="js-harga-input" :value="$kamar->harga" placeholder="Total Harga" />
                                                <x-form-error name="harga" />

                                                <x-form-textarea label="Keterangan" name="keterangan" :value="$kamar->keterangan" placeholder="Keterangan" />
                                                <x-form-error name="keterangan" />

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
                            <tr>
                                <td colspan="6" class="px-3 py-2 text-stone-500">Pemesanan kamar belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-modal title="Tambah Pemesanan Kamar">
            <form class="js-pemesanan-kamar-form" action="/admin/pemesanan-kamar" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Kamar</label>
                    <select name="tipe_kamar" class="js-tipe-kamar-select w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Tipe Kamar</option>
                        @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->nama_ekstra }}" data-harga="{{ $kamar->harga_default }}" data-keterangan="{{ $kamar->keterangan }}">
                                {{ $kamar->nama_ekstra }} | Rp.{{ number_format($kamar->harga_default, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <x-form-error name="tipe_kamar" />
                </div>

                <x-form-input label="Jumlah Pengisi" name="jumlah_pengisi" type="number" class="js-jumlah-pengisi-input" placeholder="Jumlah Pengisi" max="4" />
                <x-form-error name="jumlah_pengisi" />
                <p class="js-keterangan-desc -mt-3 mb-4 text-xs text-stone-500"></p>

                <x-form-input label="Harga" name="harga" type="number" class="js-harga-input" placeholder="Total Harga" />
                <x-form-error name="harga" />

                <x-form-textarea label="Keterangan" name="keterangan" placeholder="Keterangan" />
                <x-form-error name="keterangan" />

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

    <div x-data="modalForm()">
        <x-card class="mb-6">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="font-display text-sm font-semibold text-maroon-900">Pemesanan Ekstra</h4>
                <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah Pemesanan Ekstra
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Ekstra / Tambahan</th>
                            <th class="px-3 py-2">Jumlah</th>
                            <th class="px-3 py-2">Total Harga</th>
                            <th class="px-3 py-2">Keterangan</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @forelse ($pemesanan->pemesananEkstras as $ekstra)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $ekstra->ekstra }}</td>
                                <td class="px-3 py-2">{{ $ekstra->jumlah }}</td>
                                <td class="px-3 py-2">Rp.{{ number_format($ekstra->total_harga, 2, ',', '.') }}</td>
                                <td class="px-3 py-2">{{ $ekstra->keterangan }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2" x-data="modalForm()">
                                        <a href="/admin/pemesanan-ekstra/{{ $ekstra->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                        <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                        <x-delete-form :action="'/admin/pemesanan-ekstra/' . $ekstra->id" />

                                        <x-modal title="Edit Pemesanan Ekstra">
                                            <form class="js-pemesanan-ekstra-form" action="/admin/pemesanan-ekstra/{{ $ekstra->id }}" method="post" @submit="submit">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" name="pemesanan_id" value="{{ $ekstra->pemesanan_id }}">

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra / Tambahan</label>
                                                    <select name="ekstra" class="js-ekstra-select w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Ekstra</option>
                                                        @foreach ($ekstras as $item)
                                                            <option value="{{ $item->nama_ekstra }}" data-harga="{{ $item->harga_default }}" data-keterangan="{{ $item->keterangan }}" @selected($item->nama_ekstra == $ekstra->ekstra)>
                                                                {{ $item->nama_ekstra }} | Rp.{{ number_format($item->harga_default, 2, ',', '.') }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-form-error name="ekstra" />
                                                </div>

                                                <x-form-input label="Jumlah" name="jumlah" type="number" class="js-jumlah-input" :value="$ekstra->jumlah" placeholder="Jumlah" />
                                                <x-form-error name="jumlah" />
                                                <p class="js-keterangan-desc -mt-3 mb-4 text-xs text-stone-500"></p>

                                                <x-form-input label="Total Harga" name="total_harga" type="number" class="js-total-harga-input" :value="$ekstra->total_harga" placeholder="Total Harga" />
                                                <x-form-error name="total_harga" />

                                                <x-form-textarea label="Keterangan" name="keterangan" :value="$ekstra->keterangan" placeholder="Keterangan" />
                                                <x-form-error name="keterangan" />

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
                            <tr>
                                <td colspan="6" class="px-3 py-2 text-stone-500">Pemesanan ekstra belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-modal title="Tambah Pemesanan Ekstra">
            <form class="js-pemesanan-ekstra-form" action="/admin/pemesanan-ekstra" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra / Tambahan</label>
                    <select name="ekstra" class="js-ekstra-select w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Ekstra</option>
                        @foreach ($ekstras as $ekstra)
                            <option value="{{ $ekstra->nama_ekstra }}" data-harga="{{ $ekstra->harga_default }}" data-keterangan="{{ $ekstra->keterangan }}">
                                {{ $ekstra->nama_ekstra }} | Rp.{{ number_format($ekstra->harga_default, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <x-form-error name="ekstra" />
                </div>

                <x-form-input label="Jumlah" name="jumlah" type="number" class="js-jumlah-input" placeholder="Jumlah" />
                <x-form-error name="jumlah" />
                <p class="js-keterangan-desc -mt-3 mb-4 text-xs text-stone-500"></p>

                <x-form-input label="Total Harga" name="total_harga" type="number" class="js-total-harga-input" placeholder="Total Harga" />
                <x-form-error name="total_harga" />

                <x-form-textarea label="Keterangan" name="keterangan" placeholder="Keterangan" />
                <x-form-error name="keterangan" />

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

    <div x-data="modalForm()">
        <x-card>
            <div class="mb-3 flex items-center justify-between">
                <h4 class="font-display text-sm font-semibold text-maroon-900">Riwayat Pembayaran</h4>
                <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah Riwayat Pembayaran
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Jumlah Pembayaran</th>
                            <th class="px-3 py-2">Metode Pembayaran</th>
                            <th class="px-3 py-2">Tanggal Pembayaran</th>
                            <th class="px-3 py-2">Bukti Pembayaran</th>
                            <th class="px-3 py-2">Status Pembayaran</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @forelse ($pemesanan->pembayarans as $pembayaran)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">Rp.{{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}</td>
                                <td class="px-3 py-2">{{ $pembayaran->metode_pembayaran }}</td>
                                <td class="px-3 py-2">{{ Carbon::parse($pembayaran->tanggal_pembayaran)->isoFormat('LL') }}</td>
                                <td class="px-3 py-2">
                                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="text-maroon-700 hover:underline">Lihat Bukti</a>
                                </td>
                                <td class="px-3 py-2">
                                    <x-badge :variant="$pembayaran->status_pembayaran == 'diterima' ? 'success' : ($pembayaran->status_pembayaran == 'ditolak' ? 'danger' : 'warning')">{{ $pembayaran->status_pembayaran }}</x-badge>
                                </td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2" x-data="modalForm()">
                                        <a href="/admin/pembayaran/{{ $pembayaran->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                        <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                        <x-delete-form :action="'/admin/pembayaran/' . $pembayaran->id" />

                                        <x-modal title="Edit Pembayaran">
                                            <form action="/admin/pembayaran/{{ $pembayaran->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" name="pemesanan_id" value="{{ $pembayaran->pemesanan_id }}">

                                                <x-form-input label="Jumlah Pembayaran" name="jumlah_pembayaran" type="number" :value="$pembayaran->jumlah_pembayaran" placeholder="Jumlah Pembayaran" />
                                                <x-form-error name="jumlah_pembayaran" />
                                                <x-form-input label="Metode Pembayaran" name="metode_pembayaran" :value="$pembayaran->metode_pembayaran" placeholder="(Transfer / QRIS / dll.)" />
                                                <x-form-error name="metode_pembayaran" />
                                                <x-form-input label="Tanggal Pembayaran" name="tanggal_pembayaran" type="date" :value="$pembayaran->tanggal_pembayaran ? \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('Y-m-d') : ''" readonly />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Bukti Pembayaran</label>
                                                    @if ($pembayaran->bukti_pembayaran)
                                                        <p class="mb-2 text-xs text-stone-500">Bukti saat ini: <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="text-maroon-700 hover:underline">Lihat Bukti</a></p>
                                                    @endif
                                                    <input type="file" name="bukti_pembayaran"
                                                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                                    <x-form-error name="bukti_pembayaran" />
                                                </div>

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Status Pembayaran</label>
                                                    <select name="status_pembayaran"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Status</option>
                                                        <option value="tertunda" @selected($pembayaran->status_pembayaran == 'tertunda')>Tertunda</option>
                                                        <option value="diterima" @selected($pembayaran->status_pembayaran == 'diterima')>diterima</option>
                                                        <option value="ditolak" @selected($pembayaran->status_pembayaran == 'ditolak')>ditolak</option>
                                                    </select>
                                                    <x-form-error name="status_pembayaran" />
                                                </div>

                                                <x-form-textarea label="Keterangan" name="keterangan" :value="$pembayaran->keterangan" placeholder="Keterangan" />
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
                        @empty
                            <tr>
                                <td colspan="7" class="px-3 py-2 text-stone-500">Riwayat pembayaran belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-modal title="Tambah Pembayaran">
            <form action="/admin/pembayaran" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

                <x-form-input label="Jumlah Pembayaran" name="jumlah_pembayaran" type="number" placeholder="Jumlah Pembayaran" />
                <x-form-error name="jumlah_pembayaran" />
                <x-form-input label="Metode Pembayaran" name="metode_pembayaran" placeholder="(Transfer / QRIS / dll.)" />
                <x-form-error name="metode_pembayaran" />
                <x-form-input label="Tanggal Pembayaran" name="tanggal_pembayaran" type="date" />
                <x-form-error name="tanggal_pembayaran" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran"
                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    <x-form-error name="bukti_pembayaran" />
                </div>

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Status Pembayaran</label>
                    <select name="status_pembayaran"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Status</option>
                        <option value="tertunda">Tertunda</option>
                        <option value="diterima">diterima</option>
                        <option value="ditolak">ditolak</option>
                    </select>
                    <x-form-error name="status_pembayaran" />
                </div>

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
@endsection

@section('script')
    <script>
        (function () {
            const defaultOccupants = {
                'tipe kamar quad gabung': null,
                'tipe kamar quad keluarga': 4,
                'tipe kamar quad keluarga isi 3 dan 1 bed kosong': 3,
                'tipe kamar double gabung': 1,
                'tipe kamar double keluarga': 2,
                'tipe kamar single': 1,
            };

            document.querySelectorAll('.js-pemesanan-kamar-form').forEach(function (form) {
                const tipeKamarSelect = form.querySelector('.js-tipe-kamar-select');
                const jumlahPengisiInput = form.querySelector('.js-jumlah-pengisi-input');
                const hargaInput = form.querySelector('.js-harga-input');
                const keteranganDescription = form.querySelector('.js-keterangan-desc');
                const isEdit = tipeKamarSelect.classList.contains('js-tipe-kamar-select-edit');

                function updatePriceAndDescription() {
                    const selected = tipeKamarSelect.options[tipeKamarSelect.selectedIndex];

                    if (selected && selected.value !== '') {
                        keteranganDescription.textContent = selected.getAttribute('data-keterangan') ?? '';

                        const harga = parseFloat(selected.getAttribute('data-harga'));
                        const jumlah = jumlahPengisiInput.value;
                        if (jumlah !== '' && !isNaN(jumlah)) {
                            hargaInput.value = (harga * parseInt(jumlah)).toFixed(2);
                        } else if (!isEdit) {
                            hargaInput.value = harga.toFixed(2);
                        }
                    } else {
                        keteranganDescription.textContent = '';
                        if (!isEdit) {
                            hargaInput.value = '';
                            jumlahPengisiInput.value = '';
                        }
                    }
                }

                tipeKamarSelect.addEventListener('change', function () {
                    const selected = tipeKamarSelect.options[tipeKamarSelect.selectedIndex];
                    if (selected && Object.prototype.hasOwnProperty.call(defaultOccupants, selected.value)) {
                        const fixedOccupants = defaultOccupants[selected.value];
                        if (fixedOccupants === null) {
                            jumlahPengisiInput.value = '';
                            jumlahPengisiInput.readOnly = false;
                        } else {
                            jumlahPengisiInput.value = fixedOccupants;
                            jumlahPengisiInput.readOnly = true;
                        }
                    } else {
                        jumlahPengisiInput.readOnly = false;
                    }
                    updatePriceAndDescription();
                });
                jumlahPengisiInput.addEventListener('input', updatePriceAndDescription);
            });

            document.querySelectorAll('.js-pemesanan-ekstra-form').forEach(function (form) {
                const ekstraSelect = form.querySelector('.js-ekstra-select');
                const jumlahInput = form.querySelector('.js-jumlah-input');
                const totalHargaInput = form.querySelector('.js-total-harga-input');
                const keteranganDescription = form.querySelector('.js-keterangan-desc');

                function updatePriceAndDescription() {
                    const selected = ekstraSelect.options[ekstraSelect.selectedIndex];
                    const jumlah = jumlahInput.value;

                    if (selected && selected.value !== '') {
                        keteranganDescription.textContent = selected.getAttribute('data-keterangan') ?? '';
                        if (jumlah !== '') {
                            const harga = parseFloat(selected.getAttribute('data-harga'));
                            totalHargaInput.value = harga * parseInt(jumlah);
                        }
                    } else {
                        keteranganDescription.textContent = '';
                        totalHargaInput.value = '';
                    }
                }

                ekstraSelect.addEventListener('change', updatePriceAndDescription);
                jumlahInput.addEventListener('input', updatePriceAndDescription);
            });
        })();
    </script>
@endsection
