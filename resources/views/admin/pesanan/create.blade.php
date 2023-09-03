@extends('adminlte::page')

@section('title', 'Buat Pesanan')

@section('content_header')
    <h1>Buat Pesanan Baru</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.pesanan.store') }}" method="POST">
                        @csrf

                        <x-adminlte-input name="email" type="email" label="Email Pelanggan" error-key="email" enable-old-support="true" required></x-adminlte-input>

                        <div class="form-group">
                            <span>Jenis Kamar</span>
                            <div>
                                <input type="radio" name="jenis-kamar" value="single" id="single" class="mb-1" required checked>
                                <label for="single">Single</label>
                            </div>
                            <div>
                                <input type="radio" name="jenis-kamar" value="couple" id="couple" class="mb-1" required>
                                <label for="couple">Couple</label>
                            </div>
                            <div>
                                <input type="radio" name="jenis-kamar" value="quad" id="quad" class="mb-1" required>
                                <label for="quad">Quad</label>
                            </div>
                        </div>

                        <x-adminlte-select2 name="paket" label="Paket" error-key="paket" enable-old-support="true" required>
                            <option value="0">Pilih Paket</option>
                            @foreach ($paket as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </x-adminlte-select2>

                        <x-adminlte-input name="harga" type="number" label="Total Harga Paket" error-key="harga" enable-old-support="true"></x-adminlte-input>

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

                        <div>
                            <x-adminlte-button label="Kirim" theme="primary" type="submit" icon="fas fa-paper-plane mr-2"></x-adminlte-button>
                            <a href="{{ route('admin.pesanan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('plugins.Select2', true)

@section('js')
    <script>
        @if (request()->session()->has('alert'))
            Swal.fire({
                icon: '{{ session('alert-class') }}',
                title: '{{ session('alert')[0] }}',
                text: '{{ session('alert')[1] }}',
            });
        @endif

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
        });

        coupleInput.addEventListener('change', (event) => {
            generateInput(2);
        });

        quadInput.addEventListener('change', (event) => {
            generateInput(4);
        });
    </script>
@endsection
