@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title"
        subtitle="Perjalanan panjang membangun kepercayaan — dari Madinah hingga menjadi biro perjalanan ibadah terpercaya di Karawang." />

    <section class="py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4">
            <div data-reveal class="mb-12 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Kisah Kami</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900 sm:text-3xl">Sejarah dan Profil PT. Haifa Nida Wisata Karawang</h2>
            </div>

            {{-- Vertical timeline: a gold thread runs down the left with a
                 numbered milestone marker per chapter, echoing the homepage's
                 Golden Thread. The `before:` pseudo draws the line; each node
                 reveals on scroll. All narrative text is preserved verbatim. --}}
            <div class="relative space-y-4 before:absolute before:bottom-4 before:left-[19px] before:top-4 before:w-0.5 before:bg-linear-to-b before:from-cream-400 before:via-maroon-300 before:to-cream-400 sm:before:left-[23px]">
                @php
                    $chapters = [
                        ['num' => '1', 'title' => 'Awal Perjalanan Sang Pendiri'],
                        ['num' => '2', 'title' => 'Kelahiran Catering Al-Haidari dan Bisnis Kuliner'],
                        ['num' => '3', 'title' => 'Berdirinya PT. Haifa Nida Wisata Karawang'],
                        ['num' => '4', 'title' => 'Keunggulan dan Legalitas'],
                        ['num' => '5', 'title' => 'Jaringan Usaha dan Lokasi Kantor'],
                        ['num' => '6', 'title' => 'Komitmen Kami'],
                    ];
                @endphp

                {{-- Chapter 1 --}}
                <div data-reveal class="relative pl-14 sm:pl-16">
                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-full border-2 border-cream-300 bg-maroon-700 font-display text-lg font-semibold text-cream-50 shadow-sm sm:h-12 sm:w-12">1</div>
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <h3 class="font-display text-xl font-semibold text-maroon-800">Awal Perjalanan Sang Pendiri</h3>
                        <div class="prose mt-3 max-w-none prose-p:text-stone-600 prose-strong:text-maroon-800">
                            <p>PT. Haifa Nida Wisata Karawang didirikan oleh Dr. Fakhrurrozi, Lc., MA, alumni Universitas Islam Madinah yang memiliki visi besar dalam pelayanan jamaah dan bisnis perjalanan ibadah.</p>
                            <p>Perjalanan beliau dimulai sejak menjejakkan kaki di Madinah untuk menempuh pendidikan tinggi. Sambil menunggu diterima di universitas, beliau bekerja di sebuah toko emas milik pengusaha Arab. Berkat keahliannya dalam manajemen, usaha tersebut berkembang hingga membuka beberapa cabang.</p>
                            <p>Setelah resmi menjadi mahasiswa, beliau tetap menjaga semangat kemandirian ekonomi dengan bekerja sebagai tour guide bagi jamaah Umroh dan Haji. Usahanya berkembang hingga ke sektor perhotelan, menyewa satu lantai hotel, dan kemudian seluruh gedung. Hotel yang dikelolanya menjadi tempat menginap bagi tokoh nasional seperti Aburizal Bakrie, Megawati Soekarnoputri, dan Gus Dur.</p>
                            <p>Sikap amanah beliau tercermin dalam pelunasan utang modal kepada mantan majikan, meskipun telah diikhlaskan. Setelah sukses di bidang perhotelan, beliau melebarkan sayap ke sektor agribisnis, properti, dan kuliner.</p>
                        </div>
                    </div>
                </div>

                {{-- Chapter 2 --}}
                <div data-reveal class="relative pl-14 sm:pl-16">
                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-full border-2 border-cream-300 bg-maroon-700 font-display text-lg font-semibold text-cream-50 shadow-sm sm:h-12 sm:w-12">2</div>
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <h3 class="font-display text-xl font-semibold text-maroon-800">Kelahiran Catering Al-Haidari dan Bisnis Kuliner</h3>
                        <div class="prose mt-3 max-w-none prose-p:text-stone-600 prose-strong:text-maroon-800">
                            <p>Keberhasilan beliau dalam dunia bisnis diperkuat dengan mendirikan <strong>Catering Al-Haidari</strong>, yang menjadi salah satu penyedia makanan terkemuka di Kota Madinah. Catering ini melayani hotel bintang 3 hingga 5 serta berbagai travel haji dan umrah, termasuk First Travel.</p>
                            <p>Selain jamaah Indonesia, Catering Al-Haidari juga melayani jamaah asal Turki, Thailand, dan India. Beliau kemudian membuka <strong>Restoran Indonesia Pesanggrahan</strong> dan <strong>Bakso Si Adoel</strong> di Hotel Royal Andalus, Madinah&mdash;yang viral saat musim haji. Nama 'Si Adoel' terinspirasi dari Si Doel Anak Betawi dan merepresentasikan semangat Karawang.</p>
                        </div>
                    </div>
                </div>

                {{-- Chapter 3 --}}
                <div data-reveal class="relative pl-14 sm:pl-16">
                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-full border-2 border-cream-300 bg-maroon-700 font-display text-lg font-semibold text-cream-50 shadow-sm sm:h-12 sm:w-12">3</div>
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <h3 class="font-display text-xl font-semibold text-maroon-800">Berdirinya PT. Haifa Nida Wisata Karawang</h3>
                        <div class="prose mt-3 max-w-none prose-p:text-stone-600 prose-strong:text-maroon-800">
                            <p>Berbekal pengalaman di sektor perhotelan dan catering, pada tahun 2007 beliau mendirikan PT. Haifa Nida Wisata. Setelah menyelesaikan studi S3 pada 2008, beliau pulang ke Indonesia dan mengembangkan bisnis travel lebih serius. Pada 2010, perusahaan mengajukan izin sebagai Penyelenggara Perjalanan Ibadah Umrah (PPIU).</p>
                            <p>Karena kendala administratif, nama perusahaan diubah menjadi <strong>PT. Haifa Nida Wisata Karawang</strong> pada 24 Agustus 2011. Izin resmi PPIU diperoleh pada tahun 2012. Dalam perpanjangan izin tahun 2017, Haifa Nida mendapatkan <strong>akreditasi B</strong> dan pada 2025 berhasil meraih <strong>akreditasi A</strong>.</p>
                        </div>
                    </div>
                </div>

                {{-- Chapter 4 --}}
                <div data-reveal class="relative pl-14 sm:pl-16">
                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-full border-2 border-cream-300 bg-maroon-700 font-display text-lg font-semibold text-cream-50 shadow-sm sm:h-12 sm:w-12">4</div>
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <h3 class="font-display text-xl font-semibold text-maroon-800">Keunggulan dan Legalitas</h3>
                        <div class="prose mt-3 max-w-none prose-p:text-stone-600 prose-strong:text-maroon-800">
                            <p>Haifa Nida Wisata merupakan biro perjalanan haji dan umrah pertama di Karawang yang berizin resmi dan terakreditasi. Perusahaan juga tengah memproses izin <strong>Penyelenggara Ibadah Haji Khusus (PIHK)</strong> serta <strong>keanggotaan IATA</strong>.</p>
                            <p>Perusahaan memiliki 10 Tour Leader bersertifikasi BNSP, Tour Guide profesional, serta pembimbing dan Muthowif/Muthowifah yang berpengalaman.</p>
                        </div>
                    </div>
                </div>

                {{-- Chapter 5 --}}
                <div data-reveal class="relative pl-14 sm:pl-16">
                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-full border-2 border-cream-300 bg-maroon-700 font-display text-lg font-semibold text-cream-50 shadow-sm sm:h-12 sm:w-12">5</div>
                    <div class="rounded-2xl border border-cream-200 bg-cream-50 p-6 shadow-sm">
                        <h3 class="font-display text-xl font-semibold text-maroon-800">Jaringan Usaha dan Lokasi Kantor</h3>
                        <div class="prose mt-3 max-w-none prose-p:text-stone-600 prose-strong:text-maroon-800">
                            <p>Sejak berdiri, lebih dari <strong>100.000 jamaah</strong> telah diberangkatkan ke tanah suci oleh PT. Haifa Nida Wisata Karawang. Kantor pusat kami berlokasi di samping Islamic Center Al Jihad, Jl. R.A. Kartini No. 1, Kelurahan Karangpawitan, Karawang.</p>
                            <p>Nama &ldquo;Haifa Nida&rdquo; merupakan singkatan dari nama anak-anak pendiri: <strong>Haitsam, Iyad, Aufa, Nidzom, dan Dafiq</strong>. Filosofi ini mencerminkan nilai keluarga, keberkahan, dan tanggung jawab dalam pelayanan.</p>
                            <p>Selain menjalankan perusahaan, Dr. Fakhrurrozi juga aktif sebagai Ketua Komunitas Pengusaha Muslim Indonesia (KPMI) Karawang, untuk membina pengusaha muslim berbasis nilai-nilai Islam.</p>
                        </div>
                    </div>
                </div>

                {{-- Chapter 6 --}}
                <div data-reveal class="relative pl-14 sm:pl-16">
                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-full border-2 border-cream-300 bg-maroon-700 shadow-sm sm:h-12 sm:w-12"><i class="bx bxs-star text-lg text-cream-50"></i></div>
                    <div class="rounded-2xl border border-maroon-200 bg-maroon-900 p-6 text-cream-50 shadow-sm">
                        <h3 class="font-display text-xl font-semibold">Komitmen Kami</h3>
                        <p class="mt-3 text-cream-200/90">PT. Haifa Nida Wisata Karawang berkomitmen memberikan layanan terbaik dengan prinsip:</p>
                        <ul class="mt-4 grid gap-3 sm:grid-cols-2">
                            @foreach ([
                                ['Aman', 'Legalitas dan kepercayaan jamaah adalah prioritas utama.'],
                                ['Nyaman', 'Layanan terbaik dengan fasilitas berkualitas.'],
                                ['Amanah', 'Dijalankan dengan integritas dan tanggung jawab.'],
                                ['Profesional', 'Tim bersertifikasi dan berpengalaman.'],
                                ['Berkah', 'Menjadikan perjalanan ibadah penuh nilai spiritual.'],
                            ] as [$prinsip, $makna])
                                <li class="flex items-start gap-2.5">
                                    <i class="bx bx-check-circle mt-0.5 text-cream-400"></i>
                                    <span class="text-sm text-cream-100"><strong class="font-semibold text-cream-50">{{ $prinsip }}</strong> &mdash; {{ $makna }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <p class="mt-4 text-cream-200/90">Kami hadir untuk memastikan perjalanan ibadah Anda lebih khusyu&rsquo;, nyaman, dan bermakna.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-cream-50 py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4">
            <div data-reveal class="mb-10 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Mengapa Haifa</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900 sm:text-3xl">Keunggulan Kami</h2>
            </div>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    ['icon' => 'bx-shield-quarter', 'title' => 'Keamanan & Kenyamanan', 'desc' => 'Kami menjamin perjalanan ibadah yang aman dengan layanan premium.'],
                    ['icon' => 'bx-group', 'title' => 'Pembimbing Berpengalaman', 'desc' => 'Dibimbing oleh ustadz dan tenaga profesional yang berpengalaman.'],
                    ['icon' => 'bx-money', 'title' => 'Harga Kompetitif', 'desc' => 'Paket perjalanan dengan harga terbaik tanpa mengurangi kualitas layanan.'],
                    ['icon' => 'bx-hotel', 'title' => 'Hotel Dekat Masjid', 'desc' => 'Akomodasi terbaik di sekitar Masjidil Haram dan Masjid Nabawi.'],
                    ['icon' => 'bxs-plane', 'title' => 'Penerbangan Langsung', 'desc' => 'Penerbangan langsung dari Jakarta ke Jeddah atau Madinah.'],
                ] as $item)
                    <div data-reveal data-reveal-delay="{{ ($loop->index % 3) * 0.08 }}"
                        class="group rounded-2xl border border-cream-200 bg-cream-50 p-6 text-center shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-maroon-100 text-2xl text-maroon-700 transition-colors group-hover:bg-maroon-700 group-hover:text-cream-50">
                            <i class="bx {{ $item['icon'] }}"></i>
                        </div>
                        <h3 class="mb-1 font-semibold text-maroon-900">{{ $item['title'] }}</h3>
                        <p class="text-sm text-stone-600">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
