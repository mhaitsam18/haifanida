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
                    <a href="/admin/jemaah/{{ $jemaah->id }}/bus/create" class="btn btn-sm btn-langit mb-3"><i
                            data-feather="plus" class="icon-sm me-2"></i> Tambah Data Penumpang</a>
                    <a href="/admin/jemaah/{{ $jemaah->id }}" class="btn btn-sm btn-secondary mb-3"><i
                            data-feather="arrow-left" class="icon-sm me-2"></i> Kembali</a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nama Penumpang</th>
                                    <th class="pt-0">Nomor Kursi</th>
                                    <th class="pt-0">Nomor Rombongan</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($busJemaahs as $penumpang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $penumpang->jemaah->nama_lengkap }}</td>
                                        <td>{{ $penumpang->nomor_kursi }}</td>
                                        <td>{{ $penumpang->bus->nomor_rombongan }}</td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <a href="/admin/bus/{{ $penumpang->bus_id }}"
                                                    class="badge bg-haifa d-inline-block ms-1">List Penumpang</a>
                                                <a href="/admin/bus-jemaah/{{ $penumpang->id }}/edit"
                                                    class="badge bg-success d-inline-block ms-1">Edit</a>
                                                <form action="/admin/bus-jemaah/{{ $penumpang->id }}" method="post">
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
