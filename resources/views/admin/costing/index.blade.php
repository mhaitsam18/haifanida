@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <a href="{{ route('admin.costing.create') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                <i class="bx bx-plus"></i> Costing Baru
            </a>
        </x-slot:actions>
    </x-page-header>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('success') }}</div>
    @endif

    <div class="mb-6 overflow-x-auto rounded-xl border border-cream-200 bg-cream-50 p-4">
        <h3 class="mb-3 font-display text-base font-semibold text-maroon-900">Costing Terbaru</h3>
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr><th class="px-3 py-2">#</th><th class="px-3 py-2">Tier</th><th class="px-3 py-2">Mode</th><th class="px-3 py-2">Pax</th><th class="px-3 py-2">Margin/jemaah</th><th class="px-3 py-2">Status</th><th class="px-3 py-2">Snapshot</th><th class="px-3 py-2"></th></tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @forelse ($costings as $c)
                    <tr>
                        <td class="px-3 py-2 font-medium">{{ $c->id }}</td>
                        <td class="px-3 py-2">{{ $c->package_tier }}</td>
                        <td class="px-3 py-2">{{ $c->procurement_mode }}</td>
                        <td class="px-3 py-2">{{ $c->paying_pax }}</td>
                        <td class="px-3 py-2">Rp{{ number_format($c->package_margin, 0, ',', '.') }}</td>
                        <td class="px-3 py-2">{{ str_replace('_', ' ', (string) $c->margin_status) }}</td>
                        <td class="px-3 py-2"><span class="rounded bg-cream-100 px-1.5 py-0.5 text-xs">{{ $c->status }}</span></td>
                        <td class="px-3 py-2"><a href="{{ route('admin.costing.show', $c->id) }}" class="text-maroon-700 hover:underline">Lihat</a></td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="px-3 py-3 text-center text-stone-400">Belum ada costing.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="overflow-x-auto rounded-xl border border-cream-200 bg-cream-50 p-4">
        <h3 class="mb-3 font-display text-base font-semibold text-maroon-900">Kuotasi Private</h3>
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr><th class="px-3 py-2">Ref</th><th class="px-3 py-2">v</th><th class="px-3 py-2">Pelanggan</th><th class="px-3 py-2">Harga</th><th class="px-3 py-2">Berlaku s/d</th><th class="px-3 py-2">Status</th></tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @forelse ($quotations as $q)
                    <tr class="{{ $q->isExpired() ? 'bg-red-50/40' : '' }}">
                        <td class="px-3 py-2 font-medium">{{ $q->reference }}</td>
                        <td class="px-3 py-2">{{ $q->version }}</td>
                        <td class="px-3 py-2">{{ $q->customer_name ?? '—' }}</td>
                        <td class="px-3 py-2">Rp{{ number_format($q->quoted_price, 0, ',', '.') }}</td>
                        <td class="px-3 py-2">{{ optional($q->valid_until)->format('d M Y') }} @if ($q->isExpired())<span class="text-xs text-red-600">(kadaluarsa)</span>@endif</td>
                        <td class="px-3 py-2"><span class="rounded bg-cream-100 px-1.5 py-0.5 text-xs">{{ $q->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-3 py-3 text-center text-stone-400">Belum ada kuotasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
