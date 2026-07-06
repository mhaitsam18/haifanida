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

        <x-modal title="Tambah Data Maskapai / Penerbangan" maxWidth="max-w-4xl">
            <form action="/admin/penerbangan" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id ?? '' }}">

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

    <x-data-table searchPlaceholder="Cari penerbangan...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Maskapai</th>
                    <th class="px-4 py-3">No. Penerbangan</th>
                    <th class="px-4 py-3">PNR</th>
                    <th class="px-4 py-3">Kelas</th>
                    <th class="px-4 py-3">Kuota</th>
                    <th class="px-4 py-3">Harga Tiket</th>
                    <th class="px-4 py-3">Asal</th>
                    <th class="px-4 py-3">Tujuan</th>
                    <th class="px-4 py-3">Berangkat</th>
                    <th class="px-4 py-3">Tiba</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Tipe</th>
                    <th class="px-4 py-3">Gate</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($penerbangans as $penerbangan)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $penerbangan->maskapai->nama_maskapai }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->nomor_penerbangan }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->nomor_pnr }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->kelas }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->kuota }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($penerbangan->total_harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->bandara_asal }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->bandara_tujuan }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($penerbangan->waktu_keberangkatan)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($penerbangan->waktu_kedatangan)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->status_penerbangan }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->tipe_penerbangan }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->gate_penerbangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
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
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
