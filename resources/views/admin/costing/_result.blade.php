@php
    $rp = fn ($n) => 'Rp'.number_format((float) $n, 0, ',', '.');
    $statusColor = [
        'AMAN' => 'text-emerald-700 bg-emerald-50',
        'AMAN_MINIMUM' => 'text-amber-700 bg-amber-50',
        'DI_BAWAH_LANTAI' => 'text-red-700 bg-red-50',
    ][$p['margin_status']] ?? 'text-stone-700 bg-cream-100';
@endphp

<div class="space-y-5">
    {{-- Warnings --}}
    @foreach ($p['warnings'] as $w)
        <div class="rounded-lg bg-amber-50 px-4 py-2.5 text-sm font-medium text-amber-800">⚠ {{ $w }}</div>
    @endforeach

    {{-- Headline: per-pilgrim AND total departure margin (Addendum 4) --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
            <p class="text-xs uppercase tracking-wide text-stone-500">Biaya Produksi /jemaah</p>
            <p class="mt-1 font-display text-xl font-semibold text-maroon-900">{{ $rp($p['production_per_pilgrim']) }}</p>
            <p class="mt-0.5 text-xs text-stone-500">Beban total {{ $rp($p['burden_per_pilgrim']) }}</p>
        </div>
        <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
            <p class="text-xs uppercase tracking-wide text-stone-500">Margin /jemaah</p>
            <p class="mt-1 font-display text-xl font-semibold text-maroon-900">{{ $rp($p['package_margin']) }}</p>
            <p class="mt-0.5 text-xs text-stone-500">Harapan {{ $rp($p['expected_margin']) }}</p>
        </div>
        <div class="rounded-xl border-2 border-maroon-200 bg-cream-50 p-4">
            <p class="text-xs uppercase tracking-wide text-stone-500">Margin Total Keberangkatan</p>
            <p class="mt-1 font-display text-xl font-semibold text-maroon-900">{{ $rp($p['total_departure_margin']) }}</p>
            <p class="mt-0.5 text-xs text-stone-500">Bantalan sebenarnya ({{ $p['paying_pax'] }} jemaah)</p>
        </div>
        <div class="rounded-xl border border-cream-200 p-4 {{ $statusColor }}">
            <p class="text-xs uppercase tracking-wide opacity-70">Status Margin</p>
            <p class="mt-1 font-display text-lg font-semibold">{{ str_replace('_', ' ', $p['margin_status']) }}</p>
            <p class="mt-0.5 text-xs opacity-80">Jarak ke lantai {{ $rp($p['distance_to_floor']) }}</p>
        </div>
    </div>
    <p class="text-xs text-stone-500">Lantai/target margin: {{ $p['margin_floor_rule'] }}. Aturan gaji staff: {{ $p['staff_salary_rule'] }}.
        @if ($p['quoted_price'])<span class="font-medium text-maroon-800"> · Harga kuotasi: {{ $rp($p['quoted_price']) }}</span>@endif
    </p>

    {{-- Materialisation (block only) --}}
    @if ($p['materialisation'])
        @php $m = $p['materialisation']; @endphp
        <div class="rounded-xl border p-4 {{ $m['breached'] ? 'border-red-300 bg-red-50' : 'border-cream-200 bg-cream-50' }}">
            <p class="text-sm font-semibold {{ $m['breached'] ? 'text-red-700' : 'text-stone-700' }}">
                Materialisasi {{ number_format($m['pct'] * 100, 0) }}% ({{ $m['realised'] }}/{{ $m['seats_booked'] }}, basis {{ $m['basis'] }})
                @if ($m['breached']) — DEPOSIT TIKET HANGUS @endif
            </p>
        </div>
    @endif

    {{-- Occupancy price matrix (block only) --}}
    @if (! empty($p['occupancy_matrix']))
        <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
            <h3 class="mb-2 font-display text-sm font-semibold text-maroon-900">Harga per Okupansi</h3>
            <div class="flex flex-wrap gap-3">
                @foreach ($p['occupancy_matrix'] as $o)
                    <div class="rounded-lg bg-cream-100 px-4 py-2 text-sm">
                        <span class="text-stone-500">{{ $o['label'] }}:</span> <span class="font-semibold text-maroon-900">{{ $rp($o['price']) }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Packaging comparison --}}
    @php $pc = $p['packaging_comparison']; @endphp
    <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
        <h3 class="mb-2 font-display text-sm font-semibold text-maroon-900">Perbandingan Paket (all-in vs terpisah)</h3>
        <div class="grid gap-3 sm:grid-cols-2 text-sm">
            <div>
                <p class="text-stone-500">Harga all-in ekuivalen: <span class="font-semibold text-stone-800">{{ $rp($pc['all_in_equivalent_price']) }}</span></p>
                <p class="text-stone-500">Margin terjamin (paket + all-in): <span class="font-semibold text-stone-800">{{ $rp($pc['guaranteed_margin']) }}</span>
                    <span class="{{ $pc['clears_floor_with_all_in'] ? 'text-emerald-600' : 'text-red-600' }}">{{ $pc['clears_floor_with_all_in'] ? '✓ lolos lantai' : '✗ di bawah' }}</span></p>
            </div>
            <div>
                <p class="text-stone-500">Harga stripped: <span class="font-semibold text-stone-800">{{ $rp($pc['stripped_price']) }}</span></p>
                <p class="text-stone-500">Margin paket saja: <span class="font-semibold text-stone-800">{{ $rp($pc['package_margin']) }}</span>
                    <span class="{{ $pc['clears_floor_on_package_alone'] ? 'text-emerald-600' : 'text-red-600' }}">{{ $pc['clears_floor_on_package_alone'] ? '✓' : '✗' }}</span></p>
            </div>
        </div>
    </div>

    {{-- Budget/promo three-scenario --}}
    @if ($p['scenarios'])
        <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
            <h3 class="mb-2 font-display text-sm font-semibold text-maroon-900">Rentang Skenario (promo — margin bukan angka tunggal)</h3>
            <div class="grid gap-3 sm:grid-cols-3 text-sm">
                @foreach (['pessimistic' => ['Pesimis', 'text-red-700'], 'expected' => ['Ekspektasi', 'text-stone-800'], 'optimistic' => ['Optimis', 'text-emerald-700']] as $k => [$lbl, $cls])
                    <div class="rounded-lg bg-cream-100 px-3 py-2">
                        <p class="text-xs uppercase tracking-wide text-stone-500">{{ $lbl }}</p>
                        <p class="mt-0.5 font-semibold {{ $cls }}">{{ $rp($p['scenarios'][$k]['margin_per_pilgrim']) }}/jemaah</p>
                        <p class="text-xs text-stone-500">Total {{ $rp($p['scenarios'][$k]['total_departure_margin']) }} · tiket {{ $rp($p['scenarios'][$k]['ticket']) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Sensitivity (block only) --}}
    @if (! empty($p['sensitivity']))
        <div class="overflow-x-auto rounded-xl border border-cream-200 bg-cream-50 p-4">
            <h3 class="mb-2 font-display text-sm font-semibold text-maroon-900">Sensitivitas Ukuran Grup</h3>
            <table class="w-full text-left text-sm">
                <thead class="text-xs uppercase tracking-wide text-stone-500">
                    <tr><th class="py-1 pr-4">Pax</th><th class="py-1 pr-4">Materialisasi</th><th class="py-1 pr-4">Margin/jemaah</th><th class="py-1 pr-4">Margin total</th><th class="py-1">Status</th></tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @foreach ($p['sensitivity'] as $s)
                        <tr>
                            <td class="py-1 pr-4 font-medium">{{ $s['pax'] }}</td>
                            <td class="py-1 pr-4">{{ number_format($s['materialisation_pct'] * 100, 0) }}%</td>
                            <td class="py-1 pr-4">{{ $rp($s['margin']) }}</td>
                            <td class="py-1 pr-4">{{ $rp($s['total_departure_margin']) }}</td>
                            <td class="py-1"><span class="rounded px-1.5 py-0.5 text-xs {{ $s['status'] === 'DEPOSIT_HANGUS' ? 'bg-red-100 text-red-700' : ($s['status'] === 'AMAN' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700') }}">{{ str_replace('_', ' ', $s['status']) }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Lines with baseline flag --}}
    <div class="overflow-x-auto rounded-xl border border-cream-200 bg-cream-50 p-4">
        <h3 class="mb-2 font-display text-sm font-semibold text-maroon-900">Komponen Biaya</h3>
        <table class="w-full text-left text-sm">
            <thead class="text-xs uppercase tracking-wide text-stone-500">
                <tr><th class="py-1 pr-4">Komponen</th><th class="py-1 pr-4">/jemaah</th><th class="py-1 pr-4">Total grup</th><th class="py-1">Sumber</th></tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($p['lines'] as $l)
                    <tr class="{{ $l['active'] ? '' : 'opacity-40' }}">
                        <td class="py-1 pr-4 font-medium text-stone-800">{{ $l['nama'] }}
                            @unless ($l['active'])<span class="text-xs text-stone-400">({{ $l['suppressed_reason'] }})</span>@endunless
                        </td>
                        <td class="py-1 pr-4">{{ $rp($l['per_pilgrim']) }}</td>
                        <td class="py-1 pr-4">{{ $rp($l['group_total']) }}</td>
                        <td class="py-1">
                            @if ($l['is_baseline'])
                                <span class="rounded bg-amber-100 px-1.5 py-0.5 text-xs text-amber-700" title="Belum ada tarif kontrak vendor">baseline</span>
                            @elseif ($l['rate_source'] === 'override')
                                <span class="rounded bg-blue-100 px-1.5 py-0.5 text-xs text-blue-700">override</span>
                            @elseif ($l['rate_source'] === 'overhead')
                                <span class="text-xs text-stone-400">overhead</span>
                            @else
                                <span class="rounded bg-emerald-100 px-1.5 py-0.5 text-xs text-emerald-700">kontrak</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
