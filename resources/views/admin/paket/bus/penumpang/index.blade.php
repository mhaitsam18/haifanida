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
                        <h6 class="card-title mb-2">{{ $title }}</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-2 mt-2">Data Penumpang</h4>
                            <a href="/admin/bus/{{ $bus->id }}/penumpang/create" class="btn btn-sm btn-langit mb-3"><i
                                    data-feather="plus" class="icon-sm me-2"></i> Tambah Data Penumpang</a>
                            @if ($bus)
                                <a class="btn btn-sm btn-secondary mb-3" href="/admin/paket/{{ $bus->paket_id }}/bus">
                                    <span class="">Kembali</span>
                                </a>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="dataTableExample">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nomor Kursi</th>
                                            <th class="pt-0">Nama Penumpang</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penumpangs as $penumpang)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $penumpang->nomor_kursi }}</td>
                                                <td>{{ $penumpang->jemaah->nama_lengkap }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center ">
                                                        <a href="/admin/penumpang/{{ $penumpang->id }}/edit"
                                                            class="badge bg-success d-inline-block ms-1">Edit</a>
                                                        <form action="/admin/penumpang/{{ $penumpang->id }}" method="post">
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
            </div>
        </div>
    </div> <!-- row -->
@endsection
