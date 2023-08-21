<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->query());

        $rentangHarga = [
            '20000000-30000000',
            '31000000-40000000',
            '41000000-50000000',
            '51000000-60000000',
            '61000000-70000000',
            '71000000-80000000',
            '81000000-90000000',
            '91000000-100000000',
            '10100000-110000000',
            '1110000-120000000',
        ];

        $paket = Paket::where('stok', '>', 0);

        $filter = $request->query();

        if (!empty($filter['jenis-paket'])) {
            $paket = $paket->where('jenis', $filter['jenis-paket']);
        }

        if (!empty($filter['rentang-harga'])) {
            $filterHarga = explode('-', $rentangHarga[$filter['rentang-harga'] - 1]);

            $paket = $paket->whereBetween('harga_single', $filterHarga);
        }

        if (!empty($filter['tanggal'])) {
            $inputTanggal = explode(' s.d. ', $filter['tanggal']);

            $filterTanggal = [
                date('Y-m-d', strtotime($inputTanggal[0])),
                date('Y-m-d', strtotime($inputTanggal[1])),
            ];

            $paket = $paket->whereBetween('keberangkatan', $filterTanggal);
        }

        return view('landing-page.daftar-paket', [
            'paket' => $paket->get(),
            'rentangHarga' => $rentangHarga,
        ]);
    }

    public function show(Paket $paket)
    {
        return view('landing-page.paket', [
            'paket' => $paket,
            'jadwal' => Catatan::where('kategori_catatan_id', 4)->get(),
            'barangBoleh' => Catatan::where('kategori_catatan_id', 1)->get(),
            'barangDilarang' => Catatan::where('kategori_catatan_id', 2)->get(),
        ]);
    }
}
