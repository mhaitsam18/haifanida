<?php

namespace Tests\Feature;

use App\Models\Jemaah;
use App\Models\Paket;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FirstIterationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_terdapat_data_paket_yang_sama_seperti_di_database(): void
    {
        $response = $this->get('/paket');

        $paket = Paket::all()->toArray();
        $paketFlatArray = array_walk_recursive($paket, function($value, $key) {
            return $value;
        });

        $response->assertSee($paketFlatArray);
    }

    public function test_terdapat_data_paket_yang_dimaksud(): void
    {
        $id = 1;
        $response = $this->get('/paket/'.$id);

        $paket = Paket::where('id', $id)->first()->toArray();
        $paketFlatArray = array_walk_recursive($paket, function($value, $key) {
            return $value;
        });

        $response->assertSee($paketFlatArray);
    }

    public function test_menghasilkan_pesanan_baru() : void {
        $pelanggan = User::where('role', 'pelanggan')->first();

        $this->actingAs($pelanggan)
            ->post('/pesan', [
            'paket' => 1,
            'jenis-kamar' => 'single',
            'jemaah' => ['Jemaah Test 1'],
            'jenis-kelamin' => ['laki-laki'],
        ]);

        $dataBaru = Jemaah::latest()->first()->toArray();

        // $this->assertContains(['jenis_kelamin' => 'laki-laki', 'nama' => 'Jemaah Test 1'], $dataBaru);
        $this->assertContains('Jemaah Test 1', $dataBaru);
    }

    public function test_stok_berkurang() : void {
        $id = 1;

        $paketSebelum = Paket::select('stok')->where('id', $id)->first();
        $pelanggan = User::where('role', 'pelanggan')->first();

        $this->actingAs($pelanggan)
            ->post('/pesan', [
            'paket' => $id,
            'jenis-kamar' => 'couple',
            'jemaah' => ['Jemaah Test 2', 'Jemaah Test 3'],
            'jenis-kelamin' => ['laki-laki', 'perempuan'],
        ]);

        $paketSesudah = Paket::select('stok')->where('id', $id)->first();

        $this->assertEquals($paketSesudah->stok, $paketSebelum->stok - 2);
    }

    public function test_data_harga_di_daftar_paket() : void {
        $paket = Paket::select('harga_single')->first();

        $request = $this->get('/paket');

        $request->assertSee(rupiah($paket->harga_single));
    }

    public function test_data_harga_di_paket_yang_sesuai() : void {
        $id = 1;

        $paket = Paket::select('harga_single')->where('id', $id)->first();

        $request = $this->get('/paket/'.$id);

        $request->assertSee(rupiah($paket->harga_single));
    }

    public function test_informasi_fasilitas_include() : void {
        $fasilitas = [
            'Harga termasuk:',
            'Tiket pesawat',
            'Visa',
            'Makan 3&times; sehari',
            'Muthowif berbahasa Indonesia',
            'Tour & ziarah',
            'Harga tidak termasuk:',
            'Perlengkapan, manasik, handling airport (1,5jt)',
            'Tour di luar paket',
            'Laundry',
            'dll',
        ];

        $request = $this->get('/paket/1');

        $request->assertSee($fasilitas, false);
    }

    public function test_data_hotel_mekah() : void {
        $id = 1;

        $paket = Paket::where('id', $id)->first();

        $request = $this->get('/paket/'.$id);
        $request->assertSee($paket->hotelMekah->nama);
    }

    public function test_data_hotel_madinah() : void {
        $id = 1;

        $paket = Paket::where('id', $id)->first();

        $request = $this->get('/paket/'.$id);
        $request->assertSee($paket->hotelMadinah->nama);
    }

    public function test_data_jumlah_hari() : void {
        $id = 1;

        $paket = Paket::select('jumlah_hari')->where('id', $id)->first();

        $request = $this->get('/paket/'.$id);
        $request->assertSee($paket->jumlah_hari);
    }
}
