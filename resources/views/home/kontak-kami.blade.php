@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title"
        subtitle="Konsultasikan rencana perjalanan ibadah Anda — tim kami siap membantu dengan sepenuh hati." />

    <section class="py-16 sm:py-20">
        <div class="mx-auto max-w-6xl px-4">
            @if (session()->has('success'))
                <div data-reveal class="mb-6 flex items-center gap-2 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
                    <i class="bx bx-check-circle text-lg"></i> {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div data-reveal class="mb-6 flex items-center gap-2 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
                    <i class="bx bx-error-circle text-lg"></i> {{ session('error') }}
                </div>
            @endif
            @if (session()->has('status'))
                <div data-reveal class="mb-6 flex items-center gap-2 rounded-lg bg-blue-50 px-4 py-3 text-sm text-blue-700">
                    <i class="bx bx-info-circle text-lg"></i> {{ session('status') }}
                </div>
            @endif

            <div class="grid gap-8 lg:grid-cols-5">
                {{-- Contact info --}}
                <div data-reveal class="lg:col-span-2">
                    <div class="relative overflow-hidden rounded-2xl bg-linear-to-b from-maroon-900 to-maroon-950 p-8 text-cream-50 shadow-lg">
                        <div aria-hidden="true" class="pointer-events-none absolute inset-0"
                            style="background: radial-gradient(ellipse 70% 50% at 100% 0%, rgba(230,192,120,0.12) 0%, transparent 60%)"></div>
                        <div class="relative">
                            <h3 class="font-display text-xl font-semibold">Hubungi Kami</h3>
                            <ul class="mt-6 space-y-5 text-sm">
                                <li class="flex gap-3">
                                    <i class="bx bx-phone-call mt-0.5 text-xl text-cream-400"></i>
                                    <div>
                                        <h4 class="font-medium text-cream-100">Nomor Telepon CS</h4>
                                        <a href="tel:+6282299198002" class="text-cream-300 transition-colors hover:text-cream-50">+62 (822) 9919-8002</a>
                                    </div>
                                </li>
                                <li class="flex gap-3">
                                    <i class="bx bxs-map mt-0.5 text-xl text-cream-400"></i>
                                    <div>
                                        <h4 class="font-medium text-cream-100">Alamat</h4>
                                        <a href="https://maps.app.goo.gl/Xrx19pdcp5CvsVoc6" target="_blank" class="text-cream-300 transition-colors hover:text-cream-50">Jl. Ra. Kartini No.1, Karangpawitan, Kec. Karawang Barat, Karawang, Jawa Barat 41315</a>
                                    </div>
                                </li>
                                <li class="flex gap-3">
                                    <i class="bx bx-message mt-0.5 text-xl text-cream-400"></i>
                                    <div>
                                        <h4 class="font-medium text-cream-100">Email</h4>
                                        <a href="mailto:cs@haifanida.id" class="text-cream-300 transition-colors hover:text-cream-50">cs@haifanida.id</a>
                                    </div>
                                </li>
                                <li class="flex gap-3">
                                    <i class="bx bx-money mt-0.5 text-xl text-cream-400"></i>
                                    <div>
                                        <h4 class="font-medium text-cream-100">Nomor Rekening</h4>
                                        <p class="mt-1 text-cream-300">Bank Mandiri<br>1320014831409 a/n Haifa Nida Wisata Karawang</p>
                                        <p class="mt-2 text-cream-300">Bank BCA<br>1092826656 a/n Haifa Nida Wisata Karawang</p>
                                        <p class="mt-2 text-cream-300">Bank BJB<br>0000410697000 a/n Haifa Nida Wisata Karawang, PT</p>
                                    </div>
                                </li>
                            </ul>

                            <a href="https://wa.me/6282299198002" target="_blank"
                                class="mt-7 flex items-center justify-center gap-2 rounded-lg bg-cream-100 py-3 text-sm font-semibold text-maroon-900 transition hover:bg-cream-50">
                                <i class="bx bxl-whatsapp text-lg"></i> Chat via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <div data-reveal data-reveal-delay="0.1" class="lg:col-span-3">
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm md:p-8">
                        <h3 class="font-display text-xl font-semibold text-maroon-900">Kirim Pesan</h3>
                        <p class="mt-1 text-sm text-stone-500">Isi formulir di bawah dan tim kami akan segera menghubungi Anda.</p>

                        <form action="/kontak-kami" method="post" id="contactForm" class="mt-6"
                            x-data="{ submitting: false }" @submit="submitting = true">
                            @csrf
                            @auth
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @endauth
                            <div class="grid gap-x-4 sm:grid-cols-2">
                                <x-form-input label="Nama" name="nama_pengirim" required placeholder="Nama lengkap" :value="old('nama_pengirim')" />
                                <x-form-input label="Email" name="email_pengirim" type="email" required placeholder="email@contoh.com" :value="old('email_pengirim')" />
                                <x-form-input label="Nomor Ponsel / WhatsApp" name="nomor_wa_pengirim" required placeholder="08xxxxxxxxxx" :value="old('nomor_wa_pengirim')" />
                                <x-form-input label="Subjek" name="subjek" required placeholder="Subjek / Judul" :value="old('subjek')" />
                            </div>
                            <x-form-textarea label="Pesan" name="pesan" :rows="6" required placeholder="Tuliskan pesan Anda..." :value="old('pesan')" />
                            <div>
                                <button type="submit" :disabled="submitting"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-maroon-700 px-6 py-3 text-sm font-semibold text-cream-50 transition hover:bg-maroon-800 disabled:cursor-not-allowed disabled:opacity-70">
                                    <span x-show="!submitting" class="inline-flex items-center gap-2">Kirim Pesan <i class="bx bx-chevron-right"></i></span>
                                    <span x-show="submitting" x-cloak class="inline-flex items-center gap-2">
                                        <i class="bx bx-loader-alt animate-spin"></i> Mengirim...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map --}}
    <section data-reveal class="pb-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-6 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Lokasi Kami</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900">Kunjungi Kantor Pusat Kami</h2>
            </div>
            <div class="overflow-hidden rounded-2xl border border-cream-200 shadow-sm">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4070.1583314211575!2d107.29679825896102!3d-6.299718274308804!2m3!1f0!2f0!3f0!3m2!1s0x2e697761e03cf5ab%3A0x707fddda5f250f94!2sPT.%20Haifa%20Nida%20Wisata%20%7C%20Travel%20Umroh%20Karawang%20Pertama%20%7C%20Biro%20Umrah%20%7C%20Muslim%20Tour%20Umroh%20Resmi%20Terbaik%20Terpercaya!5e0!3m2!1sid!2sid!4v1746594252410!5m2!1sid!2sid"
                    width="100%" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection
