<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganPaketController extends Controller
{
    public function create(Paket $paket)
    {
        return view('landing-page.pesan-paket', [
            'paket' => $paket,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->input());

        $jumlahJemaah = 0;
        $jemaah = $request->input('jemaah');

        foreach ($jemaah as $j) {
            if (! empty($j)) {
                $jumlahJemaah++;
            }
        }

        $pelanggan = Pelanggan::select('id')->where('user_id', auth()->user()->id)->first();

        $pesanan = Pesanan::create([
            'pelanggan_id' => $pelanggan->id,
            'paket_id' => $request->paket,
            'jumlah' => $jumlahJemaah,
        ]);

        for ($i = 0; $i < $jumlahJemaah; $i++) {
            Jemaah::create([
                'pesanan_id' => $pesanan->id,
                'nama' => $request->input('jemaah')[$i],
                'jenis-kelamin' => $request->input('jenis-kelamin')[$i],
            ]);
        }

        DB::table('paket')->where('id', $request->paket)->decrement('stok', $jumlahJemaah);

        $request->session()->flash('alert', 'Pesanan berhasil dibuat');
        return redirect()->route('paket', ['paket' => $request->paket]);
    }
}
