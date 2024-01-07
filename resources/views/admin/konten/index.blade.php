@extends('admin.layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
        use Illuminate\Support\Str;
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
                                <a class="dropdown-item d-flex align-items-center" href="/admin/konten/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-haifa my-2" href="/admin/konten/create"><i data-feather="plus"
                            class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Penulis</th>
                                    <th class="pt-0">Nama Konten</th>
                                    <th class="pt-0">Judul</th>
                                    {{-- <th class="pt-0">Isi Konten</th> --}}
                                    <th class="pt-0">Gambar</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kontens as $konten)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $konten->user->name ?? null }}</td>
                                        <td>{{ $konten->nama }}</td>
                                        <td>{{ $konten->judul }}</td>
                                        {{-- <td>{{ Str::limit($konten->isi_konten, 200, '...') }}</td> --}}

                                        <td>
                                            @if (Storage::disk('public')->exists($konten->gambar))
                                                <img src="{{ asset('storage/' . $konten->gambar) }}" alt=""
                                                    style="border-radius: 0%; width: 150px; height: 100px;">
                                            @else
                                                <img src="{{ asset('storage/image-not-found-scaled.png') }}"
                                                    alt="Image Not Found"
                                                    style="border-radius: 0%; width: 150px; height: 100px;">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if (!$konten->user_id || auth()->user()->id == $konten->user_id)
                                                    <a href="/admin/konten/{{ $konten->id }}/edit"
                                                        class="badge bg-success d-inline-block">Edit</a>
                                                    @if (!$konten->indelible)
                                                        <form action="/admin/konten/{{ $konten->id }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                class="badge bg-danger d-inline-block ms-2 mb-1 badge-a tombol-hapus">Hapus</button>
                                                        </form>
                                                    @endif
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
