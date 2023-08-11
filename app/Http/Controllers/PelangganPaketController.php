<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Paket;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PelangganPaketController extends Controller
{
    public function create(Paket $paket) {
        return view('landing-page.pesan-paket', [
            'paket' => $paket,
        ]);
    }

    public function store(Request $request) {
        // dd($request->input());

        $pesanan = Pesanan::create([
            'pelanggan_id' => auth()->user()->id,
            'paket_id' => $request->paket,
            'jumlah' => 1,
        ]);

        for ($i=0; $i < count($request->input('jemaah')); $i++) {
            Jemaah::create([
                'pesanan_id' => $pesanan->id,
                'nama' => $request->input('jemaah')[$i],
                'jenis-kelamin' => $request->input('jenis-kelamin')[$i],
            ]);
        }

        return 'berhasil';
        // return redirect('pelanggan.pesanan');
    }
}
