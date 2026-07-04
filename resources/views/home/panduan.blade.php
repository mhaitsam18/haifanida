@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-4xl px-4">
            <div class="prose max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600 prose-strong:text-maroon-800">
                <h3>Panduan Umroh</h3>
                <p>Perjalanan umroh adalah ibadah yang membutuhkan persiapan fisik, mental, dan spiritual. Kami menyediakan panduan lengkap untuk memastikan perjalanan Anda berjalan lancar dan khusyuk. Mulai dari pengurusan dokumen hingga tata cara ibadah, kami akan memandu Anda di setiap langkah.</p>
                <p>Pastikan Anda memahami syarat dan ketentuan perjalanan, termasuk jadwal keberangkatan, akomodasi, dan peraturan selama di Tanah Suci. Kami juga menyediakan pembimbing berpengalaman untuk membantu menjalankan ibadah sesuai tuntunan syariat.</p>
            </div>

            <div class="my-10 rounded-2xl border border-cream-200 bg-cream-50 p-6 md:p-8">
                <div class="grid gap-8 md:grid-cols-3 md:items-center">
                    <div class="md:col-span-2">
                        <h3 class="font-display text-xl font-semibold text-maroon-900">5 Pasti Umroh dari Kementerian Agama</h3>
                        <p class="mt-2 text-sm text-stone-600">PT. Haifa Nida Wisata Karawang berkomitmen memenuhi seluruh standar <strong class="text-maroon-800">5 Pasti Umrah</strong> dari Kementerian Agama Republik Indonesia:</p>
                        <ul class="mt-4 space-y-2 text-sm text-stone-600">
                            <li><strong class="text-maroon-800">1. Pasti Travel Berizin</strong> &ndash; Terdaftar resmi di Kemenag RI dan <a href="https://validation.timsertifikasi.org/search?certnumber=TiMS%2FPPIU2234126" target="_blank" rel="noopener noreferrer" class="text-maroon-700 underline hover:text-maroon-900">terakreditasi A.</a></li>
                            <li><strong class="text-maroon-800">2. Pasti Jadwalnya</strong> &ndash; Keberangkatan dan kepulangan sesuai jadwal resmi yang disampaikan secara tertulis.</li>
                            <li><strong class="text-maroon-800">3. Pasti Terbangnya</strong> &ndash; Menggunakan maskapai resmi, tiket dikeluarkan sebelum keberangkatan.</li>
                            <li><strong class="text-maroon-800">4. Pasti Visanya</strong> &ndash; Visa resmi terbit sebelum keberangkatan.</li>
                            <li><strong class="text-maroon-800">5. Pasti Layanannya</strong> &ndash; Layanan hotel, transportasi, konsumsi, manasik, dan pembimbing sesuai standar.</li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <img src="{{ asset('assets/img/logos/logo-pastiumrah.png') }}" alt="5 Pasti Umrah" class="mx-auto max-w-36">
                    </div>
                </div>
            </div>

            <div class="space-y-10">
                @foreach ([
                    ['no' => '01', 'title' => 'Persiapan Dokumen Perjalanan', 'body' => [
                        'Sebelum berangkat, pastikan Anda memiliki paspor yang berlaku minimal 6 bulan, kartu identitas, dan bukti vaksin meningitis. Kami akan membantu memverifikasi dokumen dan mengurus visa umroh agar prosesnya cepat dan mudah.',
                        'Selain itu, siapkan salinan dokumen penting dan simpan dalam tempat yang aman. Kami juga merekomendasikan untuk membawa kartu kesehatan atau catatan medis jika Anda memiliki kondisi kesehatan tertentu.',
                    ]],
                    ['no' => '02', 'title' => 'Persiapan Fisik dan Mental', 'body' => [
                        'Perjalanan umroh membutuhkan stamina yang baik karena melibatkan aktivitas fisik seperti tawaf dan sai. Lakukan olahraga ringan seperti berjalan kaki beberapa minggu sebelum keberangkatan untuk membangun kekuatan fisik.',
                        'Persiapan mental juga penting. Pelajari tata cara umroh, niat, dan doa-doa yang diperlukan. Kami menyediakan sesi manasik umroh untuk membantu Anda memahami setiap langkah ibadah dengan baik.',
                    ]],
                    ['no' => '03', 'title' => 'Tata Cara Ibadah Umroh', 'body' => [
                        'Ibadah umroh terdiri dari beberapa tahapan utama: ihram, tawaf, sai, dan tahallul. Setiap tahapan memiliki aturan dan doa khusus yang harus diikuti. Pembimbing kami akan mendampingi Anda untuk memastikan semua rukun umroh dilakukan dengan benar.',
                        'Selama di Tanah Suci, jaga kekhusyukan dan hindari perbuatan yang dapat membatalkan ibadah. Kami juga akan memberikan panduan tentang adab di Masjidil Haram dan Masjid Nabawi.',
                    ], 'link' => ['url' => '/buku-manasik', 'label' => 'Download buku Manasik di sini']],
                    ['no' => '04', 'title' => 'Pengelolaan Keuangan Selama Perjalanan', 'body' => [
                        'Siapkan dana yang cukup untuk kebutuhan pribadi seperti makanan tambahan, oleh-oleh, atau keperluan darurat. Kami merekomendasikan membawa mata uang Riyal Saudi dalam jumlah yang wajar dan kartu pembayaran internasional.',
                        'Hindari membawa uang tunai dalam jumlah besar untuk alasan keamanan. Tim kami akan memberikan saran tentang tempat penukaran uang yang terpercaya di Makkah dan Madinah.',
                    ]],
                    ['no' => '05', 'title' => 'Keamanan dan Keselamatan', 'body' => [
                        'Kami bekerja sama dengan penyedia layanan terpercaya untuk memastikan keamanan jamaah selama perjalanan. Selalu ikuti instruksi pembimbing dan hindari berpisah dari rombongan tanpa pemberitahuan.',
                        'Simpan nomor kontak darurat tim kami dan pihak berwenang setempat. Pastikan Anda juga membawa perlengkapan pribadi seperti masker, hand sanitizer, dan obat-obatan pribadi untuk menjaga kesehatan.',
                    ]],
                ] as $step)
                    <div class="flex gap-5">
                        <div class="font-display flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-maroon-700 text-lg font-semibold text-cream-50">
                            {{ $step['no'] }}
                        </div>
                        <div>
                            <h4 class="font-display text-lg font-semibold text-maroon-900">{{ $step['title'] }}</h4>
                            @foreach ($step['body'] as $paragraph)
                                <p class="mt-2 text-sm leading-relaxed text-stone-600">{{ $paragraph }}</p>
                            @endforeach
                            @isset($step['link'])
                                <a href="{{ $step['link']['url'] }}" target="_blank" rel="noopener noreferrer" class="mt-2 inline-flex items-center gap-1 text-sm font-medium text-maroon-700 underline hover:text-maroon-900">
                                    {{ $step['link']['label'] }}
                                </a>
                            @endisset
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
