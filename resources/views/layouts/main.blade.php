<!doctype html>
<html lang="zxx">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets-techex-demo/css/bootstrap.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/animate.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/fonts/flaticon.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/boxicons.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets-techex-demo/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/magnific-popup.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/nice-select.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/meanmenu.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/style.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/responsive.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/theme-dark.css">

    <link rel="icon" type="image/png" href="/assets/img/logos/logo.png">
    <title>{{ $title }}</title>
    @yield('style')
</head>

<body>
    <div class="flash-data" data-success="{{ session()->get('success') }}"
        data-error="{{ $errors->any() ? 'Terjadi kesalahan!' : session()->get('error') }}"
        data-warning="{{ session()->get('warning') }}"></div>

    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner">
                    <img src="/assets/img/logos/logo.png">
                </div>
            </div>
        </div>
    </div>

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

    {{-- <div class="switch-box">
        <label id="switch" class="switch">
            <input type="checkbox" onchange="toggleTheme()" id="slider">
            <span class="slider round"></span>
        </label>
    </div> --}}


    <script src="/assets-techex-demo/js/jquery.min.js"></script>

    <script src="/assets-techex-demo/js/bootstrap.bundle.min.js"></script>

    <script src="/assets-techex-demo/js/owl.carousel.min.js"></script>

    <script src="/assets-techex-demo/js/jquery.magnific-popup.min.js"></script>

    <script src="/assets-techex-demo/js/jquery.nice-select.min.js"></script>

    <script src="/assets-techex-demo/js/wow.min.js"></script>

    <script src="/assets-techex-demo/js/meanmenu.js"></script>

    <script src="/assets-techex-demo/js/jquery.ajaxchimp.min.js"></script>

    <script src="/assets-techex-demo/js/form-validator.min.js"></script>

    <script src="/assets-techex-demo/js/contact-form-script.js"></script>

    <script src="/assets-techex-demo/js/custom.js"></script>

    <!-- End custom js for this page -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <!-- Misalnya, jika Anda menggunakan adapter untuk tampilan pratinjau -->
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>


    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const success = $('.flash-data').data('success');
        if (success) {
            //'Data ' +
            Swal.fire({
                title: 'Berhasil',
                text: success,
                icon: 'success'
            });
        }
        const error = $('.flash-data').data('error');
        if (error) {
            //'Data ' +
            Swal.fire({
                title: 'Gagal',
                text: error,
                icon: 'error'
            });
        }
        const warning = $('.flash-data').data('warning');
        if (warning) {
            //'Data ' +
            Swal.fire({
                title: 'Perhatian',
                text: warning,
                icon: 'warning'
            });
        }
        $('.access-denied').on('click', function(e) {
            e.preventDefault(); // Mencegah pengiriman formulir secara langsung

            //'Data ' +
            Swal.fire({
                title: 'Akses ditolak',
                text: 'Anda tidak memiliki otoritas untuk membuka fitur ini',
                icon: 'warning'
            });
        });
        $('.tombol-hapus').on('click', function(e) {
            e.preventDefault(); // Mencegah pengiriman formulir secara langsung

            const form = $(this).closest('form'); // Menemukan formulir terdekat

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                confirmButtonText: 'Hapus',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Mengirimkan formulir setelah konfirmasi
                }
            });
        });
    </script>

    @yield('script')
    @yield('modal')
</body>

</html>
