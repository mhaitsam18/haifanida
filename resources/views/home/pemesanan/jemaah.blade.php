@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        $jumlahJemaahTerdaftar = $jemaahs->count();
        $batasJemaah = $pemesanan->jumlah_orang;
        $sisaSlot = $batasJemaah - $jumlahJemaahTerdaftar;
        $sudahPenuh = $sisaSlot <= 0;
    @endphp

    <section class="py-10">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="font-display text-2xl font-semibold text-maroon-900">Data Jemaah</h2>
                    <p class="mt-1 flex items-center gap-2 text-sm text-stone-500">
                        <i class="bx bx-group"></i> {{ $jumlahJemaahTerdaftar }} dari {{ $batasJemaah }} jemaah terdaftar
                        @if ($sisaSlot > 0)
                            <x-badge variant="success">{{ $sisaSlot }} slot tersisa</x-badge>
                        @else
                            <x-badge variant="danger">Slot penuh</x-badge>
                        @endif
                    </p>
                </div>
                <div class="flex gap-2">
                    @if (!$sudahPenuh)
                        <x-button :href="route('pemesanan.jemaah.create', $pemesanan->id)">
                            <i class="bx bx-plus-circle"></i> Tambah
                        </x-button>
                    @else
                        <button class="cursor-not-allowed rounded-lg bg-stone-200 px-4 py-2 text-sm font-semibold text-stone-500" disabled>
                            <i class="bx bx-plus-circle"></i> Slot Penuh
                        </button>
                    @endif
                    <x-button variant="secondary" :href="route('pemesanan.detail', $pemesanan->id)">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </x-button>
                </div>
            </div>

            @if ($sisaSlot <= 2 && $sisaSlot > 0)
                <div class="mb-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                    <i class="bx bx-info-circle"></i> <strong>Pengingat:</strong> Tersisa {{ $sisaSlot }} slot jemaah lagi yang belum ditambahkan.
                </div>
            @elseif ($sudahPenuh)
                <div class="mb-6 rounded-xl border border-sky-200 bg-sky-50 p-4 text-sm text-sky-800">
                    <i class="bx bx-info-circle"></i> <strong>Informasi:</strong> Semua slot jemaah sudah terisi penuh ({{ $batasJemaah }} jemaah).
                </div>
            @endif

            <div class="rounded-2xl border border-cream-200 bg-cream-50 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-cream-200 p-4">
                    <h4 class="font-medium text-stone-700">Data Jemaah Keberangkatan {{ $paket->nama_paket }}</h4>
                    <div class="w-40">
                        <div class="h-2 rounded-full bg-cream-200">
                            <div class="h-2 rounded-full bg-maroon-700" style="width: {{ ($jumlahJemaahTerdaftar / $batasJemaah) * 100 }}%"></div>
                        </div>
                        <small class="text-xs text-stone-500">{{ number_format(($jumlahJemaahTerdaftar / $batasJemaah) * 100, 1) }}% terisi</small>
                    </div>
                </div>

                @if ($jemaahs->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Nama Lengkap</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Nomor Ponsel</th>
                                    <th class="px-4 py-3">Foto</th>
                                    <th class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-cream-200">
                                @foreach ($jemaahs as $jemaah)
                                    <tr>
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 font-medium text-maroon-800">
                                            {{ $jemaah->nama_lengkap }}
                                            @if ($jemaah->is_pemesan)
                                                <x-badge variant="info">Pemesan</x-badge>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-stone-600">{{ $jemaah->email }}</td>
                                        <td class="px-4 py-3 text-stone-600">{{ $jemaah->nomor_telepon }}</td>
                                        <td class="px-4 py-3">
                                            @if ($jemaah->foto)
                                                <img src="{{ asset('storage/' . $jemaah->foto) }}" alt="Foto" class="h-16 w-16 rounded-lg object-cover">
                                            @else
                                                <span class="text-xs text-stone-400">Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex flex-wrap gap-2">
                                                <x-button :href="route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id])" class="bg-emerald-700! px-3! py-1.5! text-xs hover:bg-emerald-800!">
                                                    <i class="bx bx-folder"></i> Berkas
                                                </x-button>
                                                <x-button :href="route('pemesanan.jemaah.edit', [$pemesanan->id, $jemaah->id])" class="bg-amber-600! px-3! py-1.5! text-xs hover:bg-amber-700!">
                                                    <i class="bx bx-edit"></i> Edit
                                                </x-button>
                                                <x-delete-form :action="route('jemaah.destroy-2', $jemaah->id)" label="Apakah Anda yakin ingin menghapus data jemaah ini? Slot akan tersedia kembali setelah dihapus." />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-16 text-center text-stone-500">
                        <i class="bx bx-group text-3xl"></i>
                        <h5 class="mt-2 font-medium">Belum ada jemaah yang terdaftar</h5>
                        <p class="mt-1 text-sm">Silakan tambahkan data jemaah untuk paket {{ $paket->nama_paket }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
