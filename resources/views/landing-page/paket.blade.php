@extends('layouts.landing-page')

@section('title', $paket->nama)

@section('content')
{{-- <form action="{{ route('pelanggan.paket') }}" method="POST" name="pesan-paket" id="pesan-paket">@csrf</form> --}}

<section class="module">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mb-sm-40"><a class="gallery" href="{{ asset('img/paket/'.$paket->image) }}"><img
                        src="{{ asset('img/paket/'.$paket->image) }}" alt="Single Product Image" /></a>
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
                        <div class="price">
                            <p class="mb-0">Harga mulai dari</p>
                            <p class="mb-0" style="font-size: 2rem">{{ rupiah($paket->harga_single) }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="description">
                            <div>
                                <p class="mb-0">Hotel Mekah: </p>
                                <p class="mb-0">{{ $paket->hotelMekah->nama }}/Setara | &starf; {{ $paket->hotelMekah->bintang }}/5</p>
                                <p>{{ $paket->hotelMekah->alamat }}</p>
                            </div>
                            <div>
                                <p class="mb-0">Hotel Madinah: </p>
                                <p class="mb-0">{{ $paket->hotelMadinah->nama }}/Setara | &starf; {{ $paket->hotelMadinah->bintang }}/5</p>
                                <p>{{ $paket->hotelMadinah->alamat }}</p>
                            </div>
                            <div>Maskapai: {{ $paket->maskapai->nama }}</div>
                            <div class="font-alt">
                                <strong>
                                    {{ $paket->keberangkatan }} | Program {{ $paket->jumlah_hari }} Hari
                                </strong>
                            </div>
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
                        <a href="{{ route('pelanggan.paket', ['paket' => $paket->id]) }}"
                            class="btn btn-lg btn-block btn-round btn-b">Pesan</a>
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
                    <li><a href="#syarat" data-toggle="tab"><span class="fa fa-file-text"
                                style="margin-right: 0.5rem"></span>Syarat</a></li>
                    <li><a href="#jadwal" data-toggle="tab"><span class="fa fa-calendar"
                                style="margin-right: 0.5rem"></span>Jadwal</a></li>
                    <li><a href="#barang" data-toggle="tab"><span class="fa fa-align-justify"
                                style="margin-right: 0.5rem"></span>Catatan</a></li>
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
                    <div class="tab-pane" id="syarat">
                        <div class="row">
                            <div class="col-sm-7">
                                <strong>Ketentuan pemesanan paket:</strong>
                                <ul>
                                    @foreach ($syarat as $s)
                                        <li>{{ $s->catatan  }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-sm-5">
                                <strong>Dokumen yang akan diperlukan:</strong>
                                <ul>
                                    @foreach ($dokumen as $d)
                                        <li>{{ $d->catatan  }}</li>
                                    @endforeach
                                </ul>

                                <small>*&#41; Bisa sekalian pesan layanan pembuatan paspor</small>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="jadwal">
                        <div class="row">
                            <div class="col-12">
                                <div class="panel-group">

                                    @for ($i = 0; $i < $jadwal->count(); $i += 2)

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title font-alt">Hari ke {!! intdiv($i, 2) + 1 !!} : {{
                                                    $jadwal->get($i)->catatan }}</h4>
                                            </div>
                                            <div class="panel-collapse collapse in" id="support1">
                                                <div class="panel-body">
                                                    {{ $jadwal->get($i + 1)->catatan }}
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="barang">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Barang yang boleh dibawah:</strong>
                                <ul>
                                    @foreach ($barangBoleh as $barang)
                                    <li>{{ $barang->catatan }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <strong>Barang yang tidak boleh dibawa:</strong>
                                <ul>
                                    @foreach ($barangDilarang as $barang)
                                    <li>{{ $barang->catatan }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
@if (request()->session()->has('alert'))
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.min.css">
@endif
@endsection

@section('js')
@if (request()->session()->has('alert'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.all.min.js"></script>
<script>
    window.onload = () => {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('alert') }}',
                    text: 'Selanjutnya Anda akan diundang ke grup WhatsApp dan melakukan penyelesaian registrasi seperti dokumen yang dibutuhkan dll.',
                    footer: '<a href="{{ session('link_grup') }}" target="_blank">Bergabung ke grup WA</a>'
                });
            }
</script>
@endif
@endsection
