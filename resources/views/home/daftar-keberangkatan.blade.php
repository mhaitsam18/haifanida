@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <section class="py-12">
        <div class="mx-auto max-w-4xl px-4">
            <div class="mb-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Daftar Keberangkatan</h2>
                <p class="mt-1 text-sm text-stone-500">Daftar perjalanan yang akan datang</p>
            </div>

            @if ($pemesanan && count($pemesanan) > 0)
                <div class="mb-6 rounded-xl border border-sky-200 bg-sky-50 p-4 text-sm text-sky-800">
                    <div class="flex gap-2">
                        <i class="bx bx-info-circle mt-0.5 text-lg"></i>
                        <div>
                            <h4 class="mb-1.5 font-semibold">Informasi Status Pemesanan</h4>
                            <ul class="list-disc space-y-1 pl-4">
                                <li><strong>Tertunda:</strong> Pesanan Anda sedang menunggu konfirmasi dari admin.</li>
                                <li><strong>Diterima/Dikonfirmasi:</strong> Pesanan Anda telah disetujui. Anda dapat melanjutkan untuk melengkapi data jemaah.</li>
                                <li><strong>Ditolak/Dibatalkan:</strong> Pesanan Anda ditolak atau dibatalkan. Silakan hubungi admin untuk informasi lebih lanjut.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    @foreach ($pemesanan as $item)
                        @php
                            $departure = Carbon::parse($item->paket->tanggal_mulai);
                            $returnDate = Carbon::parse($item->paket->tanggal_selesai);
                            $sisa_hari = Carbon::now()->diffInDays($departure, false);
                            $isTripExpired = Carbon::now()->greaterThan($returnDate->copy()->addDay());
                            $hasIncompleteDocuments = $item->jemaahs->some(function ($jemaah) use ($requiredBerkas) {
                                $uploadedBerkasIds = $jemaah->berkasJemaahs->pluck('berkas_id')->toArray();
                                $requiredBerkasIds = $requiredBerkas->pluck('id')->toArray();
                                $missingBerkas = array_diff($requiredBerkasIds, $uploadedBerkasIds);
                                return !empty($missingBerkas) || $jemaah->berkasJemaahs->some(function ($berkas) {
                                    return $berkas->status != 'diverifikasi' || is_null($berkas->file_path);
                                });
                            });

                            $statusVariant = match (true) {
                                $item->status == 'Tertunda' => 'neutral',
                                in_array($item->status, ['diterima', 'dikonfirmasi']) => 'success',
                                in_array($item->status, ['ditolak', 'dibatalkan']) => 'danger',
                                default => 'neutral',
                            };
                        @endphp

                        @if (!$isTripExpired)
                            <x-card>
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <h3 class="font-display text-lg font-semibold text-maroon-900">{{ $item->paket->nama_paket }}</h3>
                                    <div class="flex gap-2">
                                        <x-badge :variant="$statusVariant">{{ ucfirst($item->status) }}</x-badge>
                                        <x-badge variant="brand">Akan Datang</x-badge>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-col gap-4 sm:flex-row">
                                    <img src="{{ $item->paket->gambar ? asset('storage/' . $item->paket->gambar) : asset('storage/paket-gambar/default.jpg') }}"
                                        alt="{{ $item->paket->nama_paket }}" class="h-40 w-full shrink-0 rounded-xl object-cover sm:w-56">
                                    <div>
                                        @if ($sisa_hari > 0)
                                            <h4 class="text-sm font-semibold text-emerald-700">Berangkat {{ $sisa_hari }} hari lagi</h4>
                                        @elseif ($sisa_hari === 0)
                                            <h4 class="text-sm font-semibold text-amber-600">Berangkat hari ini</h4>
                                        @endif

                                        <p class="mt-2 text-sm font-medium text-stone-700">
                                            Tanggal Perjalanan: {{ Carbon::parse($item->paket->tanggal_mulai)->format('d M Y') }} &ndash; {{ Carbon::parse($item->paket->tanggal_selesai)->format('d M Y') }}
                                        </p>

                                        <div class="mt-3 grid gap-1.5 text-sm text-stone-600 sm:grid-cols-2">
                                            <p class="flex items-center gap-2"><i class="bx bx-group text-maroon-700"></i> Jumlah Orang: {{ $item->jumlah_orang }} Orang</p>
                                            <p class="flex items-center gap-2"><i class="bx bx-briefcase text-maroon-700"></i> Jenis: {{ ucfirst($item->paket->jenis_paket) }}</p>
                                            <p class="flex items-center gap-2"><i class="bx bxs-plane-take-off text-maroon-700"></i> Keberangkatan: {{ ucfirst($item->paket->tempat_keberangkatan) }}</p>
                                            <p class="flex items-center gap-2"><i class="bx bxs-plane-land text-maroon-700"></i> Kepulangan: {{ ucfirst($item->paket->tempat_kepulangan) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <h4 class="mb-3 flex items-center gap-2 text-sm font-semibold text-maroon-900">
                                        <i class="bx bx-folder-open"></i> Status Berkas Jemaah
                                    </h4>
                                    <div class="overflow-x-auto rounded-xl border border-cream-200">
                                        <table class="w-full text-left text-sm">
                                            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                                                <tr>
                                                    <th class="px-4 py-2.5">#</th>
                                                    <th class="px-4 py-2.5">Nama Jemaah</th>
                                                    <th class="px-4 py-2.5">Berkas</th>
                                                    <th class="px-4 py-2.5">Status</th>
                                                    <th class="px-4 py-2.5">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-cream-200">
                                                @foreach ($item->jemaahs as $jemaah)
                                                    @php
                                                        $uploadedBerkasIds = $jemaah->berkasJemaahs->pluck('berkas_id')->toArray();
                                                        $requiredBerkasIds = $requiredBerkas->pluck('id')->toArray();
                                                        $missingBerkas = array_diff($requiredBerkasIds, $uploadedBerkasIds);
                                                        $allUploaded = empty($missingBerkas);
                                                        $allVerified = $allUploaded && $jemaah->berkasJemaahs->every(function ($berkas) {
                                                            return $berkas->status == 'diverifikasi' && !is_null($berkas->file_path);
                                                        });
                                                        $hasPendingOrRejected = $jemaah->berkasJemaahs->some(function ($berkas) {
                                                            return in_array($berkas->status, ['tertunda', 'ditolak']) || is_null($berkas->file_path);
                                                        });
                                                    @endphp
                                                    <tr>
                                                        <td class="px-4 py-2.5">{{ $loop->iteration }}</td>
                                                        <td class="px-4 py-2.5">{{ $jemaah->nama_lengkap }}</td>
                                                        <td class="px-4 py-2.5 text-stone-600">
                                                            @if ($allUploaded)
                                                                Semua berkas telah diupload
                                                            @else
                                                                {{ count($uploadedBerkasIds) }} dari {{ count($requiredBerkas) }} berkas diupload
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-2.5">
                                                            @if (!$jemaah->berkasJemaahs->count())
                                                                <x-badge variant="danger">Belum ada berkas</x-badge>
                                                            @elseif ($allVerified)
                                                                <x-badge variant="success">Semua diverifikasi</x-badge>
                                                            @elseif ($hasPendingOrRejected)
                                                                <x-badge variant="warning">Ada berkas tertunda/ditolak</x-badge>
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-2.5">
                                                            @if (!$allUploaded)
                                                                <x-button :href="route('pemesanan.jemaah.add-berkas', [$item->id, $jemaah->id])" class="px-3! py-1.5! text-xs">
                                                                    <i class="bx bx-upload"></i> Upload Berkas
                                                                </x-button>
                                                            @elseif ($hasPendingOrRejected)
                                                                <x-button variant="secondary" :href="route('pemesanan.jemaah.list', $item->id)" class="px-3! py-1.5! text-xs">
                                                                    <i class="bx bx-edit"></i> Perbaiki Berkas
                                                                </x-button>
                                                            @else
                                                                <span class="flex items-center gap-1 text-emerald-700"><i class="bx bx-check-circle"></i> Lengkap</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-wrap items-center justify-between gap-3">
                                    @if ($item->is_pembayaran_lunas == 0 || $hasIncompleteDocuments)
                                        <div class="space-y-1 text-sm">
                                            @if ($item->is_pembayaran_lunas == 0)
                                                <p class="flex items-center gap-1.5 text-red-700"><i class="bx bx-error-circle"></i> Terdapat tagihan yang belum dilunasi</p>
                                            @endif
                                            @if ($hasIncompleteDocuments)
                                                <p class="flex items-center gap-1.5 text-amber-600"><i class="bx bx-file"></i> Terdapat berkas yang belum diverifikasi atau belum lengkap</p>
                                            @endif
                                        </div>
                                        <div class="ml-auto flex gap-2">
                                            @if ($item->is_pembayaran_lunas == 0)
                                                <x-button variant="secondary" :href="route('pembayaran.create', $item->id)" class="bg-emerald-100! text-emerald-800! hover:bg-emerald-200!">
                                                    <i class="bx bx-credit-card"></i> Bayar
                                                </x-button>
                                            @endif
                                            <x-button :href="route('pemesanan.detail', $item->id)">
                                                <i class="bx bx-info-circle"></i> Detail
                                            </x-button>
                                        </div>
                                    @else
                                        <p class="flex items-center gap-1.5 text-sm text-emerald-700"><i class="bx bx-check-circle"></i> Pembayaran dan berkas lengkap</p>
                                        <x-button :href="route('pemesanan.detail', $item->id)">
                                            <i class="bx bx-info-circle"></i> Detail
                                        </x-button>
                                    @endif
                                </div>
                            </x-card>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border border-cream-200 bg-cream-50 p-10 text-center">
                    <i class="bx bx-info-circle text-3xl text-maroon-700"></i>
                    <h4 class="font-display mt-2 text-lg font-semibold text-maroon-900">Belum ada perjalanan yang dijadwalkan</h4>
                    <p class="mt-1 text-sm text-stone-500">Anda belum memiliki perjalanan yang akan datang. Silakan pesan perjalanan baru.</p>
                    <x-button :href="route('umroh.index')" class="mt-4">
                        <i class="bx bx-search"></i> Cari Paket Perjalanan
                    </x-button>
                </div>
            @endif
        </div>
    </section>
@endsection
