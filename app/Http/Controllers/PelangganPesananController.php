<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PelangganPesananController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::select('id')->where('user_id', auth()->user()->id)->first();
        return view('pelanggan.pesanan.index', [
            'pesanan' => Pesanan::where('pelanggan_id', $pelanggan->id)->get(),
        ]);
    }

    public function show(Pesanan $pesanan)
    {
        return view('pelanggan.pesanan.show', [
            'pesanan' => $pesanan,
            'jemaah' => Jemaah::where('pesanan_id', $pesanan->id)->get(),
        ]);
    }
}
