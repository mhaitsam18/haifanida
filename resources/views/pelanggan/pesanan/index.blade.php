@extends('adminlte::page')

@section('title', 'Pesanan')

@section('content_header')
    <h1>Daftar Paket yang Dipesan</h1>
@stop

@section('content')
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
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                       </thead>
                       <tbody>
                           @foreach ($pesanan as $p)
                            <tr>
                                <td>{{ $loop->iteration.'.' }}</td>
                                <td>{{ $p->paket->nama }}</td>
                                <td>{{ $p->paket->keberangkatan }}</td>
                                <td>{{ $p->jumlah }}</td>
                                <td>
                                    <a href="{{ route('pelanggan.pesanan.show', $p->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye mr-2"></i>
                                        Lihat detail
                                    </a>
                                </td>
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
                targets: 4
            }]
        });
    </script>
@endsection
