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
                <span class="sp-color2">Privacy Policy</span>
                <h2>Techex Privacy Policy</h2>
            </div>
            {{-- <div class="row pt-45">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h3>Information Collection</h3>
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
                        <h3>Privacy Policy Techex</h3>
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
                        <h3>The Collection, Process and Use of Personal Data</h3>
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
                        <h3>Disclaimers</h3>
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
                        <h3> Data Protection</h3>
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
                        <h3>How We Use Cookies</h3>
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
                        <h3> The Collection, Process, and Use of Personal Data</h3>
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
        </div> --}}
        <div class="row pt-45">
            <div class="col-lg-12">
                <div class="single-content">
                    <h3>Pengumpulan Informasi</h3>
                    <p>
                        Kami mengumpulkan informasi pribadi yang Anda berikan saat mendaftar untuk perjalanan umroh, seperti nama, alamat, nomor paspor, nomor telepon, dan alamat email. Informasi ini diperlukan untuk memproses pendaftaran, pengurusan visa, dan penyediaan layanan perjalanan.
                    </p>
                    <p>
                        Selain itu, kami dapat mengumpulkan data non-pribadi, seperti preferensi perjalanan atau riwayat interaksi dengan situs kami, untuk meningkatkan pengalaman pengguna. Anda dapat memilih untuk tidak memberikan informasi tertentu, tetapi ini dapat membatasi akses Anda ke layanan kami.
                    </p>
                </div>
                <div class="single-content">
                    <h3>Kebijakan Privasi</h3>
                    <p>
                        Kami berkomitmen untuk melindungi privasi Anda. Informasi pribadi yang Anda berikan hanya akan digunakan untuk keperluan perjalanan umroh, seperti pengurusan dokumen, pemesanan akomodasi, dan komunikasi terkait layanan. Kami tidak akan menjual atau membagikan data Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali diwajibkan oleh hukum.
                    </p>
                    <p>
                        Data Anda disimpan dengan aman menggunakan teknologi enkripsi dan langkah-langkah keamanan lainnya. Kami juga secara rutin meninjau sistem kami untuk memastikan perlindungan data yang optimal.
                    </p>
                </div>
                <div class="single-content">
                    <h3>Pengumpulan, Pemrosesan, dan Penggunaan Data Pribadi</h3>
                    <p>
                        Data pribadi Anda diproses untuk memenuhi kebutuhan perjalanan, seperti pemesanan tiket pesawat, pengaturan akomodasi, dan pengurusan visa. Kami juga dapat menggunakan data Anda untuk mengirimkan pembaruan tentang perjalanan atau penawaran khusus, dengan persetujuan Anda.
                    </p>
                    <p>
                        Anda berhak meminta akses, koreksi, atau penghapusan data pribadi Anda kapan saja. Hubungi kami melalui kontak yang tersedia untuk mengelola data Anda sesuai dengan hak privasi Anda.
                    </p>
                </div>
                <div class="single-content">
                    <h3>Pernyataan Penyangkalan</h3>
                    <p>
                        Meskipun kami berupaya melindungi data Anda, kami tidak dapat menjamin keamanan absolut terhadap ancaman siber atau pelanggaran data yang berada di luar kendali kami. Anda bertanggung jawab untuk menjaga kerahasiaan informasi login Anda dan menggunakan perangkat yang aman.
                    </p>
                    <p>
                        Kami tidak bertanggung jawab atas kerugian yang timbul akibat penggunaan informasi Anda oleh pihak ketiga yang tidak sah, kecuali jika terbukti ada kelalaian dari pihak kami.
                    </p>
                </div>
                <div class="single-content">
                    <h3>Perlindungan Data</h3>
                    <p>
                        Kami menerapkan langkah-langkah teknis dan organisasi untuk melindungi data pribadi Anda, termasuk enkripsi data, firewall, dan akses terbatas ke sistem kami. Hanya staf yang berwenang yang dapat mengakses informasi Anda, dan mereka terikat oleh perjanjian kerahasiaan.
                    </p>
                    <p>
                        Data Anda akan disimpan hanya selama diperlukan untuk memenuhi tujuan pengumpulan atau sesuai dengan persyaratan hukum. Setelah itu, data akan dihapus atau dianonimkan dengan aman.
                    </p>
                </div>
                <div class="single-content">
                    <h3>Penggunaan Cookies</h3>
                    <p>
                        Situs kami menggunakan cookies untuk meningkatkan pengalaman pengguna, seperti menyimpan preferensi Anda atau melacak aktivitas di situs. Cookies ini tidak mengumpulkan informasi pribadi yang sensitif dan dapat dinonaktifkan melalui pengaturan browser Anda.
                    </p>
                    <p>
                        Dengan menggunakan situs kami, Anda setuju dengan penggunaan cookies sesuai dengan kebijakan ini. Anda dapat mengelola preferensi cookies kapan saja melalui pengaturan privasi di situs kami.
                    </p>
                </div>
                <div class="single-content">
                    <h3>Pengumpulan, Pemrosesan, dan Penggunaan Data Pribadi</h3>
                    <p>
                        Kami dapat membagikan data Anda dengan mitra layanan, seperti maskapai penerbangan atau hotel, hanya untuk keperluan perjalanan umroh. Mitra ini diwajibkan untuk mematuhi standar perlindungan data yang sama dengan kami.
                    </p>
                    <p>
                        Jika Anda memiliki pertanyaan tentang bagaimana data Anda digunakan atau ingin mengajukan keluhan, silakan hubungi kami melalui saluran resmi yang tersedia di situs kami.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
