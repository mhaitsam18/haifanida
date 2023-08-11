@extends('layouts.landing-page')

@section('title', 'Daftar Paket')

@section('h1', 'Daftar Paket')

@section('content')
<section class="module-extra-small">
    <div class="container">
        <form action="{{ route('daftar-paket') }}" method="GET" class="row">
            <div class="col-sm-3 mb-sm-20">
                <select name="jenis-paket" class="form-control">
                    <option value="">Jenis Paket</option>
                    <option value="haji">Haji</option>
                    <option value="umrah">Umrah</option>
                </select>
            </div>
            <div class="col-sm-3 mb-sm-20">
                <select name="rentang-harga" class="form-control">
                    <option value="">Rentang harga</option>
                    <option value="2">Rp20.000.000,00 s.d. Rp30.000.000,00</option>
                    <option value="3">Rp31.000.000,00 s.d. Rp40.000.000,00</option>
                    <option value="4">Rp41.000.000,00 s.d. Rp50.000.000,00</option>
                    <option value="5">Rp51.000.000,00 s.d. Rp60.000.000,00</option>
                    <option value="6">Rp61.000.000,00 s.d. Rp70.000.000,00</option>
                    <option value="7">Rp71.000.000,00 s.d. Rp80.000.000,00</option>
                    <option value="8">Rp81.000.000,00 s.d. Rp90.000.000,00</option>
                    <option value="9">Rp91.000.000,00 s.d. Rp100.000.000,00</option>
                </select>
            </div>
            <div class="col-sm-3 mb-sm-20">
                <input type="text" name="tanggal" class="form-control" placeholder="Rentang tanggal">
            </div>
            <div class="col-sm-3">
                <button class="btn btn-block btn-round btn-g" type="submit">Cari</button>
            </div>
        </form>
    </div>
</section>

<hr class="divider-w">

<section class="module-extra-small">
    <div class="container">
        <div class="row multi-columns-row post-columns">

            @foreach ($paket as $p)
            <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="post">
                    <div class="post-thumbnail"><a href="{{ route('paket', ['paket' => $p]) }}"><img src="/img/post-4.jpg" alt="Thumbnail Paket" /></a>
                    </div>
                    <div class="post-header" style="font-size: 1.4rem">
                        <h2 class="post-title" style="font-size: 1.6rem"><a href="{{ route('paket', ['paket' => $p]) }}">{{ $p->nama }}</a></h2>
                        <div class="text-capitalize"><strong>{{ rupiah($p->harga_single) }} | {{ $p->keberangkatan }}</strong></div>
                        <div class="text-capitalize"> Hotel Mekah: {{ $p->hotelMekah->nama }}</div>
                        <div class="text-capitalize"> Hotel Madinah: {{ $p->hotelMadinah->nama }}</div>
                    </div>
                    <div class="post-entry">
                        <p>{{ Str::limit($p->keterangan, 80, '...') }}</p>
                    </div>
                    <div class="post-more"><a class="btn btn-block btn-d" href="{{ route('paket', ['paket' => $p]) }}">Lihat detail</a></div>
                </div>
            </div>
            @endforeach

            {{-- <div class="pagination font-alt"><a href="#"><i class="fa fa-angle-left"></i></a><a class="active"
                    href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#"><i
                        class="fa fa-angle-right"></i></a></div> --}}
        </div>
</section>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $('input[name="tanggal"]').daterangepicker({
            autoUpdateInput: false,
            minYear: (new Date()).getFullYear(),
            locale: {
                format: 'DD-MM-YYYY',
                applyLabel: 'Pilih',
                cancelLabel: 'Batal',
            }
        });

        $('input[name="tanggal"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' s.d. ' + picker.endDate.format('DD-MM-YYYY'));
        });
</script>
@endsection
