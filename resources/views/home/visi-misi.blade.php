@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-4xl px-4">
            <div class="mb-10 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">{{ $konten->judul }}</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900">{{ $konten->judul }}</h2>
            </div>

            <div class="prose max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600">
                {!! $konten->isi_konten ?? 'Belum Tersedia' !!}
            </div>

            <div class="prose mt-10 max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600">
                <h3>Visi</h3>
                <p>Menjadi travel haji dan umroh yang amanah terpercaya, berlandaskan Al-Qur'an dan As-Sunnah,
                    dengan komitmen pada nilai-nilai keislaman yang tinggi, serta menjadi pilihan utama bagi
                    tamu-tamu Allah yang mencari kepuasan, kenyamanan, keamanan, dan keberkahan dalam ibadah mereka.
                </p>

                <h3>Misi</h3>
                <ol>
                    <li>Memberikan pelayanan terbaik yang mengutamakan kepuasan tamu-tamu Allah, dengan menjaga
                        kualitas dan keamanan setiap perjalanan haji dan umroh.</li>
                    <li>Terus mengembangkan fasilitas dan layanan yang mengikuti perkembangan zaman serta mengikuti
                        tren dan inovasi terbaru dalam industri travel, sehingga memberikan pengalaman yang berkesan
                        bagi setiap tamu-tamu Allah.</li>
                    <li>Mensejahterakan karyawan dengan memberikan lingkungan kerja yang kondusif, pelatihan yang
                        berkualitas, dan penghargaan yang layak atas kontribusi mereka dalam kesuksesan perusahaan.
                    </li>
                    <li>Menyediakan layanan travel haji dan umroh yang lengkap dan terintegrasi mulai dari land
                        arrangement, catering, transportasi, tiket, visa, perhotelan, hingga tour guide dan
                        muthowwif yang berkualitas dan bersertifikasi.</li>
                    <li>Menjaga profesionalitas dan integritas perusahaan dengan memiliki izin resmi dan legal,
                        serta menjalin kemitraan yang kokoh dan saling menguntungkan dengan semua pihak terkait.
                    </li>
                    <li>Membangun fondasi perusahaan yang kuat berdasarkan kepercayaan dan amanah, dengan
                        memprioritaskan keamanan dan kenyamanan tamu-tamu Allah sebagai prioritas utama setiap
                        perjalanan.</li>
                    <li>Merintis kepercayaan dengan membangun hubungan yang harmonis dan saling menguntungkan dengan
                        mitra, vendor, agen, dan tamu-tamu Allah, serta memastikan tidak ada cacat dalam pelayanan
                        yang kami berikan.</li>
                </ol>
            </div>
        </div>
    </section>
@endsection
