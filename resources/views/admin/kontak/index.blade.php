@extends('adminlte::page')

@section('title', 'Kontak')

@section('content_header')
    <h1>Daftar Kontak</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="daftar-kontak" class="table table-bordered">
                       <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                       </thead>
                       <tbody>
                           @foreach ($kontak as $k)
                            <tr>
                                <td>{{ $loop->iteration.'.' }}</td>
                                <td>{{ $k->key }}</td>
                                <td>{{ $k->value }}</td>
                                <td>
                                    <a href="{{ route('admin.kontak.edit', $k->key) }}" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-pen mr-2"></i>
                                        Edit
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
        new DataTable('#daftar-kontak', {
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
