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
                        <h6 class="card-title mb-0">Data Pesan</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="tambah" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="tambah">
                                <a class="dropdown-item d-flex align-items-center" href="/admin/pesan/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    {{-- <a class="btn btn-sm btn-haifa my-2" href="/admin/pesan/create"><i data-feather="plus"
                            class="icon-sm me-2"></i> <span class="">Tambah</span></a> --}}
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nama Pengirim</th>
                                    <th class="pt-0">Email Pengirim</th>
                                    <th class="pt-0">Nomor WhatsApp Pengirim</th>
                                    <th class="pt-0">Subjek</th>
                                    <th class="pt-0">Pesan</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesans as $pesan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pesan->nama_pengirim }}</td>
                                        <td>{{ $pesan->email_pengirim }}</td>
                                        <td>{{ $pesan->nomor_wa_pengirim }}</td>
                                        <td>{{ $pesan->subjek }}</td>
                                        <td>{{ $pesan->pesan }}</td>
                                        <td>
                                            @php
                                                // Menghilangkan karakter selain angka dari nomor WhatsApp
                                                $nomor_wa = preg_replace('/[^0-9]/', '', $pesan->nomor_wa_pengirim);

                                                // Menghilangkan awalan "0" dan menggantinya dengan kode negara "+62"
                                                if (substr($nomor_wa, 0, 1) === '0') {
                                                    $nomor_wa = '+62' . substr($nomor_wa, 1);
                                                }

                                                // Menghilangkan tanda kurung dan spasi
                                                $nomor_wa = str_replace(['(', ')', ' '], '', $nomor_wa);

                                                // Membuat link WhatsApp dengan format yang benar
                                                $link_wa = 'https://wa.me/' . $nomor_wa;
                                            @endphp
                                            <div class="d-flex align-items-center">
                                                <a href="{{ $link_wa }}" class="badge bg-success d-inline-block"
                                                    target="_blank">Balas
                                                    Via WA</a>
                                                <!-- Button trigger modal -->
                                                <button type="button"
                                                    class="badge bg-danger badge-a m-1 d-inline-block sendEmailButton"
                                                    data-bs-toggle="modal" data-bs-target="#sendEmailModal"
                                                    data-id="{{ $pesan->id }}" data-user_id="{{ $pesan->user_id }}"
                                                    data-nama_pengirim="{{ $pesan->nama_pengirim }}"
                                                    data-email_pengirim="{{ $pesan->email_pengirim }}"
                                                    data-nomor_wa_pengirim="{{ $pesan->nomor_wa_pengirim }}"
                                                    data-subjek="{{ $pesan->subjek }}" data-pesan="{{ $pesan->pesan }}">
                                                    Balas Email
                                                </button>
                                                {{-- <a href="/admin/pesan/{{ $pesan->id }}/edit"
                                                    class="badge bg-success d-inline-block">Edit</a>
                                                <form action="/admin/pesan/{{ $pesan->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                        class="badge bg-danger d-inline-block ms-2 mb-1 badge-a tombol-hapus">Hapus</button>
                                                </form> --}}
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
    <!-- Modal -->
    <div class="modal fade" id="sendEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="sendEmailModalLabel">Balas Via Email</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/pesan/kirim-email" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="user_id" name="user_id">
                        <input type="hidden" id="nomor_wa_pengirim" name="nomor_wa_pengirim">
                        <input type="hidden" id="subjek" name="subjek">
                        <input type="hidden" id="pesan" name="pesan">
                        <div class="mb-3">
                            <label for="nama_pengirim" class="form-label">Kepada:</label>
                            <input type="text" class="form-control" name="nama_pengirim" id="nama_pengirim" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email_pengirim" class="form-label">Kepada:</label>
                            <input type="text" class="form-control" name="email_pengirim" id="email_pengirim" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="balasan" class="form-label">Pesan:</label>
                            <textarea class="form-control" name="balasan" id="balasan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-haifa">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('modal')
@endsection


@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script> --}}
    <script>
        $(document).on("click", ".sendEmailButton", function() {
            var id = $(this).data('id');
            $(".modal-body  #id").val(id);
            var user_id = $(this).data('user_id');
            $(".modal-body  #er_id").val(user_id);
            var nama_pengirim = $(this).data('nama_pengirim');
            $(".modal-body  #nama_pengirim").val(nama_pengirim);
            var email_pengirim = $(this).data('email_pengirim');
            $(".modal-body  #email_pengirim").val(email_pengirim);
            var nomor_wa_pengirim = $(this).data('nomor_wa_pengirim');
            $(".modal-body  #nomor_wa_pengirim").val(nomor_wa_pengirim);
            var subjek = $(this).data('subjek');
            $(".modal-body  #subjek").val(subjek);
            var pesan = $(this).data('pesan');
            $(".modal-body  #pesan").val(pesan);
        });
    </script>
@endsection
