<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PelangganPesananController extends Controller
{
    public function index()
    {
        return view('pelanggan.pesanan.index', [
            'pesanan' => Pesanan::where('pelanggan_id', auth()->user()->id)->get(),
        ]);
    }

    public function show(Pesanan $pesanan)
    {
        return view('pelanggan.pesanan.show', [
            'pesanan' => $pesanan,
        ]);
    }
}
