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
                                <a class="dropdown-item d-flex align-items-center" href="/admin/menu/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-haifa my-2" href="/admin/menu/create"><i data-feather="plus"
                            class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Menu</th>
                                    <th class="pt-0">Parent</th>
                                    <th class="pt-0">Dropdown</th>
                                    <th class="pt-0">Aktif</th>
                                    <th class="pt-0">URL</th>
                                    <th class="pt-0">Ikon</th>
                                    <th class="pt-0">Nomor Urut</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $menu->menu }}</td>
                                        <td>{{ $menu->parent->menu ?? 'Tidak Ada' }}</td>
                                        <td>{{ $menu->has_dropdown ? 'Ada' : 'Tidak Ada' }}</td>
                                        <td>{{ $menu->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        <td>{{ $menu->url ?? 'Tidak Ada' }}</td>
                                        <td>{{ $menu->icon ?? 'Tidak Ada' }}</td>
                                        <td>{{ $menu->order }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="/admin/menu/{{ $menu->id }}/edit"
                                                    class="badge bg-success d-inline-block">Edit</a>
                                                @if (!$menu->indelible)
                                                    <form action="/admin/menu/{{ $menu->id }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"
                                                            class="badge bg-danger d-inline-block ms-2 mb-1 badge-a tombol-hapus">Hapus</button>
                                                    </form>
                                                @endif
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
