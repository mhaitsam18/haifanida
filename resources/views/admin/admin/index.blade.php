@extends('admin.layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{ $title }}</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Data Admin</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="tambah" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="tambah">
                                <a class="dropdown-item d-flex align-items-center" href="/admin/user-admin/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-haifa my-2" href="/admin/user-admin/create"><i data-feather="plus"
                            class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nama</th>
                                    <th class="pt-0">Email</th>
                                    <th class="pt-0">Username</th>
                                    <th class="pt-0">Nomor Ponsel</th>
                                    {{-- Data Admin --}}
                                    <th class="pt-0">SuperAdmin?</th>
                                    <th class="pt-0">Kantor</th>
                                    {{-- Data Admin --}}
                                    <th class="pt-0">Foto</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->user->name }}</td>
                                        <td>{{ $admin->user->email }}</td>
                                        <td>{{ $admin->user->username }}</td>
                                        <td>{{ $admin->user->phone_number }}</td>
                                        {{-- Data Admin --}}
                                        <td>
                                            @if ($admin->is_superadmin)
                                                <span class="badge bg-success"><i class="fa-solid fa-check"></i></span>
                                            @else
                                                <span class="badge bg-danger"><i class="fa-solid fa-x"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $admin->kantor->nama_kantor }}</td>
                                        {{-- Data Admin --}}
                                        <td> <img
                                                src="{{ asset('storage/' . $admin->user->photo ?? 'image-not-found-scaled.png') }}"
                                                alt="Foto" class="img-thumbnail img-fluid"></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="/admin/user-admin/{{ $admin->id }}/edit"
                                                    class="badge bg-success d-inline-block">Edit</a>
                                                <form action="/admin/user-admin/{{ $admin->id }}" method="post">
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
