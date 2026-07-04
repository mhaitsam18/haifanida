<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="icon" type="image/png" href="/assets/img/logos/logo.png">
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css'])
</head>

<body class="flex min-h-screen items-center justify-center bg-cream-100 px-4 text-stone-800">
    <div class="w-full max-w-md text-center">
        <img src="/assets/img/logos/logo-lanskap-2.png" alt="Haifa Nida Wisata" class="mx-auto mb-6 h-16 w-auto">
        <i class="bx bx-time-five text-5xl text-maroon-700"></i>
        <h1 class="font-display mt-3 text-xl font-semibold text-maroon-900">{{ $judul }}</h1>
        <p class="mt-2 text-sm text-stone-500">{{ $pesan }}</p>
        <a href="/" class="mt-6 inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-5 py-2.5 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
            <i class="bx bx-home"></i> Kembali ke Beranda
        </a>
    </div>
</body>

</html>
