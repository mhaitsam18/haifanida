@extends('layouts.main')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="inner-banner">
        <div class="container">
            <div class="inner-title text-center">
                <h3>{{ $title }}</h3>
                <ul>
                    <li>
                        <a href="/home">Home</a>
                    </li>
                    <li>
                        <i class='bx bx-chevrons-right'></i>
                    </li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
        <div class="inner-shape">
            <img src="/assets-techex-demo/images/shape/inner-shape.png" alt="Images">
        </div>
    </div>
    <div class="content-area pt-30 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">{{ $konten->judul }}</span>
                <h2>{{ $konten->judul }}</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-12">
                    <div class="single-content">
                        {!! $konten->isi_konten ?? 'Belum Tersedia' !!}
                    </div>
                </div>
            </div>

            <!-- Visi dan Misi -->
            <div class="row pt-70">
                <div class="col-lg-12">
                    <div class="single-content">
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
            </div>

        </div>
    </div>
@endsection
