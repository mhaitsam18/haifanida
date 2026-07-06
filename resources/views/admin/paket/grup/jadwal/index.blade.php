@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                @if ($grup)
                    <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-plus"></i> Tambah
                    </button>
                    <x-button variant="secondary" :href="'/admin/grup/' . $grup->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                @endif
            </x-slot:actions>
        </x-page-header>

        @if ($grup)
            <x-modal title="Tambah Jadwal" maxWidth="max-w-3xl">
                <form action="/admin/jadwal" method="post" @submit="submit">
                    @csrf
                    <input type="hidden" name="grup_id" value="{{ $grup->id }}">

                    <div class="grid gap-x-6 md:grid-cols-2">
                        <div>
                            <x-form-input label="Nama Agenda" name="nama_agenda" placeholder="Nama Agenda" required />
                            <x-form-error name="nama_agenda" />
                            <x-form-input label="Lokasi" name="lokasi" placeholder="Lokasi" />
                            <x-form-error name="lokasi" />
                        </div>
                        <div>
                            <x-form-input label="Waktu Mulai" name="waktu_mulai" type="datetime-local" />
                            <x-form-input label="Waktu Selesai" name="waktu_selesai" type="datetime-local" />
                            <x-form-textarea label="Keterangan" name="keterangan" placeholder="Keterangan" />
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
        @endif
    </div>

    <x-data-table searchPlaceholder="Cari jadwal...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Agenda</th>
                    <th class="px-4 py-3">Lokasi</th>
                    <th class="px-4 py-3">Waktu Mulai</th>
                    <th class="px-4 py-3">Waktu Selesai</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($jadwals as $jadwal)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $jadwal->nama_agenda }}</td>
                        <td class="px-4 py-3">{{ $jadwal->lokasi }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($jadwal->waktu_mulai)->isoFormat('LLL') }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($jadwal->waktu_selesai)->isoFormat('LLL') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $jadwal->keterangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/jadwal/' . $jadwal->id" />

                                <x-modal title="Edit Jadwal" maxWidth="max-w-3xl">
                                    <form action="/admin/jadwal/{{ $jadwal->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="grup_id" value="{{ $jadwal->grup_id }}">

                                        <div class="grid gap-x-6 md:grid-cols-2">
                                            <div>
                                                <x-form-input label="Nama Agenda" name="nama_agenda" :value="$jadwal->nama_agenda" placeholder="Nama Agenda" required />
                                                <x-form-error name="nama_agenda" />
                                                <x-form-input label="Lokasi" name="lokasi" :value="$jadwal->lokasi" placeholder="Lokasi" />
                                                <x-form-error name="lokasi" />
                                            </div>
                                            <div>
                                                <x-form-input label="Waktu Mulai" name="waktu_mulai" type="datetime-local" :value="$jadwal->waktu_mulai" />
                                                <x-form-input label="Waktu Selesai" name="waktu_selesai" type="datetime-local" :value="$jadwal->waktu_selesai" />
                                                <x-form-textarea label="Keterangan" name="keterangan" :value="$jadwal->keterangan" placeholder="Keterangan" />
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
