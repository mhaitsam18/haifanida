<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\PemesananEkstra;
use App\Models\PemesananKamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemesananTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemesanans = [
            [
                'paket_id' => 1,
                'user_id' => 2,
                'status' => 'Tertunda',
                'tanggal_pesan' => now(),
                'jumlah_orang' => '2',
                'total_harga' => 48000000, // 2 paket 48 juta, 2 perlengkapan 3 juta, 1 kamar double 5 juta
                'metode_pembayaran' => 'Cash',
                'is_pembayaran_lunas' => 1,
                'tanggal_pelunasan' => now(),
            ]
        ];
        foreach ($pemesanans as $pemesanan) {
            Pemesanan::create($pemesanan);
        }


        $pemesanan_ekstras = [
            [
                'pemesanan_id' => 1,
                'ekstra' => 'Perlengkapan',
                'jumlah' => '2',
                'total_harga' => 3000000, // tambah 3 juta
                'keterangan' => '2', // tambah 3 juta
            ]
        ];
        foreach ($pemesanan_ekstras as $pemesanan_ekstra) {
            PemesananEkstra::create($pemesanan_ekstra);
        }


        $pemesanan_kamars = [
            [
                'pemesanan_id' => 1,
                'tipe_kamar' => 'tipe kamar double keluarga',
                'jumlah_pengisi' => '2',
                'harga' => 5000000, // tambah 5 juta
            ]
        ];
        foreach ($pemesanan_kamars as $pemesanan_kamar) {
            PemesananKamar::create($pemesanan_kamar);
        }


        $pembayarans = [
            [
                'pemesanan_id' => 1,
                'jumlah_pembayaran' => 56000000, // total 56 juta
                'metode_pembayaran' => 'Transfer Mandiri',
                'tanggal_pembayaran' => now(),
                'bukti_pembayaran' => 'pembayaran-bukti/bukti-transaksi.jpg',
                'status_pembayaran' => 'tertunda',
            ]
        ];
        foreach ($pembayarans as $pembayaran) {
            Pembayaran::create($pembayaran);
        }
    }
}
