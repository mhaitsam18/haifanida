@extends('admin.layouts.app')

@php $rp = fn ($n) => 'Rp'.number_format((float) $n, 0, ',', '.'); @endphp

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <a href="{{ route('admin.costing.index') }}" class="rounded-lg bg-cream-200 px-4 py-2 text-sm font-medium text-stone-700">← Daftar</a>
        </x-slot:actions>
    </x-page-header>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('success') }}</div>
    @endif

    @if ($expiredWarning)
        <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            ⚠ Kuotasi {{ $quote->reference }} sudah kadaluarsa ({{ $quote->valid_until->format('d M Y') }}). Biaya masukan mungkin sudah berubah — hitung ulang sebelum dipakai, jangan pakai angka lama.
        </div>
    @endif

    <div class="mb-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
            <p class="text-xs uppercase tracking-wide text-stone-500">Biaya Produksi /jemaah</p>
            <p class="mt-1 font-display text-xl font-semibold text-maroon-900">{{ $rp($costing->production_per_pilgrim) }}</p>
        </div>
        <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
            <p class="text-xs uppercase tracking-wide text-stone-500">Margin /jemaah</p>
            <p class="mt-1 font-display text-xl font-semibold text-maroon-900">{{ $rp($costing->package_margin) }}</p>
        </div>
        <div class="rounded-xl border-2 border-maroon-200 bg-cream-50 p-4">
            <p class="text-xs uppercase tracking-wide text-stone-500">Margin Total Keberangkatan</p>
            <p class="mt-1 font-display text-xl font-semibold text-maroon-900">{{ $rp($costing->package_margin * $costing->paying_pax) }}</p>
        </div>
        <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
            <p class="text-xs uppercase tracking-wide text-stone-500">Deposit at risk</p>
            <p class="mt-1 font-display text-xl font-semibold {{ $costing->deposit_at_risk ? 'text-red-700' : 'text-stone-400' }}">{{ $costing->deposit_at_risk ? $rp($costing->deposit_at_risk) : '— (non-block)' }}</p>
        </div>
    </div>

    <p class="mb-5 text-xs text-stone-500">
        Tier {{ $costing->package_tier }} · mode {{ $costing->procurement_mode }} · status <strong>{{ $costing->status }}</strong>.
        Lantai margin: {{ $costing->margin_floor_rule }}. Gaji staff: {{ $costing->staff_salary_rule }}.
        Pinned FX v{{ $costing->fx_policy_version_id }} · visa ruleset {{ $costing->visa_coverage_ruleset_id }}.
    </p>

    <div class="mb-6 overflow-x-auto rounded-xl border border-cream-200 bg-cream-50 p-4">
        <h3 class="mb-2 font-display text-sm font-semibold text-maroon-900">Komponen (versi tarif ter-pin)</h3>
        <table class="w-full text-left text-sm">
            <thead class="text-xs uppercase tracking-wide text-stone-500">
                <tr><th class="py-1 pr-4">Komponen</th><th class="py-1 pr-4">/jemaah</th><th class="py-1 pr-4">Total grup</th><th class="py-1">Sumber</th></tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($costing->lines as $l)
                    <tr class="{{ $l->active ? '' : 'opacity-40' }}">
                        <td class="py-1 pr-4 font-medium text-stone-800">{{ $l->nama }}</td>
                        <td class="py-1 pr-4">{{ $rp($l->per_pilgrim) }}</td>
                        <td class="py-1 pr-4">{{ $rp($l->group_total) }}</td>
                        <td class="py-1">
                            @if ($l->is_baseline)<span class="rounded bg-amber-100 px-1.5 py-0.5 text-xs text-amber-700">baseline</span>
                            @else<span class="text-xs text-stone-500">{{ $l->rate_source }}</span>@endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($costing->publishedPrices->count())
        <div class="mb-6 rounded-xl border border-cream-200 bg-cream-50 p-4">
            <h3 class="mb-2 font-display text-sm font-semibold text-maroon-900">Harga per Okupansi</h3>
            <div class="flex flex-wrap gap-3">
                @foreach ($costing->publishedPrices as $pp)
                    <div class="rounded-lg bg-cream-100 px-4 py-2 text-sm"><span class="text-stone-500">{{ $pp->label }}:</span> <span class="font-semibold text-maroon-900">{{ $rp($pp->price) }}</span></div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
