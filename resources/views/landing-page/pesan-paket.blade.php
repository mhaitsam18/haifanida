@extends('layouts.landing-page')

@section('title', 'Pesan Paket')

@section('content')
<section class="module">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1 mb-sm-40">
                <h4 class="font-alt">Detail Paket</h4>
                <hr class="divider-w mb-10">

                <div>
                    @isset($paket->image)
                        <img src="" alt="">
                    @endisset
                </div>

                <div class="mb-1">
                    <p class="mb-0"><strong>Nama Paket</strong></p>
                    <p>{{ $paket->nama }}</p>

                    <p class="mb-0"><strong>Lama Program</strong></p>
                    <p>{{ $paket->jumlah_hari }} Hari</p>

                    <p class="mb-0"><strong>Tanggal Keberangkatan</strong></p>
                    <p>{{ $paket->keberangkatan }}</p>

                    <p class="mb-0"><strong>Hotel Mekah</strong></p>
                    <p>{{ $paket->hotelMekah->nama }}/Setara | &starf; {{ $paket->hotelMekah->bintang }}/5</p>

                    <p class="mb-0"><strong>Hotel Madinah</strong></p>
                    <p>{{ $paket->hotelMadinah->nama }}/Setara | &starf; {{ $paket->hotelMadinah->bintang }}/5</p>

                    <p class="mb-0"><strong>Maskapai</strong></p>
                    <p>{{ $paket->maskapai->nama }}</p>
                </div>

                <div>
                    <p>{{ $paket->keterangan }}</p>
                </div>
            </div>
            <div class="col-sm-5">
                <h4 class="font-alt">Form Pemesanan</h4>
                <hr class="divider-w mb-10">
                <form action="{{ route('pelanggan.paket.store') }}" method="POST" class="form">
                    @csrf
                    <input type="hidden" name="paket" value="{{ $paket->id }}">
                    <div class="form-group">
                        <span>Jenis Kamar</span>
                        <div>
                            <input type="radio" name="jenis-kamar" value="single" id="single" class="mb-1" data-harga="{{ $paket->harga_single }}" required checked>
                            <label for="single">Single ({{ rupiah($paket->harga_single) }} per pax)</label>
                        </div>
                        <div>
                            <input type="radio" name="jenis-kamar" value="couple" id="couple" class="mb-1" data-harga="{{ $paket->harga_couple }}" required>
                            <label for="couple">Couple ({{ rupiah($paket->harga_couple) }} per pax)</label>
                        </div>
                        <div>
                            <input type="radio" name="jenis-kamar" value="quad" id="quad" class="mb-1" data-harga="{{ $paket->harga_quad }}" required>
                            <label for="quad">Quad ({{ rupiah($paket->harga_quad) }} per pax)</label>
                        </div>
                    </div>
                    <div id="data-jemaah-wrapper">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <strong>Jemaah 1</strong>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control jemaah" type="text" name="jemaah[]" placeholder="Nama jemaah"/>
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
                        <p><strong>Total: Rp<span id="total"></span>,00</strong></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')

@endsection

@section('js')
    <script>
        const hitungTotal = () => {
            const jemaah = document.getElementsByClassName('jemaah');
            const harga  = document.querySelector('input[type="radio"]:checked').dataset.harga;
            let total  = 0;

            for (let i of jemaah) {
                if (i.value != '') {
                    total += parseInt(harga);
                }
            }

            document.querySelector('#total').innerText = total;
        }

        const bindEvent = () => {
            const jemaah = document.getElementsByClassName('jemaah');
            for (let i of jemaah) {
                i.addEventListener('input',(event)  => {
                    hitungTotal();
                });
            }
        }

        window.onload = (event) => {
            hitungTotal();
            bindEvent();
        }

        const input = (i) => {
            return `<div class="form-group row">
                            <div class="col-sm-12">
                                <strong>Jemaah ${i}</strong>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control jemaah" type="text" name="jemaah[]" placeholder="Nama jemaah"/>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" name="jenis-kelamin[]">
                                    <option value="">Jenis kelamin</option>
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
            bindEvent();
            hitungTotal();
        });

        coupleInput.addEventListener('change', (event) => {
            generateInput(2);
            bindEvent();
            hitungTotal();
        });

        quadInput.addEventListener('change', (event) => {
            generateInput(4);
            bindEvent();
            hitungTotal();
        });



    </script>
@endsection
