<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | Admin Haifa Nida</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="icon" type="image/png" href="/assets/img/logos/logo.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('style')
</head>

<body class="bg-cream-100 text-stone-800">
    <x-alert-flash />

    <div class="flex min-h-screen flex-col lg:flex-row">
        @include('admin.layouts.partials.sidebar')

        <div class="flex min-h-screen flex-1 flex-col">
            @include('admin.layouts.partials.topbar')

            <main class="flex-1 p-4 sm:p-6">
                @yield('content')
            </main>

            <footer class="flex flex-col items-center justify-between gap-1 border-t border-cream-200 px-6 py-4 text-sm text-stone-500 sm:flex-row">
                <p>Copyright &copy; {{ date('Y') }} <a href="https://haifanida.com" target="_blank" class="hover:text-maroon-700">HaifaNida</a>.</p>
                <p>Handcrafted by Haitsam <i class="bx bxs-heart text-maroon-700"></i></p>
            </footer>
        </div>
    </div>

    @yield('modal')
    @yield('script')
</body>

</html>
