@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                <img src="/assets/img/logos/logo-full.png" alt="Company Logo" class="mx-auto max-w-xs lg:max-w-full">
                <div class="prose max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600 prose-strong:text-maroon-800">
                    <h3>PT. Haifa Nida Wisata Karawang</h3>
                    <p>PT. Haifa Nida Wisata Karawang didirikan pada tahun 2007 oleh Dr. Fakhrurrozi, Lc., MA, alumnus Universitas Islam Madinah yang memiliki pengalaman luas dalam industri perhotelan dan perjalanan ibadah. Berawal dari bisnis perhotelan dan catering di Madinah, beliau mendirikan Haifa Nida Wisata untuk memberikan layanan perjalanan Haji dan Umrah yang aman, nyaman, dan terpercaya.</p>
                    <p>Dengan izin resmi sebagai Penyelenggara Perjalanan Ibadah Umrah (PPIU), Haifa Nida Wisata menjadi travel pertama di Karawang yang memperoleh legalitas penuh untuk memberangkatkan jamaah Umrah. Kami memiliki 10 Tour Leader tersertifikasi BNSP, Tour Guide profesional, serta tim pembimbing dan Muthowif/Muthowifah yang ahli di bidangnya.</p>
                    <p>Haifa Nida Wisata telah melayani lebih dari 100.000 jamaah Umrah dari seluruh Indonesia dan terus berkomitmen untuk meningkatkan kualitas pelayanan. Saat ini, kami telah resmi mendapatkan <strong>Akreditasi A</strong> dari Kementerian Agama Republik Indonesia sebagai bentuk pengakuan atas standar mutu dan profesionalitas kami. Selain itu, kami juga tengah dalam proses pengajuan izin sebagai <strong>Penyelenggara Ibadah Haji Khusus (PIHK)</strong> dan <strong>anggota IATA</strong> guna memperluas cakupan layanan dan memberikan kemudahan bagi para tamu Allah.</p>
                    <p>Dr. Fakhrurrozi juga dikenal sebagai pendiri Catering Al-Haidari dan pemilik restoran Bakso Si Adoel di Madinah, yang turut memperkuat kredibilitas dan kualitas pelayanan kami. Dengan pengalaman luas di industri perjalanan ibadah, kami siap memberikan pelayanan terbaik bagi setiap jamaah.</p>
                    <p><em>Percayakan perjalanan ibadah Anda bersama Haifa Nida Wisata &mdash; Aman, Nyaman, Amanah.</em><br>Hubungi kami sekarang untuk informasi paket Umrah dan Haji terbaru.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-cream-50 py-16">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h2 class="font-display text-2xl font-semibold text-maroon-900">Sertifikat Akreditasi PPIU</h2>
            <div class="mt-6 overflow-hidden rounded-2xl border border-cream-200 shadow-sm">
                <iframe src="https://drive.google.com/file/d/1SsSRT8vEdf5vJTc69NoRWqsZ-5d0OgN_/preview"
                    class="h-[70vh] w-full md:h-[90vh]" style="border: none;"></iframe>
            </div>
            <img class="mx-auto mt-6 max-w-md rounded-xl border border-cream-200" src="/assets/img/haifa/akreditasi-2.jpg" alt="Akreditasi PPIU" loading="lazy">
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-10 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Keunggulan Haifa Nida Wisata</h2>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    ['icon' => 'bx-certification', 'title' => 'Legal & Terakreditasi', 'text' => 'Memiliki izin resmi PPIU dan sedang dalam proses akreditasi terbaru untuk menjamin layanan berkualitas.'],
                    ['icon' => 'bx-shield-quarter', 'title' => 'Keamanan & Kenyamanan', 'text' => 'Menjamin perjalanan haji dan umroh yang aman, nyaman, dan penuh keberkahan bagi setiap jamaah.'],
                    ['icon' => 'bx-restaurant', 'title' => 'Catering Terbaik', 'text' => 'Didukung oleh Catering Al-Haidari, penyedia makanan nomor satu di Madinah untuk jamaah haji dan umroh.'],
                    ['icon' => 'bx-building-house', 'title' => 'Akomodasi Berkualitas', 'text' => 'Menyediakan hotel berbintang dengan lokasi strategis di Mekkah dan Madinah.'],
                    ['icon' => 'bxs-plane-alt', 'title' => 'Transportasi Nyaman', 'text' => 'Menggunakan armada transportasi yang modern dan nyaman untuk perjalanan ibadah.'],
                    ['icon' => 'bx-group', 'title' => 'Bimbingan Ibadah', 'text' => 'Dibimbing oleh Muthowif dan pembimbing ibadah yang berpengalaman dan tersertifikasi.'],
                ] as $item)
                    <x-card class="text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-maroon-100 text-2xl text-maroon-700">
                            <i class="bx {{ $item['icon'] }}"></i>
                        </div>
                        <h3 class="font-display mt-4 text-lg font-semibold text-maroon-900">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm text-stone-600">{{ $item['text'] }}</p>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-cream-50 py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                <div class="order-2 overflow-hidden rounded-2xl lg:order-1">
                    <img src="/assets/img/haifa/karyawan.jpg" alt="Company Profile" loading="lazy" class="aspect-video w-full object-cover">
                </div>
                <div class="order-1 lg:order-2">
                    <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Produk dan Layanan</span>
                    <p class="mt-3 text-stone-600">PT. Haifa Nida Wisata Karawang menyediakan beragam produk dan layanan berkualitas tinggi untuk memenuhi kebutuhan perjalanan ibadah dan wisata Anda. Dengan komitmen untuk memberikan pengalaman yang tak terlupakan, kami menawarkan layanan berikut:</p>
                    <div class="mt-5 grid gap-2 sm:grid-cols-2">
                        @foreach ([
                            'Biro Perjalanan Wisata', 'Penyelenggara Perjalanan Ibadah Umroh', 'Penyelenggara Ibadah Haji Khusus', 'Handling Bandara', 'Oleh-oleh dan Perlengkapan Umroh',
                            'Land Arrangement', 'Tiket dan Visa', 'Bimbingan Manasik', 'Tour Guide & Tour Leader',
                        ] as $layanan)
                            <div class="flex items-center gap-2 text-sm text-stone-700">
                                <i class="bx bxs-check-circle text-maroon-700"></i> {{ $layanan }}
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-5 text-sm text-stone-600">Kami memahami betapa pentingnya setiap detil perjalanan Anda. Dengan dukungan profesionalisme dan keberlanjutan layanan, PT. Haifa Nida Wisata Karawang berkomitmen untuk memberikan pengalaman perjalanan ibadah yang aman, nyaman, dan berkesan. Ayo nikmati setiap momen suci Anda bersama kami!</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                <div>
                    <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Kenapa Harus Kami</span>
                    <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900">Pengalaman yang Terbukti</h2>
                    <p class="mt-3 text-sm text-stone-600">Perusahaan kami, PT. Haifa Nida Wisata, telah berdiri sejak tahun 2007, menorehkan jejak sukses selama {{ now()->year - 2007 }} tahun pengalaman dalam industri Umroh dan Haji. Keberadaan kami di Karawang sebagai Travel pertama yang memiliki izin Penyelenggara Perjalanan Ibadah Umroh (PPIU) menandakan komitmen kami dalam memberikan pelayanan terbaik.</p>
                    <p class="mt-3 text-sm text-stone-600">Dengan pengalaman yang solid, kami tidak hanya sebuah agen perjalanan, tapi mitra spiritual dalam setiap perjalanan ibadah Anda. Keberhasilan ini memperoleh pijakan kuat karena kami adalah perusahaan dengan kantor sendiri, bukan sewa. Kejelasan ini mencerminkan integritas dan komitmen kami untuk memberikan layanan terbaik tanpa kompromi.</p>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
                            <i class="bx bx-medal text-2xl text-maroon-700"></i>
                            <h3 class="font-display mt-2 font-semibold text-maroon-900">Pendiri yang Berkualitas</h3>
                            <p class="mt-1 text-sm text-stone-600">Pendiri perusahaan, H. Dr. Fakhrurrozi Lc., MA, adalah seorang alumni Universitas Islam Madinah. Dengan latar belakang ini, beliau memiliki pengetahuan mendalam tentang Mekkah dan Madinah serta pengalaman sebagai pengusaha perhotelan di Arab Saudi.</p>
                        </div>
                        <div class="rounded-xl border border-cream-200 bg-cream-50 p-4">
                            <i class="bx bx-support text-2xl text-maroon-700"></i>
                            <h3 class="font-display mt-2 font-semibold text-maroon-900">Layanan Unggul Berkelanjutan</h3>
                            <p class="mt-1 text-sm text-stone-600">PT. Haifa Nida Wisata juga bangga memiliki perusahaan catering sendiri di Arab Saudi. Tour leader dan manajemen profesional kami bertujuan memberikan pengalaman perjalanan yang tak terlupakan.</p>
                        </div>
                    </div>
                    <p class="mt-6 text-sm italic text-stone-600">Pilihlah PT. Haifa Nida Wisata sebagai mitra perjalanan Haji, Umroh, dan wisata halal Anda, karena untuk kami, setiap perjalanan adalah kesempatan untuk menciptakan kenangan berharga dalam ibadah Anda.</p>
                </div>
                <div class="overflow-hidden rounded-2xl">
                    <img src="/assets/img/haifa/anak-muda.jpg" alt="Jamaah Haifa Nida Wisata" loading="lazy" class="aspect-3/4 w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-cream-50 py-16">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <img class="mx-auto rounded-2xl border border-cream-200" src="/assets/img/haifa/staff-kami.jpg" alt="Staff Kami" loading="lazy">
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-10 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Tim Pengembang</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900">Tim Pengembang Website</h2>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ([
                    ['name' => 'Haitsam', 'role' => 'Project Owner & Fullstack Dev.', 'campus' => 'Universitas Telkom', 'major' => 'Sistem Informasi', 'github' => 'mhaitsam18', 'icon' => 'bx-code-curly'],
                    ['name' => 'Nuansa Bening A.J.', 'role' => 'Frontend Developer', 'campus' => 'Universitas Pendidikan Indonesia', 'major' => 'Ilmu Komputer', 'github' => 'nbeningg', 'icon' => 'bx-palette'],
                    ['name' => 'Kasyful Haq B.', 'role' => 'Frontend Developer', 'campus' => 'Universitas Pendidikan Indonesia', 'major' => 'Ilmu Komputer', 'github' => 'DatBoiSUS-Baka', 'icon' => 'bx-terminal'],
                    ['name' => 'Meisya Amalia', 'role' => 'Backend Developer', 'campus' => 'Universitas Pendidikan Indonesia', 'major' => 'Ilmu Komputer', 'github' => 'Meisya721', 'icon' => 'bx-cog'],
                    ['name' => 'Ibnu Fadhilah', 'role' => 'Backend Developer', 'campus' => 'Universitas Pendidikan Indonesia', 'major' => 'Ilmu Komputer', 'github' => 'Noov-hub', 'icon' => 'bx-code-alt'],
                ] as $dev)
                    <x-card class="text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-maroon-700 text-2xl text-cream-50">
                            <i class="bx {{ $dev['icon'] }}"></i>
                        </div>
                        <h3 class="font-display mt-3 text-sm font-semibold text-maroon-900">{{ $dev['name'] }}</h3>
                        <p class="mt-1 text-xs font-medium text-stone-500">{{ $dev['role'] }}</p>
                        <div class="mt-2 rounded-lg bg-cream-100 p-2 text-xs text-stone-500">
                            <div class="font-medium text-stone-700">{{ $dev['campus'] }}</div>
                            <div>{{ $dev['major'] }}</div>
                        </div>
                        <a href="https://github.com/{{ $dev['github'] }}" target="_blank" rel="noopener noreferrer"
                            class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-stone-800 px-4 py-1.5 text-xs font-medium text-cream-50 hover:bg-stone-900">
                            <i class="bx bxl-github"></i> GitHub
                        </a>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>
@endsection
