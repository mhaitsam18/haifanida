@extends('layouts.main')

@section('content')
<div class="container py-4 mb-5">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-0 text-primary">Tambah Pemesanan Ekstra</h2>
            <p class="text-muted">Silakan pilih layanan tambahan yang diinginkan</p>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pemesanan-ekstra.store') }}" method="POST">
        @csrf
        <input type="hidden" name="pemesanan_id" id="pemesanan_id" value="{{ $pemesanan_id }}">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-2">
                        <h5 class="mb-0">
                            <i class="fas fa-concierge-bell me-2"></i>Data Pemesanan Ekstra
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="jenis_ekstra" class="form-label fw-semibold">Ekstra / Tambahan <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_ekstra') is-invalid @enderror" id="jenis_ekstra" name="jenis_ekstra" required>
                                <option selected disabled value="">Pilih Jenis Ekstra</option>
                                @foreach ($ekstras as $ekstra)
                                    <option value="{{ $ekstra->id }}"
                                        data-harga="{{ $ekstra->harga_default }}"
                                        data-keterangan="{{ $ekstra->keterangan ?? $ekstra->deskripsi ?? '' }}"
                                        data-nama="{{ $ekstra->nama_ekstra }}"
                                        @selected($ekstra->id == old('jenis_ekstra'))>
                                        {{ $ekstra->nama_ekstra }} | Rp {{ number_format($ekstra->harga_default, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_ekstra')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($ekstras->isEmpty())
                                <div class="alert alert-warning mt-2">Tidak ada layanan ekstra tersedia.</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="harga_satuan" class="form-label fw-semibold">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                <input type="text" class="form-control" id="harga_satuan" readonly>
                                <input type="hidden" name="harga_satuan" id="harga_satuan_hidden">
                            </div>
                            <small class="text-muted">Harga per unit layanan</small>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label fw-semibold">Jumlah <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" min="1" value="{{ old('jumlah', 1) }}" required>
                            </div>
                            <small id="keterangan_description" class="text-muted"></small>
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_harga" class="form-label fw-semibold">Total Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                <input type="text" class="form-control" id="total_harga" readonly>
                                <input type="hidden" name="total_harga" id="total_harga_hidden" required>
                            </div>
                            @error('total_harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan / Catatan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan atau catatan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-8 d-flex justify-content-between">
                <a href="{{ route('pemesanan.detail', $pemesanan_id) }}" class="btn btn-outline-secondary px-4 py-2">
    <i class="fas fa-arrow-left me-2"></i> Kembali
</a>
                <div>
                    {{-- <button type="reset" class="btn btn-light me-2" onclick="resetForm()">
                        <i class="fas fa-redo me-1"></i>Reset
                    </button> --}}
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Function to update unit price, description, and total price
        function updatePriceAndDescription() {
            var selectedEkstra = $("#jenis_ekstra option:selected");
            var numberOfItems = $("#jumlah").val();
            var hargaSatuan = parseFloat(selectedEkstra.data("harga"));
            var keterangan = selectedEkstra.data("keterangan");

            // Update unit price, description, and hidden fields
            if (selectedEkstra.val() !== "") {
                $("#harga_satuan").val(hargaSatuan ? "Rp " + hargaSatuan.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }) : "");
                $("#harga_satuan_hidden").val(hargaSatuan || "");
                $("#keterangan_description").text(keterangan || "");
            } else {
                $("#harga_satuan").val("");
                $("#harga_satuan_hidden").val("");
                $("#keterangan_description").text("");
                $("#total_harga").val("");
                $("#total_harga_hidden").val("");
                return;
            }

            // Update total price if quantity is provided
            if (numberOfItems !== "" && numberOfItems > 0) {
                var totalPrice = hargaSatuan * parseInt(numberOfItems);
                $("#total_harga").val(totalPrice ? "Rp " + totalPrice.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }) : "");
                $("#total_harga_hidden").val(totalPrice || "");
            } else {
                $("#total_harga").val("");
                $("#total_harga_hidden").val("");
            }
        }

        // // Reset form function
        // function resetForm() {
        //     $("#jenis_ekstra").val("");
        //     $("#jumlah").val(1);
        //     $("#harga_satuan").val("");
        //     $("#harga_satuan_hidden").val("");
        //     $("#total_harga").val("");
        //     $("#total_harga_hidden").val("");
        //     $("#keterangan").val("");
        //     $("#keterangan_description").text("");
        // }

        // Attach event handlers for dropdown and quantity input
        $("#jenis_ekstra, #jumlah").on('change input', function() {
            updatePriceAndDescription();
        });

        // Trigger update on page load
        updatePriceAndDescription();
    });
</script>
@endsection