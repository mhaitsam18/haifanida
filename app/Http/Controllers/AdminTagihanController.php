<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class AdminTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pemesanan $pemesanan = null)
    {
        $tagihans = [
            [
                'deskripsi' => $pemesanan->paket->nama_paket,
                'jumlah' => $pemesanan->jumlah_orang,
                'biaya_satuan' => $pemesanan->paket->harga,
                'satuan' => 'pax',
                'total' => $pemesanan->paket->harga * $pemesanan->jumlah_orang,
            ],
        ];

        foreach ($pemesanan->pemesananKamars as $pemesanan_kamar) {
            $tagihans[] = [
                'deskripsi' => $pemesanan_kamar->tipe_kamar,
                'jumlah' => 1,
                'biaya_satuan' => $pemesanan_kamar->harga,
                'satuan' => 'pax',
                'total' => $pemesanan_kamar->harga,
            ];

            foreach ($pemesanan_kamar->permintaans as $permintaan) {
                $tagihans[] = [
                    'deskripsi' => 'Tambahan : ' . $permintaan->permintaan,
                    'jumlah' => 1,
                    'biaya_satuan' => $permintaan->harga,
                    'satuan' => '',
                    'total' => $permintaan->harga,
                ];
            }
        }

        foreach ($pemesanan->pemesananEkstras as $pemesanan_ekstra) {
            $tagihans[] = [
                'deskripsi' => $pemesanan_ekstra->ekstra,
                'jumlah' => $pemesanan_ekstra->jumlah,
                'biaya_satuan' => $pemesanan_ekstra->total_harga / $pemesanan_ekstra->jumlah,
                'satuan' => '',
                'total' => $pemesanan_ekstra->total_harga,
            ];
        }
        $pembayaran = Pembayaran::where('pemesanan_id', $pemesanan->id)->where('status_pembayaran', 'diterima')->sum('jumlah_pembayaran');

        $totals = array_column($tagihans, 'total');
        $balance = array_sum($totals);
        $tax = ($balance * 11) / 100;
        $balance += $tax;
        $balance -= $pembayaran;
        return view('admin.paket.pemesanan.tagihan', [
            'title' => 'Data Pemesanan',
            'page' => 'pemesanan',
            'pemesanan' => $pemesanan,
            'tagihans' => $tagihans,
            'pembayaran' => $pembayaran ?? 0,
            'balance' => $balance,
        ]);
    }
    public function tagihanGrup(Grup $grup = null)
    {
        return view('errors.coming-soon', [
            'title' => 'Tagihan Grup',
            'judul' => 'Coming Soon',
            'pesan' => 'Fitur Ini akan segera Hadir',
            'page' => 'tagihan-grup',
        ]);
        // return view('admin.paket.grup.tagihan', [
        //     'title' => 'Tagihan Grup',
        //     'page' => 'tagihan-grup',
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cetak(Pemesanan $pemesanan)
    {
    }
}
