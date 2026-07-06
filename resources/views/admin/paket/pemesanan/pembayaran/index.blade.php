@extends('admin.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                @if ($pemesanan)
                    <x-button variant="secondary" :href="'/admin/pemesanan/' . $pemesanan->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                @endif
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Pembayaran">
            <form action="/admin/pembayaran" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id ?? '' }}">

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

    <x-data-table searchPlaceholder="Cari pembayaran...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Jumlah Pembayaran</th>
                    <th class="px-4 py-3">Metode Pembayaran</th>
                    <th class="px-4 py-3">Tanggal Pembayaran</th>
                    <th class="px-4 py-3">Bukti Pembayaran</th>
                    <th class="px-4 py-3">Status Pembayaran</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pembayarans as $pembayaran)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">Rp.{{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $pembayaran->metode_pembayaran }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($pembayaran->tanggal_pembayaran)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="text-maroon-700 hover:underline">Lihat Bukti</a>
                        </td>
                        <td class="px-4 py-3">
                            <x-badge :variant="$pembayaran->status_pembayaran == 'diterima' ? 'success' : ($pembayaran->status_pembayaran == 'ditolak' ? 'danger' : 'warning')">{{ $pembayaran->status_pembayaran }}</x-badge>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                @if ($pembayaran->status_pembayaran === 'tertunda')
                                    <form action="{{ route('admin.pembayaran.verify', $pembayaran->id) }}" method="post" x-data
                                        @submit.prevent="if (confirm('Verifikasi pembayaran ini?')) $el.submit()">
                                        @csrf
                                        <button type="submit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Verifikasi</button>
                                    </form>
                                    <form action="{{ route('admin.pembayaran.reject', $pembayaran->id) }}" method="post" x-data
                                        @submit.prevent="if (confirm('Tolak pembayaran ini?')) $el.submit()">
                                        @csrf
                                        <button type="submit" class="rounded-md bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 hover:bg-red-100">Tolak</button>
                                    </form>
                                @endif
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
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
