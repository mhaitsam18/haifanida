@extends('admin.layouts.app')

@php
    $defaultUsd = $current ? (int) $current->usd_idr : 18000;
    $defaultSar = $current ? (int) $current->sar_idr : 5000;
    // Revising the policy rate shifts every production cost at once — superadmin only.
    $canRevise = auth()->user()->admin?->is_superadmin === true;
@endphp

@section('content')
    <div x-data="Object.assign(modalForm(), { usd: {{ $defaultUsd }}, sar: {{ $defaultSar }}, peg: {{ $peg }} })">
        <x-page-header :title="$title">
            @if ($canRevise)
                <x-slot:actions>
                    <button type="button" @click="show()"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-refresh"></i> Ubah Kurs
                    </button>
                </x-slot:actions>
            @endif
        </x-page-header>

        @if (session('success'))
            <div class="mb-4 flex items-center gap-2 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                <i class="bx bx-check-circle text-lg"></i> {{ session('success') }}
            </div>
        @endif
        @if (session('warning'))
            <div class="mb-4 flex items-center gap-2 rounded-lg bg-amber-50 px-4 py-3 text-sm text-amber-700">
                <i class="bx bx-error text-lg"></i> {{ session('warning') }}
            </div>
        @endif

        {{-- Current policy --}}
        @if ($current)
            <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-stone-500">Kurs USD</p>
                    <p class="mt-1 font-display text-2xl font-semibold text-maroon-900">Rp{{ number_format($current->usd_idr, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-stone-500">Kurs SAR</p>
                    <p class="mt-1 font-display text-2xl font-semibold text-maroon-900">Rp{{ number_format($current->sar_idr, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-stone-500">SAR Patokan (÷{{ rtrim(rtrim(number_format($peg, 2), '0'), '.') }})</p>
                    <p class="mt-1 font-display text-2xl font-semibold text-stone-700">Rp{{ number_format($current->impliedSar(), 0, ',', '.') }}</p>
                    <p class="mt-0.5 text-xs text-stone-500">Bantalan +{{ number_format($current->bufferPct() * 100, 1) }}%</p>
                </div>
                <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-stone-500">Berlaku Sejak</p>
                    <p class="mt-1 font-display text-lg font-semibold text-maroon-900">{{ $current->effective_from->format('d M Y') }}</p>
                    <p class="mt-0.5 text-xs text-stone-500">oleh {{ $current->creator->name ?? 'sistem' }}</p>
                </div>
            </div>
        @else
            <div class="mb-6 rounded-lg bg-amber-50 px-4 py-3 text-sm text-amber-700">
                Belum ada kurs kebijakan. Klik <strong>Ubah Kurs</strong> untuk menetapkan yang pertama.
            </div>
        @endif

        {{-- Revise modal (superadmin only) --}}
        @if ($canRevise)
        <x-modal title="Ubah Kurs Kebijakan">
            <form action="{{ route('admin.fx-policy.store') }}" method="post" @submit="submit">
                @csrf
                <p class="mb-4 text-sm text-stone-500">
                    USD adalah input manajemen. SAR dipatok 3,75 per USD — tidak boleh di bawah nilai patokan.
                </p>

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Kurs USD (IDR)</label>
                    <input type="number" name="usd_idr" x-model.number="usd" min="1000" step="1"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100" />
                    <x-form-error name="usd_idr" />
                </div>

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Kurs SAR (IDR)</label>
                    <input type="number" name="sar_idr" x-model.number="sar" min="100" step="1"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100" />
                    {{-- Live peg feedback --}}
                    <p class="mt-1 text-xs text-stone-500">
                        Nilai patokan: Rp<span x-text="Math.round(usd / peg).toLocaleString('id-ID')"></span>
                        <span x-show="sar >= usd / peg" class="text-emerald-600"
                            x-text="'· bantalan +' + (((sar / (usd / peg)) - 1) * 100).toFixed(1) + '%'"></span>
                    </p>
                    <p x-show="sar < usd / peg" class="mt-1 text-xs font-medium text-red-600">
                        Di bawah patokan — akan ditolak. Naikkan SAR minimal ke nilai patokan.
                    </p>
                    <p x-show="sar >= usd / peg && sar > (usd / peg) * 1.1" class="mt-1 text-xs font-medium text-amber-600">
                        Bantalan di atas 10% — pastikan disengaja.
                    </p>
                    <x-form-error name="sar_idr" />
                </div>

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Berlaku Sejak</label>
                    <input type="date" name="effective_from" value="{{ now()->toDateString() }}"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100" />
                    <x-form-error name="effective_from" />
                </div>

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Alasan (opsional)</label>
                    <textarea name="reason" rows="2" placeholder="Mis. penyesuaian kurs setelah rupiah stabil"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100"></textarea>
                    <x-form-error name="reason" />
                </div>

                <div class="flex justify-end gap-2">
                    <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                    <x-button type="submit">
                        <span x-show="!submitting">Simpan</span>
                        <span x-show="submitting">Menyimpan...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
        @endif
    </div>

    {{-- Version history --}}
    <div class="mb-6 rounded-xl border border-cream-200 bg-cream-50 p-4">
        <h3 class="mb-3 font-display text-base font-semibold text-maroon-900">Riwayat Versi Kurs</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-2">Berlaku Sejak</th>
                        <th class="px-4 py-2">Sampai</th>
                        <th class="px-4 py-2">USD</th>
                        <th class="px-4 py-2">SAR</th>
                        <th class="px-4 py-2">Bantalan</th>
                        <th class="px-4 py-2">Oleh</th>
                        <th class="px-4 py-2">Alasan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @forelse ($history as $v)
                        <tr @class(['bg-emerald-50/40' => is_null($v->effective_to)])>
                            <td class="px-4 py-2 font-medium text-stone-800">{{ $v->effective_from->format('d M Y') }}</td>
                            <td class="px-4 py-2 text-stone-500">{{ $v->effective_to ? $v->effective_to->format('d M Y') : '— berjalan —' }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($v->usd_idr, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($v->sar_idr, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-stone-500">+{{ number_format($v->bufferPct() * 100, 1) }}%</td>
                            <td class="px-4 py-2 text-stone-500">{{ $v->creator->name ?? 'sistem' }}</td>
                            <td class="px-4 py-2 text-stone-500">{{ $v->reason }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-3 text-center text-stone-400">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Audit trail --}}
    <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
        <h3 class="mb-3 font-display text-base font-semibold text-maroon-900">Jejak Audit</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-2">Waktu</th>
                        <th class="px-4 py-2">Aksi</th>
                        <th class="px-4 py-2">Dari</th>
                        <th class="px-4 py-2">Menjadi</th>
                        <th class="px-4 py-2">Oleh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @forelse ($audits as $a)
                        <tr>
                            <td class="px-4 py-2 text-stone-500">{{ $a->created_at?->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 font-medium text-stone-800">{{ $a->action }}</td>
                            <td class="px-4 py-2 text-stone-500">
                                @if ($a->old_values)
                                    USD {{ number_format((float) ($a->old_values['usd_idr'] ?? 0), 0, ',', '.') }} /
                                    SAR {{ number_format((float) ($a->old_values['sar_idr'] ?? 0), 0, ',', '.') }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-4 py-2 text-stone-500">
                                USD {{ number_format((float) ($a->new_values['usd_idr'] ?? 0), 0, ',', '.') }} /
                                SAR {{ number_format((float) ($a->new_values['sar_idr'] ?? 0), 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 text-stone-500">{{ $a->user->name ?? 'sistem' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-3 text-center text-stone-400">Belum ada jejak audit.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
