@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title"
        subtitle="Arah, tujuan, dan nilai yang memandu setiap langkah pelayanan kami kepada tamu-tamu Allah." />

    <section class="py-16 sm:py-20">
        <div class="mx-auto max-w-5xl px-4">
            {{-- DB-driven header block (Konten::find(6)); rendered only when it
                 actually has content so an empty CMS row doesn't leave a gap. --}}
            @if (!empty($konten?->isi_konten))
                <div data-reveal class="prose mx-auto mb-14 max-w-3xl text-center prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600">
                    {!! $konten->isi_konten !!}
                </div>
            @endif

            {{-- Visi — a single elevated statement --}}
            <div data-reveal class="relative overflow-hidden rounded-3xl bg-linear-to-br from-maroon-900 to-maroon-950 p-8 text-center text-cream-50 shadow-lg sm:p-12">
                <div aria-hidden="true" class="pointer-events-none absolute inset-0"
                    style="background: radial-gradient(ellipse 60% 80% at 50% 0%, rgba(230,192,120,0.15) 0%, transparent 65%)"></div>
                <div class="relative">
                    <i class="bx bxs-quote-alt-left text-4xl text-cream-400/70"></i>
                    <span class="mt-2 block text-sm font-semibold uppercase tracking-[0.3em] text-cream-300">Visi</span>
                    <p class="font-display mx-auto mt-4 max-w-3xl text-xl italic leading-relaxed text-cream-50 sm:text-2xl">
                        Menjadi travel haji dan umroh yang amanah terpercaya, berlandaskan Al-Qur'an dan As-Sunnah,
                        dengan komitmen pada nilai-nilai keislaman yang tinggi, serta menjadi pilihan utama bagi
                        tamu-tamu Allah yang mencari kepuasan, kenyamanan, keamanan, dan keberkahan dalam ibadah mereka.
                    </p>
                </div>
            </div>

            {{-- Misi — numbered cards --}}
            <div data-reveal class="mt-14 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Langkah Kami</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900 sm:text-3xl">Misi</h2>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach ([
                    'Memberikan pelayanan terbaik yang mengutamakan kepuasan tamu-tamu Allah, dengan menjaga kualitas dan keamanan setiap perjalanan haji dan umroh.',
                    'Terus mengembangkan fasilitas dan layanan yang mengikuti perkembangan zaman serta mengikuti tren dan inovasi terbaru dalam industri travel, sehingga memberikan pengalaman yang berkesan bagi setiap tamu-tamu Allah.',
                    'Mensejahterakan karyawan dengan memberikan lingkungan kerja yang kondusif, pelatihan yang berkualitas, dan penghargaan yang layak atas kontribusi mereka dalam kesuksesan perusahaan.',
                    'Menyediakan layanan travel haji dan umroh yang lengkap dan terintegrasi mulai dari land arrangement, catering, transportasi, tiket, visa, perhotelan, hingga tour guide dan muthowwif yang berkualitas dan bersertifikasi.',
                    'Menjaga profesionalitas dan integritas perusahaan dengan memiliki izin resmi dan legal, serta menjalin kemitraan yang kokoh dan saling menguntungkan dengan semua pihak terkait.',
                    'Membangun fondasi perusahaan yang kuat berdasarkan kepercayaan dan amanah, dengan memprioritaskan keamanan dan kenyamanan tamu-tamu Allah sebagai prioritas utama setiap perjalanan.',
                    'Merintis kepercayaan dengan membangun hubungan yang harmonis dan saling menguntungkan dengan mitra, vendor, agen, dan tamu-tamu Allah, serta memastikan tidak ada cacat dalam pelayanan yang kami berikan.',
                ] as $misi)
                    <div data-reveal data-reveal-delay="{{ ($loop->index % 2) * 0.08 }}"
                        class="flex gap-4 rounded-2xl border border-cream-200 bg-cream-50 p-5 shadow-sm transition-colors hover:border-maroon-200">
                        <span class="flex h-9 w-9 flex-none items-center justify-center rounded-full bg-maroon-100 font-display text-base font-semibold text-maroon-700">{{ $loop->iteration }}</span>
                        <p class="text-sm leading-relaxed text-stone-600">{{ $misi }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
