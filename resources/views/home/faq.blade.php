@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-10 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Frequently Asked Questions</h2>
                <p class="mx-auto mt-3 max-w-2xl text-stone-600">Kami selalu memprioritaskan pertanyaan Anda secara gratis dan Anda dapat dengan mudah mengajukan pertanyaan kapan saja.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                <div class="space-y-3">
                    <x-accordion-item question="Apa itu Paket Umroh Reguler?">
                        Paket Umroh Reguler adalah program perjalanan ibadah umroh dengan jadwal tetap, akomodasi standar, dan fasilitas lengkap untuk kenyamanan jamaah. Paket ini cocok untuk Anda yang ingin beribadah dengan biaya terjangkau.
                    </x-accordion-item>
                    <x-accordion-item question="Apa Saja Dokumen yang Diperlukan untuk Umroh?">
                        Dokumen yang diperlukan meliputi paspor yang masih berlaku minimal 6 bulan, kartu identitas, akta kelahiran (jika diperlukan), serta bukti vaksin meningitis. Kami akan membantu proses pengurusannya.
                    </x-accordion-item>
                    <x-accordion-item question="Bagaimana Cara Memastikan Keamanan Selama Perjalanan?">
                        Kami bekerja sama dengan penyedia layanan terpercaya di Arab Saudi untuk memastikan keamanan jamaah, mulai dari transportasi, akomodasi, hingga pendampingan selama ibadah.
                    </x-accordion-item>
                    <x-accordion-item question="Apa Perbedaan Umroh dan Haji?">
                        Umroh adalah ibadah yang dapat dilakukan kapan saja, sedangkan haji memiliki waktu tertentu di bulan Dzulhijjah. Umroh juga tidak wajib, berbeda dengan haji yang merupakan rukun Islam kelima bagi yang mampu.
                    </x-accordion-item>
                </div>
                <div class="space-y-3">
                    <x-accordion-item question="Bagaimana Cara Kami Membantu Perjalanan Umroh Anda?">
                        Kami menyediakan layanan lengkap mulai dari pengurusan dokumen, pemesanan tiket, akomodasi, hingga pembimbingan ibadah agar perjalanan Anda lancar dan khusyuk.
                    </x-accordion-item>
                    <x-accordion-item question="Mengapa Memilih Paket Umroh VIP?">
                        Paket Umroh VIP menawarkan akomodasi bintang 5, transportasi eksklusif, dan jadwal ibadah yang lebih fleksibel untuk pengalaman ibadah yang lebih nyaman dan pribadi.
                    </x-accordion-item>
                    <x-accordion-item question="Bagaimana Proses Pendaftaran Umroh?">
                        Anda cukup menghubungi kami, mengisi formulir pendaftaran, melengkapi dokumen, dan melakukan pembayaran. Tim kami akan memandu setiap langkahnya.
                    </x-accordion-item>
                    <x-accordion-item question="Apakah Ada Pembimbing Selama Umroh?">
                        Ya, setiap rombongan didampingi oleh pembimbing berpengalaman yang akan membantu jamaah dalam melaksanakan ibadah umroh sesuai tuntunan syariat.
                    </x-accordion-item>
                </div>
            </div>
        </div>
    </section>
@endsection
