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
                    <a href="/admin/jemaah/{{ $jemaah->id }}/kamar/create" class="btn btn-sm btn-langit mb-3"><i
                            data-feather="plus" class="icon-sm me-2"></i> Tambah Data Penghuni</a>
                    <a href="/admin/jemaah/{{ $jemaah->id }}" class="btn btn-sm btn-secondary mb-3"><i
                            data-feather="arrow-left" class="icon-sm me-2"></i> Kembali</a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nomor Kamar</th>
                                    <th class="pt-0">Tipe Kamar</th>
                                    <th class="pt-0">Kapasitas</th>
                                    <th class="pt-0">Kota</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kamarJemaahs as $tamu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tamu->kamar->nomor_kamar }}</td>
                                        <td>{{ $tamu->kamar->tipe_kamar }}</td>
                                        <td>{{ $tamu->kamar->kapasitas }}</td>
                                        <td>{{ $tamu->kamar->paketHotel->hotel->kota }}</td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <a href="/admin/kamar/{{ $tamu->kamar_id }}"
                                                    class="badge bg-haifa d-inline-block ms-1">Lihat Anggota
                                                    Kamar</a>
                                                <a href="/admin/kamar-jemaah/{{ $tamu->id }}/edit"
                                                    class="badge bg-success d-inline-block ms-1">Edit</a>
                                                <form action="/admin/kamar-jemaah/{{ $tamu->id }}" method="post">
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
