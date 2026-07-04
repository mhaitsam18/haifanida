@extends('layouts.app')

@section('content')
    <section class="py-10" x-data="{ tab: 'data' }">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="font-display text-2xl font-semibold text-maroon-900">Detail Jemaah</h2>
                    <p class="mt-1 text-sm text-stone-500">Informasi lengkap jemaah keberangkatan</p>
                </div>
                <div class="flex gap-2">
                    <x-button href="#"><i class="bx bx-edit"></i> Edit Data</x-button>
                    <x-button variant="secondary" href="#"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                </div>
            </div>

            <div class="rounded-2xl border border-cream-200 bg-cream-50 shadow-sm">
                <div class="flex flex-wrap gap-1 border-b border-cream-200 p-2">
                    @foreach ([
                        ['key' => 'data', 'icon' => 'bx-user', 'label' => 'Data Pribadi'],
                        ['key' => 'berkas', 'icon' => 'bx-file', 'label' => 'Berkas Jemaah'],
                        ['key' => 'bus', 'icon' => 'bx-bus', 'label' => 'Bus Jemaah'],
                        ['key' => 'kamar', 'icon' => 'bx-hotel', 'label' => 'Kamar Jemaah'],
                        ['key' => 'sertifikat', 'icon' => 'bx-certification', 'label' => 'Sertifikat'],
                    ] as $t)
                        <button type="button" @click="tab = '{{ $t['key'] }}'"
                            :class="tab === '{{ $t['key'] }}' ? 'bg-maroon-700 text-cream-50' : 'text-stone-600 hover:bg-cream-100'"
                            class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium transition">
                            <i class="bx {{ $t['icon'] }}"></i> {{ $t['label'] }}
                        </button>
                    @endforeach
                </div>

                <div class="p-6">
                    <div x-show="tab === 'data'">
                        <div class="grid gap-6 md:grid-cols-4">
                            <div class="text-center">
                                <img src="{{ asset('storage/jemaah-foto/pas-foto.jpg') }}" alt="Foto Jemaah" class="mx-auto h-36 w-36 rounded-full border border-cream-200 object-cover">
                                <h4 class="font-display mt-3 font-semibold text-maroon-900">Budi Santoso</h4>
                                <p class="text-xs text-stone-500">ID: JM-001</p>
                            </div>
                            <div class="md:col-span-3 space-y-8">
                                <div>
                                    <h5 class="mb-3 flex items-center gap-2 border-b border-cream-200 pb-2 font-semibold text-maroon-800">
                                        <i class="bx bx-id-card"></i> Informasi Pribadi
                                    </h5>
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        @foreach ([
                                            'Nama Lengkap (Sesuai KTP)' => 'Budi Santoso', 'Email' => 'budi3@gmail.com',
                                            'Nomor Ponsel' => '+6282117', 'Nomor KTP' => '3272021505800001',
                                            'Nomor Sesuai Paspor' => 'AB12345678', 'Kota Tempat Lahir' => 'Jakarta',
                                            'Tanggal Lahir' => '15 Mei 1980', 'Jenis Kelamin' => 'Laki-laki',
                                            'Golongan Darah' => 'O', 'Kewarganegaraan' => 'Indonesia',
                                        ] as $label => $value)
                                            <div>
                                                <div class="text-xs text-stone-400">{{ $label }}</div>
                                                <div class="border-b border-cream-200 pb-1 text-sm font-medium text-stone-800">{{ $value }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-3 flex items-center gap-2 border-b border-cream-200 pb-2 font-semibold text-maroon-800">
                                        <i class="bx bx-map"></i> Alamat
                                    </h5>
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        @foreach ([
                                            'Provinsi' => 'DKI Jakarta', 'Kabupaten' => 'Jakarta Pusat',
                                            'Kecamatan' => 'Menteng', 'Desa/Kelurahan' => 'Kebon Sirih', 'Kode Pos' => '10340',
                                        ] as $label => $value)
                                            <div>
                                                <div class="text-xs text-stone-400">{{ $label }}</div>
                                                <div class="border-b border-cream-200 pb-1 text-sm font-medium text-stone-800">{{ $value }}</div>
                                            </div>
                                        @endforeach
                                        <div class="sm:col-span-2">
                                            <div class="text-xs text-stone-400">Detail Alamat</div>
                                            <div class="border-b border-cream-200 pb-1 text-sm font-medium text-stone-800">Jl. Kebon Sirih No. 45, RT 05/RW 08</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-3 flex items-center gap-2 border-b border-cream-200 pb-2 font-semibold text-maroon-800">
                                        <i class="bx bx-info-circle"></i> Informasi Tambahan
                                    </h5>
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        @foreach (['Tingkat Pendidikan' => 'Sarjana (S1)', 'Pekerjaan' => 'Wiraswasta'] as $label => $value)
                                            <div>
                                                <div class="text-xs text-stone-400">{{ $label }}</div>
                                                <div class="border-b border-cream-200 pb-1 text-sm font-medium text-stone-800">{{ $value }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-3 flex items-center gap-2 border-b border-cream-200 pb-2 font-semibold text-maroon-800">
                                        <i class="bx bx-id-card"></i> Informasi Paspor
                                    </h5>
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        @foreach ([
                                            'Nomor Paspor' => 'AB12345678', 'Tempat Dikeluarkan' => 'Jakarta',
                                            'Tanggal Dikeluarkan' => '10 Januari 2023', 'Tanggal Kadaluarsa' => '10 Januari 2028',
                                        ] as $label => $value)
                                            <div>
                                                <div class="text-xs text-stone-400">{{ $label }}</div>
                                                <div class="border-b border-cream-200 pb-1 text-sm font-medium text-stone-800">{{ $value }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-3 flex items-center gap-2 border-b border-cream-200 pb-2 font-semibold text-maroon-800">
                                        <i class="bx bx-phone"></i> Kontak Darurat
                                    </h5>
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        @foreach (['Nama Keluarga Terdekat' => 'Siti Rahayu', 'Kontak Keluarga Terdekat' => '+628138456789'] as $label => $value)
                                            <div>
                                                <div class="text-xs text-stone-400">{{ $label }}</div>
                                                <div class="border-b border-cream-200 pb-1 text-sm font-medium text-stone-800">{{ $value }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-show="tab === 'berkas'" x-cloak>
                        <div class="mb-4 flex items-center justify-between">
                            <h5 class="font-semibold text-stone-700">Dokumen Persyaratan Jemaah</h5>
                            <x-button href="#" class="px-3! py-1.5! text-xs"><i class="bx bx-plus-circle"></i> Tambah Berkas</x-button>
                        </div>
                        <div class="overflow-x-auto rounded-xl border border-cream-200">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                                    <tr>
                                        <th class="px-4 py-3">#</th>
                                        <th class="px-4 py-3">Nama Berkas</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Tanggal Upload</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-cream-200">
                                    @foreach ([
                                        ['Scan KTP', '20 Jan 2024'], ['Scan Paspor', '20 Jan 2024'],
                                        ['Pas Foto Background Putih', '20 Jan 2024'], ['Bukti Vaksin COVID-19', '21 Jan 2024'],
                                    ] as $i => $berkas)
                                        <tr>
                                            <td class="px-4 py-3">{{ $i + 1 }}</td>
                                            <td class="px-4 py-3">{{ $berkas[0] }}</td>
                                            <td class="px-4 py-3"><x-badge variant="warning">Tertunda</x-badge></td>
                                            <td class="px-4 py-3 text-stone-500">{{ $berkas[1] }}</td>
                                            <td class="px-4 py-3">
                                                <div class="flex gap-2">
                                                    <a href="#" class="text-xs font-medium text-sky-700 hover:underline">Detail</a>
                                                    <a href="#" class="text-xs font-medium text-emerald-700 hover:underline">Edit</a>
                                                    <button class="text-xs font-medium text-red-700 hover:underline">Hapus</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div x-show="tab === 'bus'" x-cloak class="py-10 text-center text-stone-500">
                        <i class="bx bx-bus text-4xl"></i>
                        <h5 class="mt-3 font-medium text-stone-700">Informasi Bus Jemaah</h5>
                        <p class="mt-1 text-sm">Informasi penempatan bus belum tersedia.<br>Menunggu penempatan dari admin.</p>
                    </div>

                    <div x-show="tab === 'kamar'" x-cloak class="py-10 text-center text-stone-500">
                        <i class="bx bx-hotel text-4xl"></i>
                        <h5 class="mt-3 font-medium text-stone-700">Informasi Kamar Jemaah</h5>
                        <p class="mt-1 text-sm">Informasi penempatan kamar belum tersedia.<br>Menunggu penempatan dari admin.</p>
                    </div>

                    <div x-show="tab === 'sertifikat'" x-cloak class="py-10 text-center text-stone-500">
                        <i class="bx bx-certification text-4xl"></i>
                        <h5 class="mt-3 font-medium text-stone-700">Sertifikat Umroh</h5>
                        <p class="mt-1 text-sm">Sertifikat umroh belum tersedia.<br>Sertifikat akan tersedia setelah jemaah menyelesaikan ibadah umroh.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
