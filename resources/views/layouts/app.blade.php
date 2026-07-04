<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="{{ $titlemeta ?? 'Haifa Nida Wisata | Umroh dan Haji' }}">
    <meta property="og:description"
        content="{{ $descriptionmeta ?? 'Haifa Nida Wisata adalah travel haji dan umroh terpercaya, berlandaskan Al-Qur\'an dan As-Sunnah. Komitmen kami adalah memberikan pelayanan terbaik yang aman, nyaman, dan penuh keberkahan bagi tamu-tamu Allah.' }}">
    <meta name="description"
        content="Haifa Nida Wisata adalah travel haji dan umroh terpercaya, berlandaskan Al-Qur'an dan As-Sunnah. Komitmen kami adalah memberikan pelayanan terbaik yang aman, nyaman, dan penuh keberkahan bagi tamu-tamu Allah.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="icon" type="image/png" href="/assets/img/logos/logo.png">
    <title>{{ $title }} | Haifa Nida Wisata</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('style')
</head>

<body class="min-h-screen bg-cream-100 text-stone-800">
    <x-alert-flash />

    @include('layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @yield('script')
    @yield('modal')
</body>

</html>
