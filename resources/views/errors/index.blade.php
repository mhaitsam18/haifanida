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
</head>

<body>

    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner"></div>
            </div>
        </div>
    </div>
    @if ($code == '404')
        <div class="error-area">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="error-content">
                        <img src="/assets-techex-demo/images/404-error.jpg" alt="Image">
                        <h3>Ups! Halaman tidak ditemukan</h3>
                        <p>Halaman yang Anda cari mungkin telah dihapus karena namanya diubah atau untuk sementara tidak
                            tersedia karena sedang dalam proses penggarapan atau perbaikan.</p>
                        <a href="/" class="default-btn btn-bg-two">
                            Kembali ke Halaman Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @elseif($code == '403')
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                <img src="/assets-techex-demo/images/error-403.png" class="img-fluid mb-2" alt="403">
                <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">{{ $code }}</h1>
                <h4 class="mb-2">{{ $title }}</h4>
                <h6 class="text-muted mb-3 text-center">{{ $message }}</h6>
                <a href="/" class="btn btn-primary">Kembali ke beranda</a>
            </div>
        </div>
    @else
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                <img src="/assets-techex-demo/images/404-error.jpg" class="img-fluid mb-2" alt="500">
                <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">{{ $code }}</h1>
                <h4 class="mb-2">{{ $title }}</h4>
                <h6 class="text-muted mb-3 text-center">{{ $message }}</h6>
                <a href="/" class="btn btn-primary">Kembali ke beranda</a>
            </div>
        </div>
    @endif


    <div class="switch-box">
        <label id="switch" class="switch">
            <input type="checkbox" onchange="toggleTheme()" id="slider">
            <span class="slider round"></span>
        </label>
    </div>


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
</body>

</html>
