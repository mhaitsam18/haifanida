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
    <div class="terms-conditions-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>{{ $title }}</h2>
            </div>
            {{-- <div class="row pt-45">
                <div class="col-lg-12">
                    <div class="terms-conditions-img">
                        <img src="/assets-techex-demo/images/terms-condition-img.jpg" alt="Images" loading="lazy">
                    </div>
                    <div class="single-content">
                        <h3>Legal Disclaimer</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3>01. Credit Reporting Terms of Service</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3>02. Ownership of Site Agreement to Terms of Use</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3>03. Provision of Services</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3>04. Limitation of Liability</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3>05. Accounts, Passwords and Security</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row pt-45">
        <div class="col-lg-12">
            <div class="terms-conditions-img">
                <img src="/assets-techex-demo/images/umroh-guide-img.jpg" alt="Images">
            </div>
            <div class="single-content">
                <h3>Panduan Umroh</h3>
                <p>
                    Perjalanan umroh adalah ibadah yang membutuhkan persiapan fisik, mental, dan spiritual. Kami menyediakan panduan lengkap untuk memastikan perjalanan Anda berjalan lancar dan khusyuk. Mulai dari pengurusan dokumen hingga tata cara ibadah, kami akan memandu Anda di setiap langkah.
                </p>
                <p>
                    Pastikan Anda memahami syarat dan ketentuan perjalanan, termasuk jadwal keberangkatan, akomodasi, dan peraturan selama di Tanah Suci. Kami juga menyediakan pembimbing berpengalaman untuk membantu menjalankan ibadah sesuai tuntunan syariat.
                </p>
            </div>
            <div class="single-content">
                <h3>01. Persiapan Dokumen Perjalanan</h3>
                <p>
                    Sebelum berangkat, pastikan Anda memiliki paspor yang berlaku minimal 6 bulan, kartu identitas, dan bukti vaksin meningitis. Kami akan membantu memverifikasi dokumen dan mengurus visa umroh agar prosesnya cepat dan mudah.
                </p>
                <p>
                    Selain itu, siapkan salinan dokumen penting dan simpan dalam tempat yang aman. Kami juga merekomendasikan untuk membawa kartu kesehatan atau catatan medis jika Anda memiliki kondisi kesehatan tertentu.
                </p>
            </div>
            <div class="single-content">
                <h3>02. Persiapan Fisik dan Mental</h3>
                <p>
                    Perjalanan umroh membutuhkan stamina yang baik karena melibatkan aktivitas fisik seperti tawaf dan sai. Lakukan olahraga ringan seperti berjalan kaki beberapa minggu sebelum keberangkatan untuk membangun kekuatan fisik.
                </p>
                <p>
                    Persiapan mental juga penting. Pelajari tata cara umroh, niat, dan doa-doa yang diperlukan. Kami menyediakan sesi manasik umroh untuk membantu Anda memahami setiap langkah ibadah dengan baik.
                </p>
            </div>
            <div class="single-content">
                <h3>03. Tata Cara Ibadah Umroh</h3>
                <p>
                    Ibadah umroh terdiri dari beberapa tahapan utama: ihram, tawaf, sai, dan tahallul. Setiap tahapan memiliki aturan dan doa khusus yang harus diikuti. Pembimbing kami akan mendampingi Anda untuk memastikan semua rukun umroh dilakukan dengan benar.
                </p>
                <p>
                    Selama di Tanah Suci, jaga kekhusyukan dan hindari perbuatan yang dapat membatalkan ibadah. Kami juga akan memberikan panduan tentang adab di Masjidil Haram dan Masjid Nabawi.
                </p>
            </div>
            <div class="single-content">
                <h3>04. Pengelolaan Keuangan Selama Perjalanan</h3>
                <p>
                    Siapkan dana yang cukup untuk kebutuhan pribadi seperti makanan tambahan, oleh-oleh, atau keperluan darurat. Kami merekomendasikan membawa mata uang Riyal Saudi dalam jumlah yang wajar dan kartu pembayaran internasional.
                </p>
                <p>
                    Hindari membawa uang tunai dalam jumlah besar untuk alasan keamanan. Tim kami akan memberikan saran tentang tempat penukaran uang yang terpercaya di Makkah dan Madinah.
                </p>
            </div>
            <div class="single-content">
                <h3>05. Keamanan dan Keselamatan</h3>
                <p>
                    Kami bekerja sama dengan penyedia layanan terpercaya untuk memastikan keamanan jamaah selama perjalanan. Selalu ikuti instruksi pembimbing dan hindari berpisah dari rombongan tanpa pemberitahuan.
                </p>
                <p>
                    Simpan nomor kontak darurat tim kami dan pihak berwenang setempat. Pastikan Anda juga membawa perlengkapan pribadi seperti masker, hand sanitizer, dan obat-obatan pribadi untuk menjaga kesehatan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
