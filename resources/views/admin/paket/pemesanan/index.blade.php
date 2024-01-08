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
                                <a class="dropdown-item d-flex align-items-center" href="/admin/pemesanan/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-haifa my-2"
                        href="/admin/{{ $paket ? 'paket/' . $paket->id . '/' : '' }}pemesanan/create"><i data-feather="plus"
                            class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nama Pemesan</th>
                                    <th class="pt-0">Nama Paket</th>
                                    <th class="pt-0">Jenis Paket</th>
                                    <th class="pt-0">Status</th>
                                    <th class="pt-0">Tanggal Pemesanan</th>
                                    <th class="pt-0">Tanggal Keberangkatan</th>
                                    <th class="pt-0">Jumlah Orang</th>
                                    <th class="pt-0">Total Harga</th>
                                    <th class="pt-0">Metode Pembayaran</th>
                                    <th class="pt-0">Pelunasan</th>
                                    <th class="pt-0">Tenggat Pelunasan</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanans as $pemesanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pemesanan->user->name }}</td>
                                        <td>
                                            <a href="/admin/paket/{{ $pemesanan->paket_id }}">
                                                {{ $pemesanan->paket->nama_paket }}
                                            </a>
                                        </td>
                                        <td>{{ $pemesanan->paket->jenis_paket }}</td>
                                        <td>{{ $pemesanan->status }}</td>
                                        <td>{{ Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}</td>
                                        <td>{{ Carbon::parse($pemesanan->tanggal_berangkat)->isoFormat('LL') }}</td>
                                        <td>{{ $pemesanan->jumlah_orang }}</td>
                                        <td>Rp.{{ number_format($pemesanan->total_harga, 2, ',', '.') }}</td>
                                        <td>{{ $pemesanan->metode_pembayaran }}</td>
                                        <td>{{ $pemesanan->is_pembayaran_lunas == true ? 'Lunas' : 'Belum Lunas' }}</td>
                                        <td>{{ Carbon::parse($pemesanan->tanggal_pelunasan)->isoFormat('LL') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                {{-- lihat jema'ah, pembayaran dan additional --}}
                                                <a href="/admin/pemesanan/{{ $pemesanan->id }}"
                                                    class="badge bg-haifa d-inline-block ms-1">Detail</a>
                                                <a href="/admin/pemesanan/{{ $pemesanan->id }}/edit"
                                                    class="badge bg-success d-inline-block ms-1">Edit</a>
                                                <form action="/admin/pemesanan/{{ $pemesanan->id }}" method="post">
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
