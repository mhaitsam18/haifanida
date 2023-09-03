@extends('adminlte::page')

@section('title', 'Pesanan')

@section('content_header')
    <h1>Daftar Pesanan</h1>
@stop

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.pesanan.create') }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i>
                Tambah Pesanan Baru
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="daftar-pesanan" class="table table-bordered">
                       <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Tanggal Keberangkatan</th>
                                <th>Pemesan</th>
                                <th>Jumlah</th>
                            </tr>
                       </thead>
                       <tbody>
                           @foreach ($pesanan as $p)
                            <tr>
                                <td>{{ $loop->iteration.'.' }}</td>
                                <td>{{ $p->paket->nama }}</td>
                                <td>{{ $p->paket->keberangkatan }}</td>
                                <td>{{ $p->pelanggan->user->name }}</td>
                                <td>{{ $p->jumlah }}</td>
                            </tr>
                            @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)

@section('js')
    <script>
        new DataTable('#daftar-pesanan', {
            responsive: true,
            autoWidht: false,
            columnDefs: [{
                orderable: false,
                targets: 3
            }]
        });

        @if (request()->session()->has('alert'))
            Swal.fire({
                icon: '{{ session('alert-class') }}',
                title: '{{ session('alert')[0] }}',
                text: '{{ session('alert')[1] }}',
            });
        @endif
    </script>
@endsection
