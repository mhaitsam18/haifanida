@extends('admin.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

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

        <x-modal title="Tambah Pemesanan">
            <form action="/admin/pemesanan" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id ?? null }}">
                @if ($paket)
                    <h4 class="font-display mb-4 text-base font-semibold text-maroon-900">{{ $paket->nama_paket }}</h4>
                @endif

                <div class="mb-4">
                    <label for="user_id" class="mb-1.5 block text-sm font-medium text-stone-700">Pemesan</label>
                    <select id="user_id" name="user_id"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="">Pilih Pemesan</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-form-error name="user_id" />
                </div>

                <div class="mb-4">
                    <label for="status" class="mb-1.5 block text-sm font-medium text-stone-700">Status</label>
                    <select id="status" name="status"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Status</option>
                        <option value="Tertunda">Tertunda</option>
                        <option value="dikonfirmasi">dikonfirmasi</option>
                        <option value="diterima">diterima</option>
                        <option value="ditolak">ditolak</option>
                        <option value="dibatalkan">dibatalkan</option>
                    </select>
                    <x-form-error name="status" />
                </div>

                <x-form-input label="Tanggal Pemesanan" name="tanggal_pesan" type="date" />
                <x-form-error name="tanggal_pesan" />

                <x-form-input label="Jumlah Jema'ah / Wisatawan" name="jumlah_orang" type="number" placeholder="Jumlah Jema'ah / Wisatawan" />
                <x-form-error name="jumlah_orang" />

                <x-form-input label="Total Harga" name="total_harga" type="number" placeholder="Total Harga" />
                <x-form-error name="total_harga" />

                <x-form-input label="Metode Pembayaran" name="metode_pembayaran" value="Cash" placeholder="(Cash/Tunai/Cicilan/Tabungan/Hutang/Umroh dulu baru bayar)" />
                <x-form-error name="metode_pembayaran" />

                <div class="mb-4">
                    <label class="flex items-center gap-2 text-sm text-stone-700">
                        <input type="checkbox" value="1" name="is_pembayaran_lunas" class="rounded text-maroon-700 focus:ring-maroon-400">
                        Sudah Lunas?
                    </label>
                    <x-form-error name="is_pembayaran_lunas" />
                </div>

                <x-form-input label="Tanggal Pelunasan" name="tanggal_pelunasan" type="date" />
                <x-form-error name="tanggal_pelunasan" />

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

    <x-data-table searchPlaceholder="Cari pemesanan...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Pemesan</th>
                    <th class="px-4 py-3">Nama Paket</th>
                    <th class="px-4 py-3">Jenis Paket</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Tanggal Pemesanan</th>
                    <th class="px-4 py-3">Tanggal Keberangkatan</th>
                    <th class="px-4 py-3">Jumlah Orang</th>
                    <th class="px-4 py-3">Total Harga</th>
                    <th class="px-4 py-3">Metode Pembayaran</th>
                    <th class="px-4 py-3">Pelunasan</th>
                    <th class="px-4 py-3">Tenggat Pelunasan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pemesanans as $pemesanan)
                    @php
                        $statusVariant = match (true) {
                            $pemesanan->status == 'Tertunda' => 'warning',
                            in_array($pemesanan->status, ['diterima', 'dikonfirmasi']) => 'success',
                            in_array($pemesanan->status, ['ditolak', 'dibatalkan']) => 'danger',
                            default => 'neutral',
                        };
                    @endphp
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $pemesanan->user->name }}</td>
                        <td class="px-4 py-3"><a href="/admin/paket/{{ $pemesanan->paket_id }}" class="text-maroon-700 hover:underline">{{ $pemesanan->paket->nama_paket }}</a></td>
                        <td class="px-4 py-3">{{ $pemesanan->paket->jenis_paket }}</td>
                        <td class="px-4 py-3"><x-badge :variant="$statusVariant">{{ $pemesanan->status }}</x-badge></td>
                        <td class="px-4 py-3">{{ Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ $pemesanan->tanggal_berangkat ? Carbon::parse($pemesanan->tanggal_berangkat)->isoFormat('LL') : '-' }}</td>
                        <td class="px-4 py-3">{{ $pemesanan->jumlah_orang }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($pemesanan->total_harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $pemesanan->metode_pembayaran }}</td>
                        <td class="px-4 py-3"><x-badge :variant="$pemesanan->is_pembayaran_lunas ? 'success' : 'warning'">{{ $pemesanan->is_pembayaran_lunas ? 'Lunas' : 'Belum Lunas' }}</x-badge></td>
                        <td class="px-4 py-3">{{ $pemesanan->tanggal_pelunasan ? Carbon::parse($pemesanan->tanggal_pelunasan)->isoFormat('LL') : '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/pemesanan/{{ $pemesanan->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/pemesanan/' . $pemesanan->id" />

                                <x-modal title="Edit Pemesanan">
                                    <form action="/admin/pemesanan/{{ $pemesanan->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="paket_id" value="{{ $pemesanan->paket_id }}">
                                        <h4 class="font-display mb-4 text-base font-semibold text-maroon-900">{{ $pemesanan->paket->nama_paket ?? null }}</h4>

                                        <div class="mb-4">
                                            <label for="user_id_{{ $pemesanan->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Pemesan</label>
                                            <select id="user_id_{{ $pemesanan->id }}" name="user_id"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="">Pilih Pemesan</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @selected($user->id == $pemesanan->user_id)>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="user_id" />
                                        </div>

                                        <div class="mb-4">
                                            <label for="status_{{ $pemesanan->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Status</label>
                                            <select id="status_{{ $pemesanan->id }}" name="status"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="Tertunda" @selected('Tertunda' == $pemesanan->status)>Tertunda</option>
                                                <option value="dikonfirmasi" @selected('dikonfirmasi' == $pemesanan->status)>dikonfirmasi</option>
                                                <option value="diterima" @selected('diterima' == $pemesanan->status)>diterima</option>
                                                <option value="ditolak" @selected('ditolak' == $pemesanan->status)>ditolak</option>
                                                <option value="dibatalkan" @selected('dibatalkan' == $pemesanan->status)>dibatalkan</option>
                                            </select>
                                            <x-form-error name="status" />
                                        </div>

                                        <x-form-input label="Tanggal Pemesanan" name="tanggal_pesan" type="date" :value="$pemesanan->tanggal_pesan" />
                                        <x-form-error name="tanggal_pesan" />

                                        <x-form-input label="Jumlah Jema'ah / Wisatawan" name="jumlah_orang" type="number" :value="$pemesanan->jumlah_orang" placeholder="Jumlah Jema'ah / Wisatawan" />
                                        <x-form-error name="jumlah_orang" />

                                        <x-form-input label="Total Harga" name="total_harga" type="number" :value="$pemesanan->total_harga" placeholder="Total Harga" />
                                        <x-form-error name="total_harga" />

                                        <x-form-input label="Metode Pembayaran" name="metode_pembayaran" :value="$pemesanan->metode_pembayaran" placeholder="(Cash/Tunai/Cicilan/Tabungan/Hutang/Umroh dulu baru bayar)" />
                                        <x-form-error name="metode_pembayaran" />

                                        <div class="mb-4">
                                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                                <input type="checkbox" value="1" name="is_pembayaran_lunas" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($pemesanan->is_pembayaran_lunas)>
                                                Sudah Lunas?
                                            </label>
                                            <x-form-error name="is_pembayaran_lunas" />
                                        </div>

                                        <x-form-input label="Tanggal Pelunasan" name="tanggal_pelunasan" type="date" :value="$pemesanan->tanggal_pelunasan" />
                                        <x-form-error name="tanggal_pelunasan" />

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
