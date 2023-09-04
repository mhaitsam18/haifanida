@extends('adminlte::page')

@section('title', 'FAQ')

@section('content_header')
<h1>Daftar FAQ</h1>
@stop

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i>
            Tambah FAQ baru
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="daftar-faq" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faq as $f)
                        <tr>
                            <td>{{ $loop->iteration.'.' }}</td>
                            <td>{{ $f->pertanyaan }}</td>
                            <td>{{ $f->jawaban }}</td>
                            <td>
                                <a href="{{ route('admin.faq.edit', $f->id) }}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-pen mr-2"></i>
                                    Edit
                                </a>

                                <form action="{{ route('admin.faq.destroy', $f->id) }}" method="post" id="form-hapus" class="d-inline-block">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash mr-2"></i>
                                        Hapus
                                    </button>
                                </form>
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
    new DataTable('#daftar-faq', {
            responsive: true,
            autoWidht: false,
            columnDefs: [{
                orderable: false,
                width: "18%",
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
