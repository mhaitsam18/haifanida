<?php

namespace Tests\Feature;

use App\Models\Jemaah;
use App\Models\Paket;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecondIterationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_menyediakan_informasi_persyaratan() : void {
        $fasilitas = [
            'Ketentuan pemesanan paket:',
            'Melakukan pembayaran uang muka sebesar Rp10.0000.0000,-',
            'Melunasi pembayaran paket paling lambat 30 hari sebelum keberangkatan',
            'Dokumen yang akan diperlukan:',
            'KTP',
            'KK',
            'Buku Nikah',
            'Paspor minimal 2 nama dan berlaku minimal 8 bulan dari tanggal kepulangan',
            'Foto terbaru ukuran 4&times;6, 5 lembar, zoom wajah',
            'Bukti vaksin'
        ];

        $request = $this->get('/paket/1');

        $request->assertSee($fasilitas, false);
    }

    public function test_menyediakan_informasi_barang_boleh_dibawah() : void {

    }

    public function test_menyediakan_informasi_barang_boleh_tidak_boleh_dibawah() : void {

    }

    public function test_menyediakan_informasi_jadwal() : void {

    }

    public function test_hanya_menampilkan_testimoni_yang_diizinkan() : void {

    }

    public function test_menyediakan_informasi_testimoni() : void {

    }

    public function test_menyediakan_informasi_faq() : void {

    }

    public function test_routing_kontak_berhasil() : void {

    }

    public function test_respon_mengembalikan_halaman_kontak() : void {

    }

    public function test_menampilkan_data_kontak_di_halaman_kontak() : void {

    }

    public function test_menampilkan_data_kontak_di_footer() : void {

    }

    public function test_filter_harga_menerima_input() : void {

    }

    public function test_filter_harga_paket() : void {

    }

    public function test_filter_harga_paket_dengan_inputan_kosong() : void {

    }

    public function test_filter_harga_paket_dengan_inputan_tidak_valid() : void {

    }

    public function test_filter_tanggal_keberangkatan_menerima_input() : void {

    }

    public function test_filter_tanggal_keberangkatan_paket() : void {

    }

    public function test_filter_tanggal_keberangkatan_dengan_inputan_kosong() : void {

    }

    public function test_tanggal_keberangkatan_paket_dengan_inputan_tidak_valid() : void {

    }

    public function test_menampilkan_informasi_alamat_hotel_mekah() : void {

    }

    public function test_menampilkan_informasi_alamat_hotel_madinah() : void {

    }
}
