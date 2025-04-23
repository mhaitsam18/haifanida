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
                                <a class="dropdown-item d-flex align-items-center" href="/admin/kantor/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-haifa my-2" href="/admin/kantor/create"><i data-feather="plus"
                            class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Jenis Kantor</th>
                                    <th class="pt-0">Nama Kantor</th>
                                    <th class="pt-0">Nama Ketua</th>
                                    <th class="pt-0">Kontak Kantor</th>
                                    <th class="pt-0">Provinsi</th>
                                    <th class="pt-0">Kabupaten</th>
                                    <th class="pt-0">Kecamatan</th>
                                    <th class="pt-0">Alamat Kantor</th>
                                    <th class="pt-0">Kode Pos</th>
                                    <th class="pt-0">Foto Kantor</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kantors as $kantor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kantor->jenis_kantor }}</td>
                                        <td>{{ $kantor->nama_kantor }}</td>
                                        <td>{{ $kantor->nama_ketua }}</td>
                                        <td>{{ $kantor->kontak_kantor }}</td>
                                        <td>{{ $kantor->kabupaten->provinsi->provinsi }}</td>
                                        <td>{{ $kantor->kabupaten->kabupaten }}</td>
                                        <td>{{ $kantor->kecamatan }}</td>
                                        <td>{{ $kantor->alamat_kantor }}</td>
                                        <td>{{ $kantor->kode_pos }}</td>
                                        <td><img src="{{ asset('storage/' . $kantor->foto_kantor) }}" alt="Foto Kantor"
                                                style="border-radius: 0%; width: 150px; height: 100px;">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="/admin/kantor/{{ $kantor->id }}/edit"
                                                    class="badge bg-success d-inline-block">Edit</a>
                                                <form action="/admin/kantor/{{ $kantor->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                        class="badge bg-danger d-inline-block ms-2 mb-1 badge-a tombol-hapus">Hapus</button>
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
