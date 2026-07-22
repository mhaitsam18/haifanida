@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    @if (session('success'))
        <div class="mb-6 flex items-center gap-2 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            <i class="bx bx-check-circle text-lg"></i> {{ session('success') }}
        </div>
    @endif

    @unless ($credentialsSet)
        <div class="mb-6 flex items-start gap-2 rounded-lg bg-amber-50 px-4 py-3 text-sm text-amber-800">
            <i class="bx bx-error text-lg"></i>
            <span>Kredensial provider <strong>{{ strtoupper($provider) }}</strong> belum lengkap di <code>.env</code>
                (TBO_BASE_URL / TBO_USERNAME / TBO_PASSWORD). Sinkronisasi dapat dimulai, namun akan gagal hingga kredensial diisi.</span>
        </div>
    @endunless

    {{-- Summary cards --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-cream-200 bg-cream-50 p-5">
            <div class="text-xs uppercase tracking-wide text-stone-500">Provider Aktif</div>
            <div class="mt-1 font-display text-2xl font-semibold text-maroon-900">{{ strtoupper($provider) }}</div>
        </div>
        <div class="rounded-2xl border border-cream-200 bg-cream-50 p-5">
            <div class="text-xs uppercase tracking-wide text-stone-500">Total Hotel</div>
            <div class="mt-1 font-display text-2xl font-semibold text-maroon-900">{{ number_format($totalHotels) }}</div>
        </div>
        <div class="rounded-2xl border border-cream-200 bg-cream-50 p-5">
            <div class="text-xs uppercase tracking-wide text-stone-500">Tersinkron</div>
            <div class="mt-1 font-display text-2xl font-semibold text-emerald-700">{{ number_format($syncedCount) }}</div>
        </div>
        <div class="rounded-2xl border border-cream-200 bg-cream-50 p-5">
            <div class="text-xs uppercase tracking-wide text-stone-500">Gagal</div>
            <div class="mt-1 font-display text-2xl font-semibold {{ $failedCount ? 'text-red-600' : 'text-stone-400' }}">{{ number_format($failedCount) }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Current run + actions --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6">
                <div class="flex items-center justify-between">
                    <h3 class="font-display text-lg font-semibold text-maroon-900">Sinkronisasi Terakhir</h3>
                    @if ($run)
                        <span class="rounded-full px-2.5 py-1 text-xs font-medium
                            @class([
                                'bg-blue-50 text-blue-700' => $run->isRunning(),
                                'bg-emerald-50 text-emerald-700' => $run->status === 'completed',
                                'bg-red-50 text-red-600' => in_array($run->status, ['failed', 'cancelled']),
                            ])">{{ ucfirst($run->status) }}</span>
                    @endif
                </div>

                @if ($run)
                    <dl class="mt-4 grid grid-cols-2 gap-3 text-sm sm:grid-cols-4">
                        <div><dt class="text-stone-500">Tipe</dt><dd class="font-medium text-stone-800">{{ ucfirst($run->type) }}</dd></div>
                        <div><dt class="text-stone-500">Total</dt><dd class="font-medium text-stone-800">{{ $run->total_hotels }}</dd></div>
                        <div><dt class="text-stone-500">Diproses</dt><dd class="font-medium text-stone-800">{{ $run->processed_hotels }}</dd></div>
                        <div><dt class="text-stone-500">Gagal</dt><dd class="font-medium text-stone-800">{{ $run->failed_hotels }}</dd></div>
                    </dl>

                    {{-- Progress bar --}}
                    <div class="mt-4">
                        <div class="mb-1 flex justify-between text-xs text-stone-500">
                            <span>Progres</span><span>{{ $run->progressPercent() }}%</span>
                        </div>
                        <div class="h-2.5 w-full overflow-hidden rounded-full bg-cream-200">
                            <div class="h-full rounded-full bg-maroon-600 transition-all" style="width: {{ $run->progressPercent() }}%"></div>
                        </div>
                    </div>

                    <div class="mt-4 text-xs text-stone-500">
                        Mulai: {{ $run->started_at?->translatedFormat('d M Y H:i') ?? '—' }}
                        &middot; Selesai: {{ $run->finished_at?->translatedFormat('d M Y H:i') ?? '—' }}
                    </div>
                    @if ($run->error)
                        <div class="mt-3 rounded-lg bg-red-50 px-3 py-2 text-xs text-red-700">{{ $run->error }}</div>
                    @endif
                @else
                    <p class="mt-4 text-sm text-stone-500">Belum ada sinkronisasi yang dijalankan.</p>
                @endif
            </div>

            {{-- Failed hotels --}}
            <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6">
                <h3 class="font-display text-lg font-semibold text-maroon-900">Hotel Gagal Sinkron</h3>
                @if ($failedMappings->isEmpty())
                    <p class="mt-3 text-sm text-stone-500">Tidak ada hotel yang gagal. 🎉</p>
                @else
                    <div class="mt-4 overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs uppercase tracking-wide text-stone-500">
                                <tr><th class="py-2">Hotel</th><th class="py-2">Kode {{ strtoupper($provider) }}</th><th class="py-2">Error</th></tr>
                            </thead>
                            <tbody class="divide-y divide-cream-200">
                                @foreach ($failedMappings as $m)
                                    <tr>
                                        <td class="py-2 font-medium text-stone-800">{{ $m->hotel?->nama_hotel ?? '—' }}</td>
                                        <td class="py-2 text-stone-500">{{ $m->external_id }}</td>
                                        <td class="py-2 max-w-md truncate text-red-600" title="{{ $m->sync_error }}">{{ \Illuminate\Support\Str::limit($m->sync_error, 80) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Start panel + history --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6">
                <h3 class="font-display text-lg font-semibold text-maroon-900">Mulai Sinkronisasi</h3>
                <p class="mt-1 text-sm text-stone-500">Unduh konten hotel dari provider ke master data lokal.</p>

                <form action="/admin/hotel-sync/start" method="post" class="mt-4 space-y-3">
                    @csrf
                    <button type="submit" name="type" value="incremental" @disabled($run?->isRunning())
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-maroon-700 py-2.5 text-sm font-semibold text-cream-50 hover:bg-maroon-800 disabled:cursor-not-allowed disabled:opacity-60">
                        <i class="bx bx-refresh"></i> Sinkron Incremental
                    </button>
                    <button type="submit" name="type" value="full" @disabled($run?->isRunning())
                        class="flex w-full items-center justify-center gap-2 rounded-lg border border-maroon-300 py-2.5 text-sm font-semibold text-maroon-700 hover:bg-maroon-50 disabled:cursor-not-allowed disabled:opacity-60">
                        <i class="bx bx-sync"></i> Sinkron Penuh (Full)
                    </button>
                </form>

                @if ($run?->isRunning())
                    <p class="mt-3 text-xs text-blue-600">Sinkronisasi sedang berjalan — tombol dinonaktifkan. Muat ulang halaman untuk melihat progres.</p>
                @endif
            </div>

            <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6">
                <h3 class="font-display text-lg font-semibold text-maroon-900">Riwayat</h3>
                <ul class="mt-3 space-y-2 text-sm">
                    @forelse ($recentRuns as $r)
                        <li class="flex items-center justify-between">
                            <span class="text-stone-600">#{{ $r->id }} · {{ ucfirst($r->type) }}</span>
                            <span class="text-xs text-stone-400">{{ $r->created_at->translatedFormat('d M H:i') }} · {{ ucfirst($r->status) }}</span>
                        </li>
                    @empty
                        <li class="text-stone-400">Belum ada riwayat.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
