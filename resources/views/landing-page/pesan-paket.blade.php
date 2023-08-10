@extends('layouts.landing-page')

@section('title', 'Pesan Paket')

@section('content')
<section class="module">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1 mb-sm-40">
                <h4 class="font-alt">Detail Paket</h4>
                <hr class="divider-w mb-10">

            </div>
            <div class="col-sm-5">
                <h4 class="font-alt">Form Pemesanan</h4>
                <hr class="divider-w mb-10">
                <form class="form">
                    <div class="form-group">
                        <span>Jenis Kamar</span>
                        <div>
                            <input type="radio" name="jenis-kamar" value="single" id="single" class="mb-1">
                            <label for="single">Single</label>
                        </div>
                        <div>
                            <input type="radio" name="jenis-kamar" value="couple" id="couple" class="mb-1">
                            <label for="couple">Couple</label>
                        </div>
                        <div>
                            <input type="radio" name="jenis-kamar" value="quad" id="quad" class="mb-1">
                            <label for="quad">Quad</label>
                        </div>
                    </div>
                    <div id="data-jemaah-wrapper">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <strong>Jemaah 1</strong>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="jemaah[]" placeholder="Nama jemaah"/>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" name="jenis-kelamin[]">
                                    <option value="">Jenis kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-round btn-b">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
{{--
<link href="/lib/animate.css/animate.css" rel="stylesheet">
<link href="/lib/et-line-font/et-line-font.css" rel="stylesheet">
<link href="/lib/flexslider/flexslider.css" rel="stylesheet">
<link href="/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
<link href="/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
<link href="/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
<link href="/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet"> --}}
@endsection

@section('js')
    <script>
        const input = (i) => {
            return `<div class="form-group row">
                            <div class="col-sm-12">
                                <strong>Jemaah ${i}</strong>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="jemaah[]" placeholder="Nama jemaah"/>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" name="jenis-kelamin[]">
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>`;
        }

        const wrapper = document.querySelector('#data-jemaah-wrapper');
        const singleInput = document.querySelector('#single');
        const coupleInput = document.querySelector('#couple');
        const quadInput   = document.querySelector('#quad');

        const generateInput = (jumlah) => {
            let el = '';

            for(let i = 0; i < jumlah; i++) {
                el += input(i+1);
            }

            wrapper.innerHTML = el;
        }

        singleInput.addEventListener('change', (event) => {
            generateInput(1);
        });

        coupleInput.addEventListener('change', (event) => {
            generateInput(2);
        });

        quadInput.addEventListener('change', (event) => {
            generateInput(4);
        });

    </script>

{{-- <script src="/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
<script src="/lib/isotope/dist/isotope.pkgd.js"></script>
<script src="/lib/imagesloaded/imagesloaded.pkgd.js"></script>
<script src="/lib/flexslider/jquery.flexslider.js"></script>
<script src="/lib/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
<script src="/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script> --}}
@endsection
