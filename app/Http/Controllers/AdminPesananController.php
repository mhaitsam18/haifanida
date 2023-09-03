<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    public function index()
    {
        return view('admin.pesanan.index', [
            'pesanan' => Pesanan::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.pesanan.create', [
            'paket' => Paket::select('id', 'nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $pelanggan = Pelanggan::select('pelanggan.id')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('email', $request->email)->first();

        $jumlahJemaah = count($request->input('jemaah'));
        $pesanan = Pesanan::create([
            'pelanggan_id' => $pelanggan->id,
            'paket_id'     => $request->paket,
            'jumlah'       => $jumlahJemaah,
            'total_harga'  => $request->harga
        ]);

        for ($i = 0; $i < $jumlahJemaah; $i++) {
            Jemaah::create([
                'pesanan_id' => $pesanan->id,
                'nama' => $request->input('jemaah')[$i],
                'jenis-kelamin' => $request->input('jenis-kelamin')[$i],
            ]);
        }

        $request->session()->flash('alert-class', 'success');
        $request->session()->flash('alert', ['Berhasil', 'Berhasil menambah pesan baru']);
        return redirect()->route('admin.pesanan.index');
    }
}
