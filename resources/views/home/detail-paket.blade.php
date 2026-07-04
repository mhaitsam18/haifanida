@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div x-data class="border-b border-cream-200 bg-cream-50">
        <div class="mx-auto max-w-6xl px-4 py-4 text-sm text-stone-500">
            <a href="/" class="hover:text-maroon-700">Home</a>
            <i class="bx bx-chevron-right mx-1 align-middle"></i>
            <a href="/umroh" class="hover:text-maroon-700">Paket Umroh</a>
            <i class="bx bx-chevron-right mx-1 align-middle"></i>
            <span class="text-stone-700">{{ $title }}</span>
        </div>
    </div>

    <section class="py-12">
        <div class="mx-auto max-w-6xl px-4">
            <div class="grid gap-10 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="overflow-hidden rounded-2xl border border-cream-200 shadow-sm">
                        @if ($paket->gambar)
                            <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}" class="aspect-video w-full object-cover">
                        @else
                            <img src="/assets/img/mekkah/aviator70.jpg" alt="{{ $paket->nama_paket }}" class="aspect-video w-full object-cover">
                        @endif
                    </div>

                    <h1 class="font-display mt-6 text-2xl font-semibold text-maroon-900 md:text-3xl">{{ $paket->nama_paket }}</h1>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        @foreach ([
                            ['icon' => 'bx-map', 'label' => 'Destinasi', 'value' => $paket->destinasi],
                            ['icon' => 'bx-time', 'label' => 'Durasi', 'value' => $paket->durasi . ' Hari'],
                            ['icon' => 'bx-calendar', 'label' => 'Tanggal Keberangkatan', 'value' => Carbon::parse($paket->tanggal_mulai)->format('d M Y')],
                            ['icon' => 'bx-calendar', 'label' => 'Tanggal Kepulangan', 'value' => Carbon::parse($paket->tanggal_selesai)->format('d M Y')],
                            ['icon' => 'bxs-plane-take-off', 'label' => 'Keberangkatan dari', 'value' => $paket->tempat_keberangkatan],
                            ['icon' => 'bxs-plane-land', 'label' => 'Kepulangan ke', 'value' => $paket->tempat_kepulangan],
                        ] as $info)
                            <div class="flex items-start gap-3 rounded-xl border border-cream-200 bg-cream-50 p-4">
                                <i class="bx {{ $info['icon'] }} mt-0.5 text-xl text-maroon-700"></i>
                                <div>
                                    <div class="text-xs uppercase tracking-wide text-stone-500">{{ $info['label'] }}</div>
                                    <div class="text-sm font-medium text-stone-800">{{ $info['value'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="prose mt-10 max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600">
                        <h3><i class="bx bx-detail align-middle text-maroon-700"></i> Deskripsi Paket</h3>
                        <div>{!! nl2br($paket->deskripsi) !!}</div>
                    </div>

                    <div class="prose mt-8 max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600">
                        <h3><i class="bx bx-check-shield align-middle text-maroon-700"></i> Fasilitas</h3>
                        <div>{!! $paket->fasilitas !!}</div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl bg-maroon-900 p-6 text-cream-50 shadow-sm">
                        <h3 class="font-display text-lg font-semibold">Harga Paket</h3>
                        <div class="mt-3">
                            <div class="font-display text-3xl font-semibold">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                            <div class="text-sm text-cream-300">per orang</div>
                        </div>
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
                        <a href="#" id="shareWhatsAppBtn"
                            class="mt-3 flex items-center justify-center gap-2 rounded-lg border border-cream-400/40 py-3 text-sm font-semibold text-cream-100 transition hover:bg-maroon-800">
                            <i class="bx bxl-whatsapp text-lg"></i> Bagikan via WhatsApp
                        </a>
                    </div>

                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <h3 class="font-display flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-package"></i> Paket Lainnya
                        </h3>
                        <div class="mt-4 space-y-3">
                            @foreach (App\Models\Paket::where('jenis_paket', $paket->jenis_paket)
                                    ->where('id', '!=', $paket->id)
                                    ->where('published_at', '!=', null)
                                    ->latest()
                                    ->take(5)
                                    ->get() as $otherPaket)
                                <a href="/paket/{{ $otherPaket->id }}" class="flex items-center gap-3 rounded-xl border border-cream-200 p-3 transition hover:border-maroon-300 hover:bg-cream-100">
                                    <div class="h-14 w-14 shrink-0 overflow-hidden rounded-lg bg-cream-200">
                                        @if ($otherPaket->gambar)
                                            <img src="{{ asset('storage/' . $otherPaket->gambar) }}" alt="{{ $otherPaket->nama_paket }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-stone-400">
                                                <i class="bx bx-image text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="truncate text-sm font-medium text-stone-800">{{ Str::limit($otherPaket->nama_paket, 45) }}</h4>
                                        <div class="mt-0.5 flex items-center gap-1 text-xs text-stone-500">
                                            <i class="bx bx-calendar"></i> {{ Carbon::parse($otherPaket->tanggal_mulai)->format('d M Y') }} &middot; {{ $otherPaket->durasi }} Hari
                                        </div>
                                        <div class="mt-0.5 text-sm font-semibold text-maroon-700">Rp {{ number_format($otherPaket->harga, 0, ',', '.') }}</div>
                                    </div>
                                    <i class="bx bx-chevron-right text-stone-400"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const shareWhatsAppBtn = document.getElementById('shareWhatsAppBtn');

            shareWhatsAppBtn.addEventListener('click', function (e) {
                e.preventDefault();

                function decodeHtmlEntities(text) {
                    const textarea = document.createElement('textarea');
                    textarea.innerHTML = text;
                    return textarea.value;
                }

                const deskripsi = {!! json_encode(strip_tags($paket->deskripsi)) !!};
                const fasilitas = {!! json_encode(strip_tags($paket->fasilitas)) !!};

                const decodedDeskripsi = decodeHtmlEntities(deskripsi);
                const decodedFasilitas = decodeHtmlEntities(fasilitas);

                const message = `🕋 Bismillah, aku mau daftar Umroh di PT. Haifa Nida Wisata Karawang!
    Berikut detail paket yang aku pilih:

    ✈️ {{ $paket->nama_paket }}
    📆 Keberangkatan: {{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}
    ⏱️ Durasi: {{ $paket->durasi }} Hari
    🌐 Destinasi: {{ $paket->destinasi }}
    💰 Harga: Rp {{ number_format($paket->harga, 0, ',', '.') }}/orang

    ${decodedDeskripsi}

    Fasilitas:
    ${decodedFasilitas}

    🙋‍♂️ Tertarik juga? Bisa langsung hubungi admin PT. Haifa:
    📱 WhatsApp: https://wa.me/6282299198002
    📍 Kantor: Jl. Raya Karawang No. 88`;

                const encodedMessage = encodeURIComponent(message);
                const whatsappLink = `https://api.whatsapp.com/send?text=${encodedMessage}`;
                window.open(whatsappLink, '_blank');
            });
        });
    </script>
@endsection
