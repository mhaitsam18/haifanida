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
                    <form action="/admin/pemesanan-ekstra" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="pemesanan_id" id="pemesanan_id" value="{{ $pemesanan->id ?? null }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="ekstra" class="form-label">Ekstra / Tambahan</label>
                                    <select class="form-select @error('ekstra') is-invalid @enderror" id="ekstra"
                                        name="ekstra">
                                        <option value="" selected disabled>Pilih Ekstra</option>
                                        @foreach ($ekstras as $ekstra)
                                            <option value="{{ $ekstra->nama_ekstra }}"
                                                data-harga="{{ $ekstra->harga_default }}"
                                                data-keterangan="{{ $ekstra->keterangan }}" @selected($ekstra->nama_ekstra == old('ekstra'))>
                                                {{ $ekstra->nama_ekstra }} |
                                                Rp.{{ number_format($ekstra->harga_default, 2, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ekstra')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                        id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Jumlah">
                                    @error('jumlah')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <span id="keterangan_description" class="text-muted"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" class="form-control @error('total_harga') is-invalid @enderror"
                                        id="total_harga" name="total_harga" value="{{ old('total_harga') }}"
                                        placeholder="Total Harga">
                                    @error('total_harga')
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
                                <a href="/admin/{{ $pemesanan ? 'pemesanan/' . $pemesanan->id . '/' : '' }}pemesanan-ekstra"
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
                var selectedRoom = $("#ekstra option:selected");
                var numberOfOccupants = $("#jumlah").val();

                // Check if both room type and number of occupants are selected
                if (selectedRoom.val() !== "" && numberOfOccupants !== "") {
                    var roomPrice = parseFloat(selectedRoom.data("harga"));
                    var totalPrice = roomPrice * parseInt(numberOfOccupants);

                    // Update the price input field
                    $("#total_harga").val(totalPrice);
                }
            }

            // Attach the change event handlers
            $("#ekstra, #jumlah").on('change input', function() {
                updatePrice();
            });

            // Trigger the updatePrice function on page load
            updatePrice();
        });

        $(document).ready(function() {
            // Function to calculate and update the price based on room type and number of occupants
            function updatePriceAndDescription() {
                var selectedRoom = $("#ekstra option:selected");
                var numberOfOccupants = $("#jumlah").val();
                var keterangan = selectedRoom.data("keterangan");

                // Check if both room type and number of occupants are selected
                if (selectedRoom.val() !== "") {
                    // Update the description below the jumlah input field
                    $("#keterangan_description").text(keterangan);

                    // Update the price input field
                    if (numberOfOccupants !== "") {
                        var roomPrice = parseFloat(selectedRoom.data("harga"));
                        var totalPrice = roomPrice * parseInt(numberOfOccupants);
                        $("#total_harga").val(totalPrice);
                    }
                } else {
                    // Clear the description and price when no room type is selected
                    $("#keterangan_description").text("");
                    $("#total_harga").val("");
                }
            }

            // Attach the change event handlers
            $("#ekstra, #jumlah").on('change input', function() {
                updatePriceAndDescription();
            });

            // Trigger the updatePriceAndDescription function on page load
            updatePriceAndDescription();
        });
    </script>
@endsection
