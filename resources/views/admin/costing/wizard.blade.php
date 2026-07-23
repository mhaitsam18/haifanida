@extends('admin.layouts.app')

@php
    $val = fn ($k, $d = null) => $input[$k] ?? $d;
    $mode = $val('procurement_mode', 'block');
    $tier = $val('package_tier', 'standard');
@endphp

@section('content')
    <x-page-header :title="$title" />

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('success') }}</div>
    @endif

    <form method="post" x-data="{ mode: '{{ $mode }}', tier: '{{ $tier }}', step: 1 }">
        @csrf

        {{-- Step nav --}}
        <div class="mb-5 flex flex-wrap gap-2 text-sm">
            <template x-for="(label, i) in ['Profil', mode === 'block' ? 'Risiko & Opsi' : 'Konfigurasi Privat', 'Produk Tambahan', 'Hasil']" :key="i">
                <button type="button" @click="step = i + 1"
                    class="rounded-lg px-3 py-1.5 font-medium"
                    :class="step === i + 1 ? 'bg-maroon-700 text-cream-50' : 'bg-cream-100 text-stone-600 hover:bg-cream-200'"
                    x-text="(i + 1) + '. ' + label"></button>
            </template>
        </div>

        {{-- Step 1 — profile --}}
        <div x-show="step === 1" class="space-y-4 rounded-xl border border-cream-200 bg-cream-50 p-5">
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Mode Pengadaan</label>
                    <select name="procurement_mode" x-model="mode" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm">
                        <option value="block">Block — kursi dibeli di muka (publish)</option>
                        <option value="on_demand">On-demand — FIT, beli atas pesanan (private/kuotasi)</option>
                    </select>
                    <p class="mt-1 text-xs text-stone-500" x-show="mode === 'on_demand'">Private: tanpa seat block, tanpa panel materialisasi.</p>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Tier Paket</label>
                    <select name="package_tier" x-model="tier" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm">
                        @foreach ($tiers as $t)
                            <option value="{{ $t->key }}">{{ $t->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Tanggal Costing</label>
                    <input type="date" name="costing_date" value="{{ $val('costing_date', now()->toDateString()) }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Jemaah berbayar</label>
                    <input type="number" name="paying_pax" value="{{ $val('paying_pax', 35) }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Kursi gratis</label>
                    <input type="number" name="free_seats" value="{{ $val('free_seats', 0) }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Okupansi (quad=4)</label>
                    <input type="number" name="occupancy" value="{{ $val('occupancy', 4) }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Malam Madinah</label>
                    <input type="number" name="night_madinah" value="{{ $val('night_madinah', 4) }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Malam Makkah</label>
                    <input type="number" name="night_makkah" value="{{ $val('night_makkah', 4) }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Hari darat Saudi (mutawwif)</label>
                    <input type="number" name="saudi_ground_days" value="{{ $val('saudi_ground_days', 8) }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
                <div x-show="mode === 'block'">
                    <label class="mb-1 block text-sm font-medium text-stone-700">Harga Publish</label>
                    <input type="number" name="publish_price" value="{{ $val('publish_price', 39500000) }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
                <div x-show="mode === 'on_demand'">
                    <label class="mb-1 block text-sm font-medium text-stone-700">Nama Pelanggan</label>
                    <input type="text" name="customer_name" value="{{ $val('customer_name') }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
            </div>
        </div>

        {{-- Step 2 — block risk / private config (reshaped by mode) --}}
        <div x-show="step === 2" class="space-y-4 rounded-xl border border-cream-200 bg-cream-50 p-5">
            <div x-show="mode === 'block'" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Kursi di-block</label>
                    <input type="number" name="seats_booked" value="{{ $val('seats_booked', 35) }}" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-stone-700">Basis Materialisasi</label>
                    <select name="materialisation_basis" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm">
                        @foreach (['booked' => 'Seats booked', 'paid' => 'Seats paid', 'flown' => 'Seats flown'] as $k => $lbl)
                            <option value="{{ $k }}" @selected($val('materialisation_basis', 'booked') === $k)>{{ $lbl }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-stone-500">Default konservatif; sesuaikan ke term kontrak vendor.</p>
                </div>
            </div>
            <div x-show="mode === 'on_demand'" class="rounded-lg bg-cream-100 px-4 py-3 text-sm text-stone-600">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="tl_opt_in" value="1" @checked($val('tl_opt_in')) class="rounded border-cream-300" />
                    Sertakan Tour Leader (default privat: tidak — dipimpin kepala keluarga). Mutawwif tetap ada.
                </label>
            </div>

            <div class="grid gap-3 sm:grid-cols-3 pt-2">
                <label class="flex items-center gap-2 text-sm text-stone-700"><input type="checkbox" name="transit_villa" value="1" @checked($val('transit_villa')) class="rounded border-cream-300" /> Transit villa</label>
                <label class="flex items-center gap-2 text-sm text-stone-700"><input type="checkbox" name="handling_bundled_la" value="1" @checked($val('handling_bundled_la')) class="rounded border-cream-300" /> Handling tercakup bundel LA</label>
                <label class="flex items-center gap-2 text-sm text-stone-700"><input type="checkbox" name="mutawwif_free" value="1" @checked($val('mutawwif_free')) class="rounded border-cream-300" /> Mutawwif gratis dari handler</label>
            </div>

            <div class="grid gap-4 sm:grid-cols-3 border-t border-cream-200 pt-4">
                <p class="sm:col-span-3 text-xs font-medium uppercase tracking-wide text-stone-500">Override tarif (opsional — kosongkan untuk pakai baseline)</p>
                <div><label class="mb-1 block text-sm text-stone-700">Tiket pesawat</label><input type="number" name="rate_tiket_pesawat" value="{{ $val('rate_tiket_pesawat') }}" placeholder="16.500.000" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" /></div>
                <div><label class="mb-1 block text-sm text-stone-700">Hotel Makkah /kmr</label><input type="number" name="rate_hotel_makkah" value="{{ $val('rate_hotel_makkah') }}" placeholder="4.750.000" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" /></div>
                <div><label class="mb-1 block text-sm text-stone-700">Hotel Madinah /kmr</label><input type="number" name="rate_hotel_madinah" value="{{ $val('rate_hotel_madinah') }}" placeholder="4.000.000" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm" /></div>
            </div>
        </div>

        {{-- Step 3 — ancillary packaging --}}
        <div x-show="step === 3" class="space-y-3 rounded-xl border border-cream-200 bg-cream-50 p-5">
            <p class="text-sm text-stone-500">All-in = wajib, pendapatan pasti (boleh menopang lantai margin). Opsional = ambilan sebagian (tidak boleh menopang lantai).</p>
            @foreach ($ancillaryProducts as $p)
                @php $sel = $val("ancillary_{$p->key}_packaging", $p->default_packaging); @endphp
                <div class="flex flex-wrap items-center justify-between gap-2 rounded-lg bg-cream-100 px-3 py-2">
                    <div class="text-sm">
                        <span class="font-medium text-stone-800">{{ $p->nama }}</span>
                        <span class="text-stone-400">— HPP Rp{{ number_format($p->default_cost, 0, ',', '.') }} / jual Rp{{ number_format($p->default_sell, 0, ',', '.') }}{{ $p->default_takeup_pct ? ' · ambilan '.number_format($p->default_takeup_pct * 100).'%' : '' }}</span>
                    </div>
                    <select name="ancillary_{{ $p->key }}_packaging" class="rounded-lg border border-cream-300 px-2 py-1.5 text-sm">
                        <option value="none" @selected($sel === 'none')>Tidak dijual</option>
                        <option value="all_in" @selected($sel === 'all_in')>All-in</option>
                        <option value="optional" @selected($sel === 'optional')>Opsional</option>
                    </select>
                </div>
            @endforeach
        </div>

        {{-- Step 4 — result --}}
        <div x-show="step === 4">
            @if ($preview)
                @include('admin.costing._result', ['p' => $preview])
            @else
                <div class="rounded-xl border border-dashed border-cream-300 bg-cream-50 p-8 text-center text-sm text-stone-500">
                    Klik <strong>Hitung</strong> untuk melihat hasil.
                </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="mt-5 flex flex-wrap items-center justify-between gap-3">
            <div class="flex gap-2">
                <button type="button" @click="step = Math.max(1, step - 1)" class="rounded-lg bg-cream-200 px-4 py-2 text-sm font-medium text-stone-700">← Kembali</button>
                <button type="button" @click="step = Math.min(4, step + 1)" class="rounded-lg bg-cream-200 px-4 py-2 text-sm font-medium text-stone-700">Lanjut →</button>
            </div>
            <div class="flex gap-2">
                <button type="submit" formaction="{{ route('admin.costing.preview') }}" @click="step = 4" class="rounded-lg bg-maroon-700 px-5 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">Hitung</button>
                <button type="submit" formaction="{{ route('admin.costing.store') }}" class="rounded-lg bg-emerald-700 px-5 py-2 text-sm font-semibold text-cream-50 hover:bg-emerald-800">Simpan</button>
            </div>
        </div>
    </form>
@endsection
