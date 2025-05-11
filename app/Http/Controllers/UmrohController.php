<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class UmrohController extends Controller
{
    public function index()
    {
        return view('home.umroh', [
            'title' => 'Paket Umroh',
            'pakets' => Paket::where('jenis_paket', 'umroh')
                ->whereNotNull('published_at')
                ->latest()
                ->get()
        ]);
    }

    public function show($id)
    {
        $paket = Paket::findOrFail($id);
        return view('home.detail-paket', [
            'title' => $paket->nama_paket,
            'paket' => $paket
        ]);
    }
}