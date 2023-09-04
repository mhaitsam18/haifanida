@extends('layouts.landing-page')

@section('title', 'Beranda')

@section('banner', '/img/banner.png')

@section('h1', 'Haifa Nida Wisata')
@section('sub-h1', 'Solusi mudah ke Baitullah')

@section('content')
<section class="module-extra-small">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Daftar Paket</h2>
            </div>
        </div>

        <div class="row multi-columns-row post-columns">

            @foreach ($paket as $p)
            <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="post">
                    <div class="post-thumbnail"><a href="{{ route('paket', ['paket' => $p]) }}"><img
                                src="{{ asset('img/paket/'.$p->image) }}" alt="Thumbnail Paket"
                                style="aspect-ratio: 40/23; object-fit: cover;" /></a>
                    </div>
                    <div class="post-header" style="font-size: 1.4rem">
                        <h2 class="post-title" style="font-size: 1.6rem"><a
                                href="{{ route('paket', ['paket' => $p]) }}">{{ $p->nama }}</a></h2>
                        <div class="text-capitalize"><strong>{{ rupiah($p->harga_single) }} | {{ $p->keberangkatan
                                }}</strong></div>
                        <div class="text-capitalize"> Hotel Mekah: {{ $p->hotelMekah->nama }}</div>
                        <div class="text-capitalize"> Hotel Madinah: {{ $p->hotelMadinah->nama }}</div>
                    </div>
                    <div class="post-entry">
                        <p>{{ Str::limit($p->keterangan, 80, '...') }}</p>
                    </div>
                    <div class="post-more"><a class="btn btn-block btn-d"
                            href="{{ route('paket', ['paket' => $p]) }}">Lihat detail</a></div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="row">
            <div class="col-12">
                <center>
                    <a href="{{ route('daftar-paket') }}" class="btn btn-primary">
                        Lihat lebih banyak paket
                    </a>
                </center>
            </div>
        </div>
</section>

<section class="module bg-dark-60 pt-0 pb-0 parallax-bg testimonial" data-background="assets/images/testimonial_bg.jpg">
    <div class="testimonials-slider pt-140 pb-140">
        <ul class="slides">
            @foreach ($testimoni as $t)
            <li>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="module-icon"><span class="icon-quote"></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <blockquote class="testimonial-text font-alt">
                                {{ $t->testimoni }}
                            </blockquote>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="testimonial-author">
                                <div class="testimonial-caption font-alt">
                                    <div class="testimonial-title">{{ $t->pelanggan->user->name }}</div>
                                    <div class="testimonial-descr">
                                        @php
                                        $rating = $t->rating;
                                        @endphp

                                        @for ($i = 0; $i < $rating; $i++) <i class="fa fa-star"></i>
                                            @endfor

                                            @for ($i = 0; $i < 5-$rating; $i++) <i class="fa fa-star-o"></i>
                                                @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>

<section class="module">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">FAQ</h2>
                <div class="module-subtitle font-serif">Pertanyaan yang sering ditanyakan</div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                @foreach ($faq as $f)
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title font-alt"><a data-toggle="collapse" data-parent="#accordion"
                                    href="{{ " #sales".$loop->iteration }}">{{ $f->pertanyaan }}</a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="{{ " sales".$loop->iteration }}">
                            <div class="panel-body">
                                {{ $f->jawaban }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<link href="/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/lib/animate.css/animate.css" rel="stylesheet">
<link href="/lib/et-line-font/et-line-font.css" rel="stylesheet">
<link href="/lib/flexslider/flexslider.css" rel="stylesheet">
<link href="/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
<link href="/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
<link href="/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
<link href="/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
@endsection

@section('js')
<script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
<script src="/lib/isotope/dist/isotope.pkgd.js"></script>
<script src="/lib/imagesloaded/imagesloaded.pkgd.js"></script>
<script src="/lib/flexslider/jquery.flexslider.js"></script>
<script src="/lib/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
<script src="/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
@endsection
