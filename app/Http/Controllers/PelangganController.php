<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $idPelanggan = Pelanggan::where('user_id', auth()->user()->id)->first();

        return view('pelanggan.index', [
            'pesananTerakhir' => Pesanan::where('pelanggan_id', $idPelanggan->id)
                ->limit(5)
                ->orderBy('id', 'DESC')
                ->get(),
            'testimoniTerakhir' => Testimoni::where('pelanggan_id', $idPelanggan->id)
                ->limit(5)
                ->orderBy('id', 'DESC')
                ->get(),
        ]);
    }

    public function kontak()
    {
        return view('pelanggan.kontak', [
            'kontak' => Kontak::get(),
        ]);
    }
}
