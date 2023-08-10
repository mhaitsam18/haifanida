@extends('layouts.landing-page')

@section('title', $paket->nama)

@section('content')
{{-- <form action="{{ route('pelanggan.paket') }}" method="POST" name="pesan-paket" id="pesan-paket">@csrf</form> --}}

<section class="module">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mb-sm-40"><a class="gallery" href="assets/images/shop/product-7.jpg"><img
                        src="assets/images/shop/product-7.jpg" alt="Single Product Image" /></a>
                <ul class="product-gallery">
                    <li><a class="gallery" href="assets/images/shop/product-8.jpg"></a><img
                            src="assets/images/shop/product-8.jpg" alt="Single Product" /></li>
                    <li><a class="gallery" href="assets/images/shop/product-9.jpg"></a><img
                            src="assets/images/shop/product-9.jpg" alt="Single Product" /></li>
                    <li><a class="gallery" href="assets/images/shop/product-10.jpg"></a><img
                            src="assets/images/shop/product-10.jpg" alt="Single Product" /></li>
                </ul>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="product-title font-alt">{{ $paket->nama }}</h1>
                    </div>
                </div>
                {{-- <div class="row mb-20">
                    <div class="col-sm-12"><span><i class="fa fa-star star"></i></span><span><i
                                class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i
                                class="fa fa-star star"></i></span><span><i class="fa fa-star star-off"></i></span><a
                            class="open-tab section-scroll" href="#reviews">-2customer reviews</a></div>
                </div> --}}
                <div class="row mb-20">
                    <div class="col-sm-12">
                        <div class="price font-alt"><span class="amount">{{ rupiah($paket->harga) }}</span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="description">
                            <p class="mb-0">Hotel Mekah: {{ $paket->hotelMekah->nama }}/Setara | &starf; {{ $paket->hotelMekah->bintang }}/5</p>
                            <p>Hotel Madinah: {{ $paket->hotelMadinah->nama }}/Setara | &starf; {{ $paket->hotelMadinah->bintang }}/5</p>
                            <p>Maskapai: {{ $paket->maskapai->nama }}</p>
                            <p class="font-alt mb-0"><strong>{{ $paket->keberangkatan }}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="row mb-20">
                    <div class="col-sm-12">
                        <div class="description">
                            <p>{{ $paket->keterangan }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-20">
                    <div class="col-sm-6">
                        <a href="{{ route('pelanggan.paket', ['paket' => $paket->id]) }}" class="btn btn-lg btn-block btn-round btn-b">Pesan</a>
                    </div>
                </div>
                {{-- <div class="row mb-20">
                    <div class="col-sm-12">
                        <div class="product_meta">Categories:<a href="#"> Man, </a><a href="#">Clothing, </a><a
                                href="#">T-shirts</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="row mt-70">
            <div class="col-sm-12">
                <ul class="nav nav-tabs font-alt" role="tablist">
                    <li class="active"><a href="#include" data-toggle="tab"><span class="fa fa-plus"
                                style="margin-right: 0.5rem"></span><i title="Termasuk" lang="en">Include</i></a></li>
                    {{-- <li><a href="#syarat" data-toggle="tab"><span class="fa fa-file-text"
                                style="margin-right: 0.5rem"></span>Syarat</a></li> --}}
                    {{-- <li><a href="#testimoni" data-toggle="tab"><span class="fa fa-comments"
                                style="margin-right: 0.5rem"></span>Testimoni</a></li> --}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="include">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Harga termasuk:</strong>
                                <ul>
                                    <li>Tiket pesawat</li>
                                    <li>Visa</li>
                                    <li>Makan 3&times; sehari</li>
                                    <li>Muthowif berbahasa Indonesia</li>
                                    <li>Tour & ziarah</li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <strong>Harga tidak termasuk:</strong>
                                <ul>
                                    <li>Perlengkapan, manasik, handling airport (1,5jt)</li>
                                    <li>Tour di luar paket</li>
                                    <li>Laundry</li>
                                    <li>dll</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="tab-pane" id="syarat">

                    </div> --}}
                    {{-- <div class="tab-pane" id="testimoni">
                        <div class="comments reviews">
                            <div class="comment clearfix">
                                <div class="comment-avatar"><img src="" alt="avatar" /></div>
                                <div class="comment-content clearfix">
                                    <div class="comment-author font-alt"><a href="#">John Doe</a></div>
                                    <div class="comment-body">
                                        <p>The European languages are members of the same family. Their separate
                                            existence is a myth. For science, music, sport, etc, Europe uses the same
                                            vocabulary. The European languages are members of the same family. Their
                                            separate existence is a myth.</p>
                                    </div>
                                    <div class="comment-meta font-alt">Today, 14:55 -<span><i
                                                class="fa fa-star star"></i></span><span><i
                                                class="fa fa-star star"></i></span><span><i
                                                class="fa fa-star star"></i></span><span><i
                                                class="fa fa-star star"></i></span><span><i
                                                class="fa fa-star star-off"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="comment clearfix">
                                <div class="comment-avatar"><img src="" alt="avatar" /></div>
                                <div class="comment-content clearfix">
                                    <div class="comment-author font-alt"><a href="#">Mark Stone</a></div>
                                    <div class="comment-body">
                                        <p>Europe uses the same vocabulary. The European languages are members of the
                                            same family. Their separate existence is a myth.</p>
                                    </div>
                                    <div class="comment-meta font-alt">Today, 14:59 -<span><i
                                                class="fa fa-star star"></i></span><span><i
                                                class="fa fa-star star"></i></span><span><i
                                                class="fa fa-star star"></i></span><span><i
                                                class="fa fa-star star-off"></i></span><span><i
                                                class="fa fa-star star-off"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-form mt-30">
                            <h4 class="comment-form-title font-alt">Add review</h4>
                            <form method="post">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="sr-only" for="name">Name</label>
                                            <input class="form-control" id="name" type="text" name="name"
                                                placeholder="Name" />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="sr-only" for="email">Name</label>
                                            <input class="form-control" id="email" type="text" name="email"
                                                placeholder="E-mail" />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected="true" disabled="">Rating</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="" name="" rows="4"
                                                placeholder="Review"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="btn btn-round btn-d" type="submit">Submit Review</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<link href="/lib/animate.css/animate.css" rel="stylesheet">
<link href="/lib/et-line-font/et-line-font.css" rel="stylesheet">
<link href="/lib/flexslider/flexslider.css" rel="stylesheet">
<link href="/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
<link href="/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
<link href="/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
<link href="/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
@endsection

@section('js')
<script src="/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
<script src="/lib/isotope/dist/isotope.pkgd.js"></script>
<script src="/lib/imagesloaded/imagesloaded.pkgd.js"></script>
<script src="/lib/flexslider/jquery.flexslider.js"></script>
<script src="/lib/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
<script src="/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
@endsection
