<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class MemberTagihanController extends Controller
{
    public function index($id)
    {   
        $pemesanan = Pemesanan::where('id', $id)
            ->with(['paket', 'pemesananKamars.permintaans', 'pemesananEkstras'])
            ->first();

        // if (!$p.maah) {
        //     abort(404, 'Pemesanan tidak ditemukan');
        // }

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

        $pembayaran = Pembayaran::where('pemesanan_id', $pemesanan->id)
            ->where('status_pembayaran', 'diterima')
            ->sum('jumlah_pembayaran');

        $totals = array_column($tagihans, 'total');
        $balance = array_sum($totals);
        $tax = ($balance * 11) / 100;
        $balance += $tax;
        $balance -= $pembayaran;

        // Update is_pembayaran_lunas based on balance
        $pemesanan->is_pembayaran_lunas = $balance <= 0;
        $pemesanan->save();

        return view('home.pemesanan.tagihan', [
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
    }

    public function cetak(Pemesanan $pemesanan)
    {
        // Implement print functionality if needed
    }
}