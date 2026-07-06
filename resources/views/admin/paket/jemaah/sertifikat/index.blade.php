@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

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
            <x-modal title="Tambah Sertifikat">
                <form action="/admin/sertifikat-jemaah" method="post" enctype="multipart/form-data" @submit="submit">
                    @csrf
                    <input type="hidden" name="jemaah_id" value="{{ $jemaah->id }}">

                    <x-form-input label="Nomor Sertifikat" name="nomor_sertifikat" placeholder="Nomor Sertifikat" />
                    <x-form-error name="nomor_sertifikat" />
                    <x-form-input label="Tanggal Penerbitan" name="tanggal_penerbitan" type="date" />
                    <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" />
                    <x-form-input label="Jenis Sertifikat" name="jenis_sertifikat" placeholder="Jenis Sertifikat" />

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">File Sertifikat</label>
                        <div class="mb-2">
                            <img x-show="previewUrl" :src="previewUrl" class="h-24 w-32 rounded-lg border border-cream-200 object-cover">
                        </div>
                        <input type="file" name="sertifikat" @change="preview($event)"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-maroon-50 file:px-3 file:py-1.5 file:text-maroon-700">
                        <x-form-error name="sertifikat" />
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

    <x-data-table searchPlaceholder="Cari sertifikat...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nomor Sertifikat</th>
                    <th class="px-4 py-3">Tanggal Penerbitan</th>
                    <th class="px-4 py-3">Tanggal Kadaluarsa</th>
                    <th class="px-4 py-3">Jenis Sertifikat</th>
                    <th class="px-4 py-3">Sertifikat</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($sertifikatJemaahs as $sertifikat)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $sertifikat->nomor_sertifikat }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($sertifikat->tanggal_penerbitan)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($sertifikat->tanggal_kadaluarsa)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ $sertifikat->jenis_sertifikat }}</td>
                        <td class="px-4 py-3"><img src="{{ asset('storage/' . $sertifikat->sertifikat) }}" alt="" class="h-14 w-20 rounded object-cover"></td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/sertifikat-jemaah/' . $sertifikat->id" />

                                <x-modal title="Edit Sertifikat">
                                    <form action="/admin/sertifikat-jemaah/{{ $sertifikat->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="jemaah_id" value="{{ $sertifikat->jemaah_id }}">

                                        <x-form-input label="Nomor Sertifikat" name="nomor_sertifikat" :value="$sertifikat->nomor_sertifikat" placeholder="Nomor Sertifikat" />
                                        <x-form-error name="nomor_sertifikat" />
                                        <x-form-input label="Tanggal Penerbitan" name="tanggal_penerbitan" type="date" :value="$sertifikat->tanggal_penerbitan" />
                                        <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" :value="$sertifikat->tanggal_kadaluarsa" />
                                        <x-form-input label="Jenis Sertifikat" name="jenis_sertifikat" :value="$sertifikat->jenis_sertifikat" placeholder="Jenis Sertifikat" />

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">File Sertifikat</label>
                                            <div class="mb-2">
                                                <img :src="previewUrl || '{{ asset('storage/' . $sertifikat->sertifikat) }}'" class="h-24 w-32 rounded-lg border border-cream-200 object-cover">
                                            </div>
                                            <input type="file" name="sertifikat" @change="preview($event)"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-maroon-50 file:px-3 file:py-1.5 file:text-maroon-700">
                                            <x-form-error name="sertifikat" />
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
