@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-10 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Kantor Pusat</span>
                <h2 class="font-display mt-2 text-3xl font-semibold text-maroon-900">PT. Haifa Nida Wisata Karawang</h2>
                <p class="mx-auto mt-4 max-w-2xl text-stone-600">Kantor resmi kami melayani konsultasi, pendaftaran, dan pengurusan dokumen perjalanan umroh &amp; haji secara langsung. Silakan berkunjung pada jam operasional atau hubungi kami terlebih dahulu untuk membuat janji.</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-5">
                <div class="lg:col-span-2 space-y-6">
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <div class="flex gap-3">
                            <i class="bx bxs-map mt-0.5 text-xl text-maroon-700"></i>
                            <div>
                                <h4 class="font-medium text-stone-800">Alamat</h4>
                                <a href="https://maps.app.goo.gl/Xrx19pdcp5CvsVoc6" target="_blank" rel="noopener noreferrer" class="text-sm text-stone-600 hover:text-maroon-700">
                                    Jl. Ra. Kartini No.1, Karangpawitan, Kec. Karawang Barat, Karawang, Jawa Barat 41315
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <div class="flex gap-3">
                            <i class="bx bx-time-five mt-0.5 text-xl text-maroon-700"></i>
                            <div>
                                <h4 class="font-medium text-stone-800">Jam Operasional</h4>
                                <p class="mt-1 text-sm text-stone-600">Senin &ndash; Jumat: 08.00 &ndash; 17.00 WIB</p>
                                <p class="text-sm text-stone-600">Sabtu: 08.00 &ndash; 13.00 WIB</p>
                                <p class="text-sm text-stone-600">Minggu &amp; hari libur nasional: Tutup</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <div class="flex gap-3">
                            <i class="bx bx-phone-call mt-0.5 text-xl text-maroon-700"></i>
                            <div>
                                <h4 class="font-medium text-stone-800">Customer Service</h4>
                                <a href="https://wa.me/6282299198002" target="_blank" class="text-sm text-stone-600 hover:text-maroon-700">+62 (822) 9919-8002</a>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <div class="flex gap-3">
                            <i class="bx bx-shield-quarter mt-0.5 text-xl text-maroon-700"></i>
                            <div>
                                <h4 class="font-medium text-stone-800">Legalitas</h4>
                                <p class="mt-1 text-sm text-stone-600">Terdaftar resmi di Kemenag RI dan <a href="https://validation.timsertifikasi.org/search?certnumber=TiMS%2FPPIU2234126" target="_blank" rel="noopener noreferrer" class="text-maroon-700 underline hover:text-maroon-900">terakreditasi A</a> sebagai Penyelenggara Perjalanan Ibadah Umrah (PPIU).</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-cream-200 shadow-sm lg:col-span-3">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4070.1583314211575!2d107.29679825896102!3d-6.299718274308804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e697761e03cf5ab%3A0x707fddda5f250f94!2sPT.%20Haifa%20Nida%20Wisata%20%7C%20Travel%20Umroh%20Karawang%20Pertama%20%7C%20Biro%20Umrah%20%7C%20Muslim%20Tour%20Umroh%20Resmi%20Terbaik%20Terpercaya!5e0!3m2!1sid!2sid!4v1746594252410!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0; min-height: 420px;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
