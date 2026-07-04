<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Haifa Nida Admin | {{ $title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="icon" type="image/png" href="/assets/img/logos/logo.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('style')
</head>

<body class="min-h-screen bg-maroon-950 text-stone-800">
    <x-alert-flash />

    <div class="flex min-h-screen items-center justify-center px-4 py-10">
        @yield('content')
    </div>

    @yield('script')
</body>

</html>
