<?php

namespace Tests\Feature;

use App\Models\Catatan;
use App\Models\Faq;
use App\Models\Kontak;
use App\Models\Paket;
use App\Models\Testimoni;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecondIterationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_menyediakan_informasi_hal_yang_perlu_dipersiapkan(): void
    {
        // Mungkin test case ini perlu di-update
        $syarat = [
            'Ketentuan pemesanan paket:',
            'Melakukan pembayaran uang muka sebesar Rp10.0000.0000,-',
            'Melunasi pembayaran paket paling lambat',
            'Dokumen yang akan diperlukan:',
            'KTP',
            'KK',
            'Buku Nikah',
            'Paspor minimal 2 nama dan berlaku minimal 8 bulan dari tanggal kepulangan',
            'Foto terbaru ukuran 4&times;6, 5 lembar, zoom wajah',
            'Bukti vaksin'
        ];

        $request = $this->get('/paket/1');

        $request->assertSee($syarat, false);
    }

    public function test_menyediakan_informasi_barang_boleh_dibawah(): void
    {

        $request = $this->get('/paket/1');

        $barang = Catatan::where('kategori_catatan_id', 1)->get()->toArray();
        $barangFlatArray = array_walk_recursive($barang, function ($value) {
            return $value;
        });

        $request->assertSee($barangFlatArray);
    }

    public function test_menyediakan_informasi_barang_boleh_tidak_boleh_dibawah(): void
    {
        $request = $this->get('/paket/1');

        $barang = Catatan::where('kategori_catatan_id', 2)->get()->toArray();
        $barangFlatArray = array_walk_recursive($barang, function ($value) {
            return $value;
        });

        $request->assertSee($barangFlatArray);
    }

    public function test_menyediakan_informasi_jadwal(): void
    {
        $request = $this->get('/paket/1');

        $jadwal = Catatan::where('kategori_catatan_id', 4)->get()->toArray();
        $jadwalFlatArray = array_walk_recursive($jadwal, function ($value) {
            return $value;
        });

        $request->assertSee($jadwalFlatArray);
    }

    public function test_hanya_menampilkan_testimoni_yang_diizinkan(): void
    {
        $request = $this->get('/');

        $testimoni = Testimoni::select('testimoni')->where('shown', 1)->get()->toArray();
        $testimoniFlatArray = array_walk_recursive($testimoni, function ($value, $key) {
            return $value;
        });

        $request->assertSee($testimoniFlatArray);
    }

    public function test_menyediakan_informasi_testimoni(): void
    {
        $request = $this->get('/');

        $testimoni = Testimoni::select('testimoni')->where('shown', 1)->get()->toArray();
        $testimoniFlatArray = array_walk_recursive($testimoni, function ($value, $key) {
            return $value;
        });

        $request->assertSee($testimoniFlatArray);
    }

    public function test_menyediakan_informasi_faq(): void
    {
        $request = $this->get('/');

        $faq = Faq::all();
        $faqFlatArray = array_walk_recursive($faq, function ($value) {
            return $value;
        });

        $request->assertSee($faqFlatArray);
    }

    public function test_routing_kontak_berhasil(): void
    {
        $request = $this->get('/kontak');

        $request->assertSuccessful();
    }

    public function test_respon_mengembalikan_halaman_kontak(): void
    {
        $request = $this->get('/kontak');

        $request->assertviewIs('landing-page.kontak');
    }

    public function test_menampilkan_data_kontak_di_halaman_kontak(): void
    {
        $request = $this->get('/kontak');

        $kontak = Kontak::all();
        $kontakFlatArray = array_walk_recursive($kontak, function ($value) {
            return $value;
        });

        $request->assertSee($kontakFlatArray);
    }

    public function test_menampilkan_data_kontak_di_footer(): void
    {
        $request = $this->get('/');

        $kontak = Kontak::all();
        $kontakFlatArray = array_walk_recursive($kontak, function ($value) {
            return $value;
        });

        $request->assertSee($kontakFlatArray);
    }

    public function test_filter_harga_menerima_input(): void
    {
        $request = $this->get('/paket?rentang-harga=1');

        $request->assertSuccessful();
    }

    public function test_filter_harga_paket(): void
    {
        $request = $this->get('/paket?rentang-harga=4');

        $paket = Paket::whereBetween('harga_single', ['61000000', '70000000'])->get()->toArray();
        $paketFlatArray = array_walk_recursive($paket, function ($value) {
            return $value;
        });

        $request->assertSee($paketFlatArray);
    }

    public function test_filter_harga_paket_dengan_inputan_kosong(): void
    {
        $request = $this->get('/paket?rentang-harga=');

        $paket = Paket::all();
        $paketFlatArray = array_walk_recursive($paket, function ($value) {
            return $value;
        });

        $request->assertSee($paketFlatArray);
    }

    public function test_filter_harga_paket_dengan_inputan_tidak_valid(): void
    {
        $request = $this->get('/paket?rentang-harga=a');

        $request->assertInternalServerError();
    }

    public function test_filter_tanggal_keberangkatan_menerima_input(): void
    {
        $request = $this->get('/paket?tanggal=01-01-2024 s.d. 31-12-2024');

        $request->assertSuccessful();
    }

    public function test_filter_tanggal_keberangkatan_paket(): void
    {
        $request = $this->get('/paket?tanggal=01-01-2024 s.d. 31-12-2024');

        $paket = Paket::whereBetween('keberangkatan', ['2024-01-01', '2024-12-31'])->get()->toArray();
        $paketFlatArray = array_walk_recursive($paket, function ($value) {
            return $value;
        });

        $request->assertSee($paketFlatArray);
    }

    public function test_filter_tanggal_keberangkatan_dengan_inputan_kosong(): void
    {
        $request = $this->get('/paket?tanggal=');

        $paket = Paket::all();
        $paketFlatArray = array_walk_recursive($paket, function ($value) {
            return $value;
        });

        $request->assertSee($paketFlatArray);
    }

    public function test_tanggal_keberangkatan_paket_dengan_inputan_tidak_valid(): void
    {
         $request = $this->get('/paket?tanggal=a');

        $request->assertInternalServerError();
    }

    public function test_menampilkan_informasi_alamat_hotel_mekah(): void
    {
        $id = 1;

        $paket = Paket::where('id', $id)->first();

        $request = $this->get('/paket/'.$id);
        $request->assertSee($paket->hotelMekah->alamat);
    }

    public function test_menampilkan_informasi_alamat_hotel_madinah(): void
    {
        $id = 1;

        $paket = Paket::where('id', $id)->first();

        $request = $this->get('/paket/'.$id);
        $request->assertSee($paket->hotelMadinah->alamat);
    }
}
