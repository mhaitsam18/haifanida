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
                <h2>Techex Terms & Conditions</h2>
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
                <img src="/assets-techex-demo/images/terms-condition-img.jpg" alt="Images" loading="lazy">
            </div>
            <div class="single-content">
                <h3>Pernyataan Hukum</h3>
                <p>
                    Syarat dan ketentuan ini mengatur penggunaan layanan perjalanan umroh yang disediakan oleh kami. Dengan mendaftar atau menggunakan layanan kami, Anda setuju untuk mematuhi semua ketentuan yang tercantum di sini. Kami berhak memperbarui syarat ini tanpa pemberitahuan sebelumnya, dan Anda disarankan untuk memeriksanya secara berkala.
                </p>
                <p>
                    Informasi yang diberikan dalam situs web atau materi promosi kami tidak bersifat mengikat secara hukum dan dapat berubah sewaktu-waktu. Kami tidak bertanggung jawab atas ketidaksesuaian informasi akibat perubahan peraturan atau keadaan di luar kendali kami.
                </p>
            </div>
            <div class="single-content">
                <h3>01. Ketentuan Pendaftaran dan Pembayaran</h3>
                <p>
                    Pendaftaran umroh mengharuskan Anda melengkapi dokumen seperti paspor (berlaku minimal 6 bulan), kartu identitas, dan bukti vaksin meningitis. Pembayaran harus dilakukan sesuai jadwal yang ditentukan, dan kegagalan memenuhi tenggat waktu dapat mengakibatkan pembatalan pendaftaran tanpa pengembalian dana.
                </p>
                <p>
                    Semua biaya yang dibayarkan tidak dapat dikembalikan kecuali diatur lain dalam kebijakan pembatalan kami. Pastikan Anda memahami rincian paket sebelum melakukan pembayaran.
                </p>
            </div>
            <div class="single-content">
                <h3>02. Kepemilikan dan Penggunaan Situs</h3>
                <p>
                    Konten pada situs web kami, termasuk teks, gambar, dan logo, adalah milik kami atau mitra kami dan dilindungi oleh hukum hak cipta. Anda dilarang menyalin, mendistribusikan, atau menggunakan konten tersebut tanpa izin tertulis dari kami.
                </p>
                <p>
                    Dengan mengakses situs kami, Anda setuju untuk tidak menggunakan situs ini untuk tujuan yang melanggar hukum atau merusak reputasi kami. Kami berhak membatasi akses Anda jika ditemukan pelanggaran.
                </p>
            </div>
            <div class="single-content">
                <h3>03. Penyediaan Layanan</h3>
                <p>
                    Kami berkomitmen untuk menyediakan layanan perjalanan umroh yang mencakup transportasi, akomodasi, dan pendampingan ibadah sesuai dengan paket yang dipilih. Namun, layanan dapat berubah karena faktor seperti perubahan jadwal maskapai, regulasi pemerintah, atau keadaan force majeure.
                </p>
                <p>
                    Kami akan berupaya memberikan pemberitahuan secepat mungkin atas setiap perubahan. Anda setuju untuk mematuhi instruksi dari pembimbing atau petugas kami selama perjalanan.
                </p>
            </div>
            <div class="single-content">
                <h3>04. Batasan Tanggung Jawab</h3>
                <p>
                    Kami tidak bertanggung jawab atas kerugian, cedera, atau kerusakan yang disebabkan oleh faktor di luar kendali kami, termasuk bencana alam, gangguan penerbangan, atau tindakan pihak ketiga. Anda disarankan untuk memiliki asuransi perjalanan untuk perlindungan tambahan.
                </p>
                <p>
                    Tanggung jawab kami terbatas pada penyediaan layanan sesuai dengan kesepakatan. Segala sengketa akan diselesaikan berdasarkan hukum yang berlaku di Indonesia.
                </p>
            </div>
            <div class="single-content">
                <h3>05. Akun, Kata Sandi, dan Keamanan</h3>
                <p>
                    Anda bertanggung jawab untuk menjaga kerahasiaan akun dan kata sandi yang digunakan untuk mengakses layanan online kami. Jangan bagikan informasi login Anda dengan pihak lain untuk mencegah penyalahgunaan.
                </p>
                <p>
                    Kami menggunakan langkah-langkah keamanan untuk melindungi data Anda, tetapi Anda juga harus memastikan perangkat Anda aman. Segera laporkan kepada kami jika Anda mencurigai adanya aktivitas tidak sah pada akun Anda.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
