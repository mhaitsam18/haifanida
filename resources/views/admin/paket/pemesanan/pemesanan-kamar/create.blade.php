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
                    <form action="/admin/pemesanan-kamar" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="pemesanan_id" id="pemesanan_id" value="{{ $pemesanan->id ?? null }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                                    <select class="form-select @error('tipe_kamar') is-invalid @enderror" id="tipe_kamar"
                                        name="tipe_kamar">
                                        <option value="" selected disabled>Pilih Tipe Kamar</option>
                                        @foreach ($kamars as $kamar)
                                            <option value="{{ $kamar->nama_ekstra }}"
                                                data-harga="{{ $kamar->harga_default }}"
                                                data-keterangan="{{ $kamar->keterangan }}" @selected($kamar->nama_ekstra == old('tipe_kamar'))>
                                                {{ $kamar->nama_ekstra }} |
                                                Rp.{{ number_format($kamar->harga_default, 2, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipe_kamar')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_pengisi" class="form-label">Jumlah Pengisi</label>
                                    <input type="number" class="form-control @error('jumlah_pengisi') is-invalid @enderror"
                                        id="jumlah_pengisi" name="jumlah_pengisi" value="{{ old('jumlah_pengisi') }}"
                                        placeholder="Jumlah Pengisi" max="4">
                                    @error('jumlah_pengisi')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <span id="keterangan_description" class="text-muted"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                        id="harga" name="harga" value="{{ old('harga') }}"
                                        placeholder="Total Harga">
                                    @error('harga')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                        placeholder="Keterangan">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-haifa float-end m-2">Simpan</button>
                                <a href="/admin/{{ $pemesanan ? 'pemesanan/' . $pemesanan->id . '/' : '' }}pemesanan-kamar"
                                    class="btn btn-secondary float-end m-2">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Function to calculate and update the price based on room type and number of occupants
            function updatePrice() {
                var selectedRoom = $("#tipe_kamar option:selected");
                var numberOfOccupants = $("#jumlah_pengisi").val();

                // Check if both room type and number of occupants are selected
                if (selectedRoom.val() !== "" && numberOfOccupants !== "") {
                    var roomPrice = parseFloat(selectedRoom.data("harga"));
                    var totalPrice = roomPrice * parseInt(numberOfOccupants);

                    // Update the price input field
                    $("#harga").val(totalPrice.toFixed(2));
                }
            }

            // Attach the change event handlers
            $("#tipe_kamar, #jumlah_pengisi").on('change input', function() {
                updatePrice();
            });

            // Trigger the updatePrice function on page load
            updatePrice();
        });

        $(document).ready(function() {
            // Function to calculate and update the price based on room type and number of occupants
            function updatePriceAndDescription() {
                var selectedRoom = $("#tipe_kamar option:selected");
                var numberOfOccupants = $("#jumlah_pengisi").val();
                var keterangan = selectedRoom.data("keterangan");

                // Check if both room type and number of occupants are selected
                if (selectedRoom.val() !== "") {
                    // Update the description below the jumlah_pengisi input field
                    $("#keterangan_description").text(keterangan);

                    // Update the price input field
                    if (numberOfOccupants !== "") {
                        var roomPrice = parseFloat(selectedRoom.data("harga"));
                        var totalPrice = roomPrice * parseInt(numberOfOccupants);
                        $("#harga").val(totalPrice.toFixed(2));
                    }
                } else {
                    // Clear the description and price when no room type is selected
                    $("#keterangan_description").text("");
                    $("#harga").val("");
                }
            }

            // Attach the change event handlers
            $("#tipe_kamar, #jumlah_pengisi").on('change input', function() {
                updatePriceAndDescription();
            });

            // Trigger the updatePriceAndDescription function on page load
            updatePriceAndDescription();
        });

        $(document).ready(function() {
            // Function to calculate and update the price based on room type and number of occupants
            function updatePriceAndDescription() {
                var selectedRoom = $("#tipe_kamar option:selected");
                var numberOfOccupantsInput = $("#jumlah_pengisi");

                // Check if a room type is selected
                if (selectedRoom.val() !== "") {
                    // Set the default number of occupants based on room type
                    switch (selectedRoom.val()) {
                        case "tipe kamar quad gabung":
                            numberOfOccupantsInput.val("").prop("readonly", false);
                            break;
                        case "tipe kamar quad keluarga":
                            numberOfOccupantsInput.val(4).prop("readonly", true);
                            break;
                        case "tipe kamar quad keluarga isi 3 dan 1 bed kosong":
                            numberOfOccupantsInput.val(3).prop("readonly", true);
                            break;
                        case "tipe kamar double gabung":
                            numberOfOccupantsInput.val(1).prop("readonly", true);
                            break;
                        case "tipe kamar double keluarga":
                            numberOfOccupantsInput.val(2).prop("readonly", true);
                            break;
                        case "tipe kamar single":
                            numberOfOccupantsInput.val(1).prop("readonly", true);
                            break;
                            // Add more cases for other room types if needed
                    }

                    // Update the description below the jumlah_pengisi input field
                    var keterangan = selectedRoom.data("keterangan");
                    $("#keterangan_description").text(keterangan);

                    // Update the price input field
                    if (!isNaN(numberOfOccupantsInput.val())) {
                        var roomPrice = parseFloat(selectedRoom.data("harga"));
                        var totalPrice = roomPrice * parseInt(numberOfOccupantsInput.val());
                        $("#harga").val(roomPrice);
                    }
                } else {
                    // Clear the description, price, and enable jumlah_pengisi when no room type is selected
                    $("#keterangan_description").text("");
                    $("#harga").val("");
                    numberOfOccupantsInput.val("").prop("readonly", false);
                }
            }

            // Attach the change event handler for tipe_kamar
            $("#tipe_kamar").on('change', function() {
                updatePriceAndDescription();
            });

            // Trigger the updatePriceAndDescription function on page load
            updatePriceAndDescription();
        });
    </script>
@endsection
