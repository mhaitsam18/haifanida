@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <a href="/admin/jemaah/{{ $jemaah->id }}/berkas" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-file"></i> Berkas</a>
            <a href="/admin/jemaah/{{ $jemaah->id }}/kamar" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-hotel"></i> Kamar</a>
            <a href="/admin/jemaah/{{ $jemaah->id }}/bus" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-bus"></i> Bus</a>
            <x-button variant="secondary" :href="'/admin/paket/' . $paket->id . '/jemaah'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-card class="mb-6">
        <div class="flex flex-col gap-6 md:flex-row md:items-start">
            <img src="{{ asset('storage/' . $jemaah->foto) }}" class="h-40 w-32 shrink-0 rounded-lg object-cover" alt="jemaah">
            <div class="grid flex-1 gap-6 md:grid-cols-3">
                <ul class="space-y-1.5 text-sm text-stone-700">
                    <li><span class="text-stone-500">Nomor KTP:</span> {{ $jemaah->nomor_ktp }}</li>
                    <li><span class="text-stone-500">Nama Lengkap:</span> {{ $jemaah->nama_lengkap }}</li>
                    <li><span class="text-stone-500">Nomor Sesuai Paspor:</span> {{ $jemaah->nama_sesuai_paspor }}</li>
                    <li><span class="text-stone-500">Tempat, Tanggal Lahir:</span> {{ $jemaah->tempat_lahir }}, {{ Carbon::parse($jemaah->tanggal_lahir)->isoFormat('LL') }}</li>
                    <li><span class="text-stone-500">Jenis Kelamin:</span> {{ $jemaah->jenis_kelamin }}</li>
                    <li><span class="text-stone-500">Kewarganegaraan:</span> {{ $jemaah->kewarganegaraan }}</li>
                    <li><span class="text-stone-500">Alamat Lengkap:</span> {{ $jemaah->alamat }}</li>
                    <li><span class="text-stone-500">Kelurahan:</span> {{ $jemaah->kelurahan }}</li>
                    <li><span class="text-stone-500">Kecamatan:</span> {{ $jemaah->kecamatan }}</li>
                    <li><span class="text-stone-500">Kabupaten:</span> {{ $jemaah->kabupaten->kabupaten ?? '-' }}</li>
                    <li><span class="text-stone-500">Provinsi:</span> {{ $jemaah->provinsi->provinsi ?? '-' }}</li>
                    <li><span class="text-stone-500">Kode Pos:</span> {{ $jemaah->kode_pos }}</li>
                </ul>
                <ul class="space-y-1.5 text-sm text-stone-700">
                    <li><span class="text-stone-500">Nomor Ponsel:</span> {{ $jemaah->nomor_telepon }}</li>
                    <li><span class="text-stone-500">Email:</span> {{ $jemaah->email }}</li>
                    <li><span class="text-stone-500">Tingkat Pendidikan:</span> {{ $jemaah->tingkat_pendidikan }}</li>
                    <li><span class="text-stone-500">Pekerjaan:</span> {{ $jemaah->pekerjaan }}</li>
                    <li><span class="text-stone-500">Nomor Paspor:</span> {{ $jemaah->nomor_paspor }}</li>
                    <li><span class="text-stone-500">Tempat dikeluarkan:</span> {{ $jemaah->tempat_dikeluarkan }}</li>
                    <li><span class="text-stone-500">Tanggal dikeluarkan:</span> {{ $jemaah->tanggal_dikeluarkan }}</li>
                    <li><span class="text-stone-500">Tanggal Kadaluarsa:</span> {{ $jemaah->tanggal_kadaluarsa }}</li>
                    <li><span class="text-stone-500">Pernah Umroh:</span> {{ $jemaah->pernah_umroh ? 'Pernah' : 'Belum' }}</li>
                    <li><span class="text-stone-500">Pernah Haji:</span> {{ $jemaah->pernah_haji ? 'Pernah' : 'Belum' }}</li>
                    <li><span class="text-stone-500">Golongan Darah:</span> {{ $jemaah->golongan_darah }}</li>
                    <li><span class="text-stone-500">Nama Keluarga Terdekat:</span> {{ $jemaah->nama_keluarga_terdekat }}</li>
                    <li><span class="text-stone-500">Kontak Keluarga Terdekat:</span> {{ $jemaah->kontak_keluarga_terdekat }}</li>
                    <li><span class="text-stone-500">Status:</span> <x-badge :variant="$jemaah->is_active ? 'success' : 'danger'">{{ $jemaah->is_active ? 'Aktif' : 'Tidak Aktif' }}</x-badge></li>
                </ul>
                <div>
                    @if ($jemaah->jenis_kelamin == 'Perempuan' && $jemaah->mahram)
                        @if ($jemaah->mahram ?? null)
                            <ul class="mb-4 space-y-1.5 text-sm text-stone-700">
                                <li><span class="text-stone-500">Nama Mahram:</span> {{ $jemaah->mahram->nama_lengkap }}</li>
                                <li><span class="text-stone-500">Hubungan dengan Mahram:</span> {{ $jemaah->hubungan_mahram }}</li>
                            </ul>
                        @endif
                    @elseif ($jemaah->jenis_kelamin == 'Laki-laki')
                        <h4 class="font-display mb-2 text-sm font-semibold text-maroon-900">Data Mahram / Pasangan</h4>
                        <table class="mb-3 w-full text-left text-sm">
                            <thead class="text-xs uppercase tracking-wide text-stone-500">
                                <tr>
                                    <th class="py-1.5 pr-2">#</th>
                                    <th class="py-1.5 pr-2">Nama Mahram</th>
                                    <th class="py-1.5">Hubungan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-cream-200">
                                @forelse ($jemaah->mahrams as $mahram)
                                    @php
                                        $hubungan = match ($mahram->hubungan_mahram) {
                                            'Ayah' => 'Anak',
                                            'Anak' => 'Ibu',
                                            'Suami' => 'Istri',
                                            'Saudara Kandung' => 'Saudari Kandung',
                                            'Kakek' => 'Cucu',
                                            'Cucu' => 'Nenek',
                                            'Paman' => 'Keponakan',
                                            'Keponakan' => 'Bibi',
                                            default => '',
                                        };
                                    @endphp
                                    <tr>
                                        <td class="py-1.5 pr-2">{{ $loop->iteration }}</td>
                                        <td class="py-1.5 pr-2">{{ $mahram->nama_lengkap }}</td>
                                        <td class="py-1.5">{{ $hubungan }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-1.5 text-stone-500">Mahram Jema'ah belum tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @endif
                    <div class="flex flex-col gap-2">
                        <a href="/admin/pemesanan/{{ $jemaah->pemesanan_id }}" class="inline-flex items-center gap-1.5 rounded-md bg-maroon-50 px-3 py-1.5 text-xs font-medium text-maroon-700 hover:bg-maroon-100"><i class="bx bx-show"></i> Lihat Detail Pemesanan</a>
                        <a href="/admin/grup/{{ $jemaah->grup_id }}" class="inline-flex items-center gap-1.5 rounded-md bg-emerald-50 px-3 py-1.5 text-xs font-medium text-emerald-700 hover:bg-emerald-100"><i class="bx bx-file"></i> Lihat Grup</a>
                    </div>
                </div>
            </div>
        </div>
    </x-card>

    <div class="grid gap-6 md:grid-cols-3">
        <x-card>
            <h4 class="font-display mb-2 text-sm font-semibold text-maroon-900">Testimoni</h4>
            <p class="whitespace-pre-line rounded-lg bg-cream-50 p-3 text-sm text-stone-600">{{ $jemaah->testimoni->isi_testimoni ?? 'Testimoni tidak tersedia' }}</p>
        </x-card>

        <x-card class="md:col-span-2">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="font-display text-sm font-semibold text-maroon-900">Sertifikat</h4>
                <x-button class="!px-3 !py-1.5 !text-xs" :href="'/admin/jemaah/' . $jemaah->id . '/sertifikat/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Nomor Sertifikat</th>
                            <th class="px-3 py-2">Terbit</th>
                            <th class="px-3 py-2">Kadaluarsa</th>
                            <th class="px-3 py-2">Jenis</th>
                            <th class="px-3 py-2">Sertifikat</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @forelse ($jemaah->sertifikatJemaahs as $sertifikat)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $sertifikat->nomor_sertifikat }}</td>
                                <td class="px-3 py-2">{{ Carbon::parse($sertifikat->tanggal_penerbitan)->isoFormat('LL') }}</td>
                                <td class="px-3 py-2">{{ Carbon::parse($sertifikat->tanggal_kadaluarsa)->isoFormat('LL') }}</td>
                                <td class="px-3 py-2">{{ $sertifikat->jenis_sertifikat }}</td>
                                <td class="px-3 py-2"><img src="{{ asset('storage/' . $sertifikat->sertifikat) }}" alt="" class="h-14 w-20 rounded object-cover"></td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2">
                                        <a href="/admin/sertifikat-jemaah/{{ $sertifikat->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/sertifikat-jemaah/' . $sertifikat->id" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-3 py-2 text-stone-500">Sertifikat Jema'ah belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-card class="md:col-span-2">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="font-display text-sm font-semibold text-maroon-900">Berkas Jema'ah</h4>
                <x-button class="!px-3 !py-1.5 !text-xs" :href="'/admin/jemaah/' . $jemaah->id . '/berkas/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Nama Berkas</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @forelse ($jemaah->berkasJemaahs as $berkas)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $berkas->berkas->nama_berkas }}</td>
                                <td class="px-3 py-2">{{ $berkas->status }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <a href="{{ route('admin.jemaah.berkas.preview', [$jemaah->id, $berkas->id]) }}" target="_blank" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat di Storage</a>
                                        <a href="{{ asset('storage/' . $berkas->file_path) }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Berkas</a>
                                        <a href="/admin/berkas-jemaah/{{ $berkas->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/berkas-jemaah/' . $berkas->id" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-2 text-stone-500">Berkas Jema'ah belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-card>
            <div class="mb-3 flex items-center justify-between">
                <h4 class="font-display text-sm font-semibold text-maroon-900">Bus Jema'ah</h4>
                <x-button class="!px-3 !py-1.5 !text-xs" :href="'/admin/jemaah/' . $jemaah->id . '/bus/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Nomor Kursi</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @forelse ($jemaah->busJemaahs as $bus)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $bus->nomor_kursi }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2">
                                        <a href="/admin/bus-jemaah/{{ $bus->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Data Penumpang</a>
                                        <a href="/admin/bus-jemaah/{{ $bus->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/bus-jemaah/' . $bus->id" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 py-2 text-stone-500">Bus Jema'ah belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-card class="md:col-span-3">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="font-display text-sm font-semibold text-maroon-900">Kamar Jema'ah</h4>
                <x-button class="!px-3 !py-1.5 !text-xs" :href="'/admin/jemaah/' . $jemaah->id . '/kamar/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Nomor Kamar</th>
                            <th class="px-3 py-2">Tipe Kamar</th>
                            <th class="px-3 py-2">Kapasitas</th>
                            <th class="px-3 py-2">Kota</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @forelse ($jemaah->KamarJemaahs as $kamar)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $kamar->kamar->nomor_kamar }}</td>
                                <td class="px-3 py-2">{{ $kamar->kamar->tipe_kamar }}</td>
                                <td class="px-3 py-2">{{ $kamar->kamar->kapasitas }}</td>
                                <td class="px-3 py-2">{{ $kamar->kamar->paketHotel->hotel->kota }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2">
                                        <a href="/admin/kamar/{{ $kamar->kamar_id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Anggota Kamar</a>
                                        <a href="/admin/kamar-jemaah/{{ $kamar->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                        <x-delete-form :action="'/admin/kamar-jemaah/' . $kamar->id" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-2 text-stone-500">Kamar Jema'ah belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
@endsection
