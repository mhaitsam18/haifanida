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
    {{-- <div class="content-area pt-30 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Frequently Asked Questions</h2>
                <p class="margin-auto">We are the agency who always gives you a priority on the free of question and you can
                    easily make a question on the bunch.</p>
            </div>
            
            {{-- ada bagian dimana poin ke 3 malah terbuka pertama, lalu tombol di poin 1 menjadi minus tanpa terbuka dan stuck di tanda minus 
            <div class="row pt-45">
                <div class="col-lg-6">
                    <div class="faq-content">
                        <div class="faq-accordion">
                            <ul class="accordion">
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        What is a Managed Security Services?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        What is a Data Analysis?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        How Can Make Secure My Website?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        What is a Infrastructure?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="faq-content">
                        <div class="faq-accordion">
                            <ul class="accordion">
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        How Can We Help Your Business?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Why It Staff Management?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        How Working Process Is Simplified?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Product Engineering & Services?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="content-area pt-30 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Frequently Asked Questions</h2>
                <p class="margin-auto">Kami adalah travel yang selalu memprioritaskan pertanyaan Anda secara gratis dan Anda dapat dengan mudah mengajukan pertanyaan kapan saja.</p>
            </div>
            
            <div class="row pt-45">
                <div class="col-lg-6">
                    <div class="faq-content">
                        <div class="faq-accordion">
                            <ul class="accordion">
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Apa itu Paket Umroh Reguler?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Paket Umroh Reguler adalah program perjalanan ibadah umroh dengan jadwal tetap, akomodasi standar, dan fasilitas lengkap untuk kenyamanan jamaah. Paket ini cocok untuk Anda yang ingin beribadah dengan biaya terjangkau.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Apa Saja Dokumen yang Diperlukan untuk Umroh?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Dokumen yang diperlukan meliputi paspor yang masih berlaku minimal 6 bulan, kartu identitas, akta kelahiran (jika diperlukan), serta bukti vaksin meningitis. Kami akan membantu proses pengurusannya.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Bagaimana Cara Memastikan Keamanan Selama Perjalanan?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Kami bekerja sama dengan penyedia layanan terpercaya di Arab Saudi untuk memastikan keamanan jamaah, mulai dari transportasi, akomodasi, hingga pendampingan selama ibadah.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Apa Perbedaan Umroh dan Haji?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Umroh adalah ibadah yang dapat dilakukan kapan saja, sedangkan haji memiliki waktu tertentu di bulan Dzulhijjah. Umroh juga tidak wajib, berbeda dengan haji yang merupakan rukun Islam kelima bagi yang mampu.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="faq-content">
                        <div class="faq-accordion">
                            <ul class="accordion">
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Bagaimana Cara Kami Membantu Perjalanan Umroh Anda?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Kami menyediakan layanan lengkap mulai dari pengurusan dokumen, pemesanan tiket, akomodasi, hingga pembimbingan ibadah agar perjalanan Anda lancar dan khusyuk.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Mengapa Memilih Paket Umroh VIP?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Paket Umroh VIP menawarkan akomodasi bintang 5, transportasi eksklusif, dan jadwal ibadah yang lebih fleksibel untuk pengalaman ibadah yang lebih nyaman dan pribadi.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Bagaimana Proses Pendaftaran Umroh?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Anda cukup menghubungi kami, mengisi formulir pendaftaran, melengkapi dokumen, dan melakukan pembayaran. Tim kami akan memandu setiap langkahnya.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Apakah Ada Pembimbing Selama Umroh?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Ya, setiap rombongan didampingi oleh pembimbing berpengalaman yang akan membantu jamaah dalam melaksanakan ibadah umroh sesuai tuntunan syariat.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
