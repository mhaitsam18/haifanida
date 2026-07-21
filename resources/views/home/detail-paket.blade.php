@extends('layouts.app')

@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;

    // Route the breadcrumb / "back" link to the correct listing for this
    // package's type instead of always assuming Umroh.
    $listingMap = [
        'umroh' => ['/umroh', 'Paket Umroh'],
        'haji' => ['/haji', 'Paket Haji'],
        'wisata halal' => ['/wisata-halal', 'Wisata Halal'],
    ];
    [$listingUrl, $listingLabel] = $listingMap[$paket->jenis_paket] ?? ['/umroh', 'Paket'];
@endphp

@section('content')
    {{-- Breadcrumb --}}
    <div class="border-b border-cream-200 bg-cream-50">
        <div class="mx-auto max-w-6xl px-4 py-4 text-sm text-stone-500">
            <a href="/" class="transition-colors hover:text-maroon-700">Beranda</a>
            <i class="bx bx-chevron-right mx-1 align-middle"></i>
            <a href="{{ $listingUrl }}" class="transition-colors hover:text-maroon-700">{{ $listingLabel }}</a>
            <i class="bx bx-chevron-right mx-1 align-middle"></i>
            <span class="text-stone-700">{{ $title }}</span>
        </div>
    </div>

    <section class="py-12 sm:py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="grid gap-10 lg:grid-cols-3">
                {{-- Main column --}}
                <div class="lg:col-span-2">
                    <div data-reveal class="group relative overflow-hidden rounded-2xl border border-cream-200 shadow-sm">
                        <img src="{{ $paket->gambar ? asset('storage/' . $paket->gambar) : '/assets/img/mekkah/aviator70.jpg' }}"
                            alt="{{ $paket->nama_paket }}" class="aspect-video w-full object-cover">
                        <div class="pointer-events-none absolute inset-0 bg-linear-to-t from-maroon-950/70 via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-cream-50/90 px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-maroon-800 backdrop-blur">
                                <i class="bx bxs-moon"></i> {{ ucwords($paket->jenis_paket) }}
                            </span>
                            <h1 class="font-display mt-3 text-2xl font-semibold text-cream-50 drop-shadow-md md:text-3xl">{{ $paket->nama_paket }}</h1>
                        </div>
                    </div>

                    {{-- Quick facts --}}
                    <div data-reveal class="mt-6 grid gap-3 sm:grid-cols-2">
                        @foreach ([
                            ['icon' => 'bx-map', 'label' => 'Destinasi', 'value' => $paket->destinasi],
                            ['icon' => 'bx-time', 'label' => 'Durasi', 'value' => $paket->durasi ? $paket->durasi . ' Hari' : null],
                            ['icon' => 'bx-calendar-event', 'label' => 'Tanggal Keberangkatan', 'value' => $paket->tanggal_mulai ? Carbon::parse($paket->tanggal_mulai)->translatedFormat('d F Y') : null],
                            ['icon' => 'bx-calendar-check', 'label' => 'Tanggal Kepulangan', 'value' => $paket->tanggal_selesai ? Carbon::parse($paket->tanggal_selesai)->translatedFormat('d F Y') : null],
                            ['icon' => 'bxs-plane-take-off', 'label' => 'Keberangkatan dari', 'value' => $paket->tempat_keberangkatan],
                            ['icon' => 'bxs-plane-land', 'label' => 'Kepulangan ke', 'value' => $paket->tempat_kepulangan],
                        ] as $info)
                            @if ($info['value'])
                                <div class="flex items-start gap-3 rounded-xl border border-cream-200 bg-cream-50 p-4 transition-colors hover:border-maroon-200">
                                    <i class="bx {{ $info['icon'] }} mt-0.5 text-xl text-maroon-700"></i>
                                    <div>
                                        <div class="text-xs uppercase tracking-wide text-stone-500">{{ $info['label'] }}</div>
                                        <div class="text-sm font-medium text-stone-800">{{ $info['value'] }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @if ($paket->deskripsi)
                        <div data-reveal class="prose mt-10 max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600">
                            <h3><i class="bx bx-detail align-middle text-maroon-700"></i> Deskripsi Paket</h3>
                            <div>{!! nl2br($paket->deskripsi) !!}</div>
                        </div>
                    @endif

                    @if ($paket->fasilitas)
                        <div data-reveal class="prose mt-8 max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600">
                            <h3><i class="bx bx-check-shield align-middle text-maroon-700"></i> Fasilitas</h3>
                            <div>{!! $paket->fasilitas !!}</div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                    <div class="overflow-hidden rounded-2xl bg-linear-to-b from-maroon-900 to-maroon-950 p-6 text-cream-50 shadow-lg">
                        <h3 class="font-display text-lg font-semibold">Harga Paket</h3>
                        <div class="mt-3">
                            <div class="font-display text-3xl font-semibold">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                            <div class="text-sm text-cream-300">per orang</div>
                        </div>

                        @if ($paket->kuota_jemaah)
                            <div class="mt-4 flex items-center gap-2 rounded-lg bg-cream-50/10 px-3 py-2 text-xs text-cream-200">
                                <i class="bx bx-group"></i> Kuota {{ $paket->kuota_jemaah }} jema'ah per keberangkatan
                            </div>
                        @endif

                        @auth
                            <a href="{{ route('umroh.formPemesanan', ['paket_id' => $paket->id]) }}"
                                class="mt-5 flex items-center justify-center gap-2 rounded-lg bg-cream-100 py-3 text-sm font-semibold text-maroon-900 transition hover:bg-cream-50">
                                <i class="bx bx-cart"></i> Pesan Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="mt-5 flex items-center justify-center gap-2 rounded-lg bg-cream-100 py-3 text-sm font-semibold text-maroon-900 transition hover:bg-cream-50">
                                <i class="bx bx-cart"></i> Login untuk Pesan
                            </a>
                        @endauth
                        <button type="button" id="shareWhatsAppBtn"
                            class="mt-3 flex w-full items-center justify-center gap-2 rounded-lg border border-cream-400/40 py-3 text-sm font-semibold text-cream-100 transition hover:bg-maroon-800">
                            <i class="bx bxl-whatsapp text-lg"></i> Bagikan via WhatsApp
                        </button>

                        <div class="mt-5 flex items-center justify-center gap-4 border-t border-cream-400/20 pt-4 text-[11px] text-cream-300">
                            <span class="inline-flex items-center gap-1"><i class="bx bx-check-circle"></i> Resmi Kemenag</span>
                            <span class="inline-flex items-center gap-1"><i class="bx bx-shield-quarter"></i> Terpercaya</span>
                        </div>
                    </div>

                    @if ($paketLainnya->count())
                        <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                            <h3 class="font-display flex items-center gap-2 text-lg font-semibold text-maroon-900">
                                <i class="bx bx-package"></i> Paket Lainnya
                            </h3>
                            <div class="mt-4 space-y-3">
                                @foreach ($paketLainnya as $otherPaket)
                                    <a href="/paket/{{ $otherPaket->id }}" class="flex items-center gap-3 rounded-xl border border-cream-200 p-3 transition hover:border-maroon-300 hover:bg-cream-100">
                                        <div class="h-14 w-14 shrink-0 overflow-hidden rounded-lg bg-cream-200">
                                            @if ($otherPaket->gambar)
                                                <img src="{{ asset('storage/' . $otherPaket->gambar) }}" alt="{{ $otherPaket->nama_paket }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="flex h-full w-full items-center justify-center text-stone-400"><i class="bx bx-image text-xl"></i></div>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <h4 class="truncate text-sm font-medium text-stone-800">{{ Str::limit($otherPaket->nama_paket, 45) }}</h4>
                                            <div class="mt-0.5 flex items-center gap-1 text-xs text-stone-500">
                                                <i class="bx bx-calendar"></i> {{ Carbon::parse($otherPaket->tanggal_mulai)->translatedFormat('d M Y') }} &middot; {{ $otherPaket->durasi }} Hari
                                            </div>
                                            <div class="mt-0.5 text-sm font-semibold text-maroon-700">Rp {{ number_format($otherPaket->harga, 0, ',', '.') }}</div>
                                        </div>
                                        <i class="bx bx-chevron-right text-stone-400"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const shareWhatsAppBtn = document.getElementById('shareWhatsAppBtn');
            if (!shareWhatsAppBtn) return;

            shareWhatsAppBtn.addEventListener('click', function (e) {
                e.preventDefault();

                function decodeHtmlEntities(text) {
                    const textarea = document.createElement('textarea');
                    textarea.innerHTML = text;
                    return textarea.value;
                }

                const deskripsi = decodeHtmlEntities({!! json_encode(strip_tags($paket->deskripsi ?? '')) !!});
                const fasilitas = decodeHtmlEntities({!! json_encode(strip_tags($paket->fasilitas ?? '')) !!});

                const message = `🕋 Bismillah, saya tertarik dengan paket {{ ucwords($paket->jenis_paket) }} di PT. Haifa Nida Wisata Karawang!
Berikut detail paket yang saya pilih:

✈️ {{ $paket->nama_paket }}
📆 Keberangkatan: {{ $paket->tanggal_mulai ? Carbon::parse($paket->tanggal_mulai)->translatedFormat('d M Y') : '-' }}
⏱️ Durasi: {{ $paket->durasi }} Hari
🌐 Destinasi: {{ $paket->destinasi }}
💰 Harga: Rp {{ number_format($paket->harga, 0, ',', '.') }}/orang

${deskripsi}

Fasilitas:
${fasilitas}

🙋 Tertarik juga? Hubungi admin PT. Haifa Nida Wisata:
📱 WhatsApp: https://wa.me/6282299198002
📍 Kantor: Jl. RA. Kartini No.1, Karangpawitan, Kec. Karawang Barat, Karawang, Jawa Barat 41315`;

                const encodedMessage = encodeURIComponent(message);
                window.open(`https://api.whatsapp.com/send?text=${encodedMessage}`, '_blank');
            });
        });
    </script>
@endsection
