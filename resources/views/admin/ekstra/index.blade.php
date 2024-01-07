@extends('admin.layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            {{-- <h4 class="mb-3 mb-md-0">{{ $title }}</h4> --}}
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">{{ $title }}</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="tambah" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="tambah">
                                <a class="dropdown-item d-flex align-items-center" href="/admin/ekstra/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-haifa my-2" href="/admin/ekstra/create"><i data-feather="plus"
                            class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nama Ekstra</th>
                                    <th class="pt-0">Harga Bawaan</th>
                                    <th class="pt-0">Jenis Ekstra</th>
                                    <th class="pt-0">Deskripsi</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ekstras as $ekstra)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ekstra->nama_ekstra }}</td>
                                        <td>{{ $ekstra->harga_default }}</td>
                                        <td>{{ $ekstra->jenis_ekstra }}</td>
                                        <td>{{ $ekstra->deskripsi }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="/admin/ekstra/{{ $ekstra->id }}/edit"
                                                    class="badge bg-success d-inline-block m-1">Edit</a>
                                                <form action="/admin/ekstra/{{ $ekstra->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                        class="badge bg-danger d-inline-block ms-1 mb-1 badge-a tombol-hapus">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
