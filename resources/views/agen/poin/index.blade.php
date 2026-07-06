@extends('agen.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-xl font-bold text-maroon-900">Riwayat Poin</h1>
        <x-badge variant="brand">Total: {{ $totalPoin }} poin</x-badge>
    </div>

    <x-card>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Tipe</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3 text-right">Jumlah Poin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @forelse ($poins as $poin)
                        <tr>
                            <td class="px-4 py-3">{{ Carbon::parse($poin->created_at)->isoFormat('LL') }}</td>
                            <td class="px-4 py-3"><x-badge variant="brand">{{ $poin->tipe }}</x-badge></td>
                            <td class="px-4 py-3">{{ $poin->keterangan ?? '-' }}</td>
                            <td class="px-4 py-3 text-right font-semibold {{ $poin->jumlah_poin >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                                {{ $poin->jumlah_poin >= 0 ? '+' : '' }}{{ $poin->jumlah_poin }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-stone-500">Belum ada riwayat poin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $poins->links() }}</div>
    </x-card>
@endsection
