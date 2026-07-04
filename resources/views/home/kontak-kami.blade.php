@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-10 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Info Kontak</span>
                <h2 class="font-display mt-2 text-3xl font-semibold text-maroon-900">Konsultasikan Rencana Perjalanan Anda</h2>
            </div>

            @if (session()->has('error'))
                <div class="mb-6 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
            @endif
            @if (session()->has('success'))
                <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
            @endif
            @if (session()->has('status'))
                <div class="mb-6 rounded-lg bg-blue-50 px-4 py-3 text-sm text-blue-700">{{ session('status') }}</div>
            @endif

            <div class="grid gap-10 lg:grid-cols-5">
                <div class="lg:col-span-2">
                    <div class="rounded-2xl bg-maroon-900 p-8 text-cream-50">
                        <h3 class="font-display text-xl font-semibold">Hubungi Kami</h3>
                        <ul class="mt-6 space-y-6 text-sm">
                            <li class="flex gap-3">
                                <i class="bx bx-phone-call mt-0.5 text-xl text-cream-400"></i>
                                <div>
                                    <h4 class="font-medium text-cream-100">Nomor Telepon CS</h4>
                                    <a href="tel:+62(822)9919-8002" class="text-cream-300 hover:text-cream-50">+62 (822) 9919-8002</a>
                                </div>
                            </li>
                            <li class="flex gap-3">
                                <i class="bx bxs-map mt-0.5 text-xl text-cream-400"></i>
                                <div>
                                    <h4 class="font-medium text-cream-100">Alamat</h4>
                                    <a href="https://maps.app.goo.gl/Xrx19pdcp5CvsVoc6" class="text-cream-300 hover:text-cream-50">Jl. Ra. Kartini No.1, Karangpawitan, Kec. Karawang Barat, Karawang, Jawa Barat 41315</a>
                                </div>
                            </li>
                            <li class="flex gap-3">
                                <i class="bx bx-message mt-0.5 text-xl text-cream-400"></i>
                                <div>
                                    <h4 class="font-medium text-cream-100">Email</h4>
                                    <a href="mailto:cs@haifanida.id?subject=Pertanyaan&body=Saya memiliki beberapa pertanyaan tentang produk Anda" class="text-cream-300 hover:text-cream-50">cs@haifanida.id</a>
                                </div>
                            </li>
                            <li class="flex gap-3">
                                <i class="bx bx-money mt-0.5 text-xl text-cream-400"></i>
                                <div>
                                    <h4 class="font-medium text-cream-100">Nomor Rekening</h4>
                                    <p class="mt-1 text-cream-300">Bank Mandiri<br>1320014831409 a/n Haifa Nida Wisata Karawang</p>
                                    <p class="mt-2 text-cream-300">Bank BCA<br>1092826656 a/n Haifa Nida Wisata Karawang</p>
                                    <p class="mt-2 text-cream-300">Bank BJB<br>0000410697000 a/n Haifa nida wisata karawang, PT</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm md:p-8">
                        <form action="/kontak-kami" method="post" id="contactForm">
                            @csrf
                            @auth
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @endauth
                            <div class="grid gap-x-4 sm:grid-cols-2">
                                <x-form-input label="Nama" name="nama_pengirim" required placeholder="Nama" />
                                <x-form-input label="Email" name="email_pengirim" type="email" required placeholder="Email" />
                                <x-form-input label="Nomor Ponsel / WhatsApp" name="nomor_wa_pengirim" required placeholder="Nomor WhatsApp" />
                                <x-form-input label="Subjek" name="subjek" required placeholder="Subjek / Judul" />
                            </div>
                            <x-form-textarea label="Pesan" name="pesan" :rows="6" required placeholder="Pesan Anda" />
                            <div class="text-center">
                                <x-button type="submit">
                                    Kirim Pesan <i class="bx bx-chevron-right"></i>
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Informasi Kontak</h2>
            </div>
            <div class="flex items-center justify-center gap-3 rounded-xl border border-cream-200 bg-cream-50 p-6">
                <span class="text-sm font-medium text-stone-700">Customer Service</span>
                <a href="https://wa.me/6282299198002" target="_blank" class="inline-flex items-center gap-2 text-sm font-semibold text-maroon-700 hover:text-maroon-900">
                    <img src="/assets/img/logos/logo-wa.png" alt="WhatsApp Logo" class="h-6 w-6">
                    +62 (822) 9919-8002
                </a>
            </div>
        </div>
    </section>

    <div class="overflow-hidden">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4070.1583314211575!2d107.29679825896102!3d-6.299718274308804!2m3!1f0!2f0!3f0!3m2!1s0x2e697761e03cf5ab%3A0x707fddda5f250f94!2sPT.%20Haifa%20Nida%20Wisata%20%7C%20Travel%20Umroh%20Karawang%20Pertama%20%7C%20Biro%20Umrah%20%7C%20Muslim%20Tour%20Umroh%20Resmi%20Terbaik%20Terpercaya!5e0!3m2!1sid!2sid!4v1746594252410!5m2!1sid!2sid"
            width="100%" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
