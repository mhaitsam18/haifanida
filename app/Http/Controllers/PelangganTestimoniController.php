<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pesanan;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class PelangganTestimoniController extends Controller
{
    public function index()
    {

        $testimoni = Pesanan::select('pesanan.id', 'paket_id', 'testimoni', 'rating')
            ->where('pesanan.pelanggan_id', auth()->user()->id)
            ->leftJoin('testimoni', 'pesanan_id', '=', 'pesanan.id')
            ->get();

        return view('pelanggan.testimoni.index', [
            // 'testimoni' => Testimoni::where('pelanggan_id', auth()->user()->id)->get(),
            'testimoni' => $testimoni,
        ]);
    }

    public function create(Pesanan $pesanan)
    {
        return view('pelanggan.testimoni.create', [
            'pesanan' => $pesanan,
        ]);
    }

    public function store(Request $request)
    {
        Testimoni::firstOrCreate([
            'pelanggan_id' => auth()->user()->id,
            'pesanan_id' => $request->p,
        ], [
            'testimoni' => $request->testimoni,
            'rating' => $request->rating,
        ]);

        $request->session()->flash('alert-class', 'success');
        $request->session()->flash('alert', ['Berhasil', 'Berhasil menyimpan testimoni']);
        return redirect()->route('pelanggan.testimoni');
    }
}