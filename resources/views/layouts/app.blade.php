<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $metaTitle = ($titlemeta ?? ($title ?? 'Umroh dan Haji')) . ' | Haifa Nida Wisata';
        $metaDescription = $descriptionmeta ?? 'Haifa Nida Wisata adalah travel haji dan umroh terpercaya, berlandaskan Al-Qur\'an dan As-Sunnah. Komitmen kami adalah memberikan pelayanan terbaik yang aman, nyaman, dan penuh keberkahan bagi tamu-tamu Allah.';
        $metaImage = url('assets/img/hero/haram-far.jpg');
        $canonical = url()->current();

        $organizationLd = [
            '@context' => 'https://schema.org',
            '@type' => 'TravelAgency',
            'name' => 'PT. Haifa Nida Wisata Karawang',
            'description' => 'Travel haji, umroh, dan wisata halal terpercaya di Karawang sejak 2007.',
            'url' => url('/'),
            'logo' => url('assets/img/logos/logo-full.png'),
            'image' => $metaImage,
            'telephone' => '+62-822-9919-8002',
            'email' => 'cs@haifanida.id',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. R.A. Kartini No. 1, Karangpawitan',
                'addressLocality' => 'Karawang',
                'addressRegion' => 'Jawa Barat',
                'postalCode' => '41315',
                'addressCountry' => 'ID',
            ],
            'foundingDate' => '2007',
            'sameAs' => [
                'https://www.facebook.com/haifanidaofficial',
                'https://instagram.com/haifanidaofficial',
                'https://www.tiktok.com/@haifanidaofficial',
                'https://www.linkedin.com/company/pt-haifa-nida-wisata/',
            ],
        ];
    @endphp

    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="canonical" href="{{ $canonical }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Haifa Nida Wisata">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $metaImage }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImage }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="icon" type="image/png" href="/assets/img/logos/logo.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('style')

    {{-- Structured data: identifies the organization to search engines. --}}
    <script type="application/ld+json">
        {!! json_encode($organizationLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
</head>

<body class="min-h-screen bg-cream-100 text-stone-800">
    {{-- Skip link: first focusable element, lets keyboard/AT users jump past the nav. --}}
    <a href="#main" class="sr-only rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-100">
        Lewati ke konten utama
    </a>

    <x-alert-flash />

    @include('layouts.partials.navbar')

    <main id="main">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @yield('script')
    @yield('modal')
</body>

</html>
