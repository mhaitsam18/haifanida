@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        use Illuminate\Support\Str;
    @endphp

    <section class="py-10">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="font-display text-2xl font-semibold text-maroon-900">Berkas Jemaah</h2>
                    <p class="mt-1 font-medium text-maroon-700">{{ $jemaah->nama_lengkap }}</p>
                </div>
                <div class="flex gap-2">
                    <x-button :href="route('pemesanan.jemaah.add-berkas', [$pemesanan->id, $jemaah->id])">
                        <i class="bx bx-plus-circle"></i> Tambah Berkas
                    </x-button>
                    <x-button variant="secondary" :href="route('pemesanan.jemaah.list', $pemesanan->id)">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </x-button>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
            @endif

            <div class="rounded-2xl border border-cream-200 bg-cream-50 shadow-sm">
                <div class="flex items-center justify-between border-b border-cream-200 p-4">
                    <h4 class="font-medium text-stone-700">Daftar Berkas</h4>
                    <x-badge variant="info">Total: {{ $berkasJemaahs->count() }} berkas</x-badge>
                </div>

                @if ($berkasJemaahs->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Nama Berkas</th>
                                    <th class="px-4 py-3">File</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Tanggal Upload</th>
                                    <th class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-cream-200">
                                @foreach ($berkasJemaahs as $berkasJemaah)
                                    <tr>
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-stone-800">{{ $berkasJemaah->berkas->nama_berkas }}</div>
                                            @if ($berkasJemaah->berkas->keterangan)
                                                <div class="text-xs text-stone-500">{{ $berkasJemaah->berkas->keterangan }}</div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($berkasJemaah->file_path)
                                                @php
                                                    $fileExtension = pathinfo($berkasJemaah->file_path, PATHINFO_EXTENSION);
                                                    $fileName = basename($berkasJemaah->file_path);
                                                @endphp
                                                <div class="mb-1.5 flex items-center gap-2">
                                                    <i class="bx {{ strtolower($fileExtension) == 'pdf' ? 'bxs-file-pdf text-red-600' : 'bxs-file text-stone-500' }} text-2xl"></i>
                                                    <div>
                                                        <div class="text-xs font-semibold">{{ strtoupper($fileExtension) }} File</div>
                                                        <div class="text-xs text-stone-500">{{ Str::limit($fileName, 20) }}</div>
                                                    </div>
                                                </div>
                                                <a href="{{ route('pemesanan.jemaah.berkas.preview', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" target="_blank"
                                                    class="inline-flex items-center gap-1 rounded-lg border border-cream-300 px-2.5 py-1 text-xs font-medium text-stone-700 hover:bg-cream-100">
                                                    <i class="bx bx-show"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-xs text-stone-400">Belum ada file</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($berkasJemaah->status == 'diverifikasi')
                                                <x-badge variant="success">Diverifikasi</x-badge>
                                            @elseif ($berkasJemaah->status == 'ditolak')
                                                <x-badge variant="danger">Ditolak</x-badge>
                                                @if ($berkasJemaah->catatan)
                                                    <div class="mt-1 text-xs text-red-600">{{ $berkasJemaah->catatan }}</div>
                                                @endif
                                            @else
                                                <x-badge variant="warning">Tertunda</x-badge>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-xs text-stone-500">
                                            {{ Carbon::parse($berkasJemaah->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex gap-2">
                                                @if ($berkasJemaah->status != 'diverifikasi')
                                                    <x-button variant="secondary" :href="route('pemesanan.jemaah.berkas.edit', [$pemesanan->id, $jemaah->id, $berkasJemaah->id])" class="px-3! py-1.5! text-xs">
                                                        <i class="bx bx-edit"></i> Edit
                                                    </x-button>
                                                @endif
                                                <x-delete-form :action="route('pemesanan.jemaah.berkas.destroy', [$pemesanan->id, $jemaah->id, $berkasJemaah->id])"
                                                    label="Apakah Anda yakin ingin menghapus berkas ini? Tindakan ini tidak dapat dibatalkan."
                                                    @if ($berkasJemaah->status == 'diverifikasi') disabled @endif />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-16 text-center text-stone-500">
                        <i class="bx bx-folder-open text-3xl"></i>
                        <h5 class="mt-2 font-medium">Belum ada berkas yang diupload</h5>
                        <p class="mt-1 text-sm">Silahkan upload berkas yang diperlukan untuk melengkapi pendaftaran Anda.</p>
                        <x-button :href="route('pemesanan.jemaah.add-berkas', [$pemesanan->id, $jemaah->id])" class="mt-4">
                            <i class="bx bx-plus-circle"></i> Upload Berkas Pertama
                        </x-button>
                    </div>
                @endif
            </div>

            <div class="mt-6 rounded-xl border border-sky-200 bg-sky-50 p-4 text-sm text-sky-800">
                <h4 class="mb-1.5 font-semibold"><i class="bx bx-info-circle"></i> Status Berkas</h4>
                <ul class="list-disc space-y-1 pl-5">
                    <li><strong>Tertunda:</strong> Berkas sedang menunggu verifikasi</li>
                    <li><strong>Diverifikasi:</strong> Berkas telah diverifikasi dan diterima</li>
                    <li><strong>Ditolak:</strong> Berkas tidak memenuhi kriteria</li>
                </ul>
            </div>
        </div>
    </section>
@endsection
