@extends('admin.layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <style>
        @media print {
            .aksi-kolom {
                display: none !important;
            }

            .print-hilang {
                display: none !important;
            }

            #dataTableExample th:last-child,
            #dataTableExample td:last-child {
                display: none;
            }
        }
    </style>
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
                        <h6 class="card-title mb-0">Data jemaah</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="tambah" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="tambah">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="/admin/paket/{{ $paket->id }}/jemaah/create"><i data-feather="plus"
                                        class="icon-sm me-2"></i> <span class="">Tambah</span></a>

                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"
                                    onclick="printContent()"><i data-feather="printer" class="icon-sm me-2"></i> <span
                                        class="">Print</span></a>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-haifa my-2" href="/admin/paket/{{ $paket->id }}/jemaah/create"><i
                            data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                    <a class="btn btn-sm btn-secondary my-2" href="/admin/paket/{{ $paket->id }}"><i
                            data-feather="arrow-left" class="icon-sm me-2"></i> <span class="">Kembali</span></a>
                    <div class="table-responsive" id="konten-yang-ingin-dicetak">
                        <div class="text-center">
                            <h4 class="mb-4">Data Jema'ah Keberangkatan
                                {{ Carbon::parse($paket->tanggal_mulai)->isoFormat('LL') }}</h4>
                        </div>
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nama Lengkap</th>
                                    <th class="pt-0">Email</th>
                                    <th class="pt-0">Nomor Ponsel</th>
                                    <th class="pt-0">Foto</th>
                                    <th class="pt-0 print-hilang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jemaahs as $jemaah)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jemaah->nama_lengkap }}</td>
                                        <td>{{ $jemaah->email }}</td>
                                        <td>{{ $jemaah->nomor_telepon }}</td>
                                        <td> <img src="{{ asset('storage/' . $jemaah->foto) }}" alt="Foto"
                                                class="img-thumbnail img-fluid"></td>
                                        <td class="print-hilang">
                                            <div class="d-flex align-items-center">
                                                <a href="/admin/paket/{{ $paket->id }}/jemaah/{{ $jemaah->id }}"
                                                    class="badge bg-haifa d-inline-block m-1">Detail</a>
                                                <a href="/admin/paket/{{ $paket->id }}/jemaah/{{ $jemaah->id }}/edit"
                                                    class="badge bg-success d-inline-block m-1">Edit</a>
                                                <form action="/admin/jemaah/{{ $jemaah->id }}" method="post">
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
@section('script')
    <script>
        function printContent() {
            // Pilih elemen yang ingin dicetak
            var printContents = document.getElementById("konten-yang-ingin-dicetak").cloneNode(true);

            // Sembunyikan kolom Aksi dalam dokumen cetak
            var rows = printContents.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var actionCell = row.querySelector('td:last-child');
                if (actionCell) {
                    actionCell.style.display = 'none';
                }
            });
            var rows = printContents.querySelectorAll('thead tr');
            rows.forEach(function(row) {
                var actionCell = row.querySelector('th:last-child');
                if (actionCell) {
                    actionCell.style.display = 'none';
                }
            });

            // Nonaktifkan DataTable saat mencetak
            var dataTable = printContents.querySelector('#dataTableExample');
            if (dataTable) {
                dataTable.outerHTML = dataTable.innerHTML; // Mengganti elemen tabel DataTable dengan kontennya
            }

            // Buat jendela cetak baru
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents.outerHTML;

            // Buka jendela cetak
            window.print();

            // Kembalikan konten asli
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
