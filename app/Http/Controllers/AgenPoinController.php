<?php

namespace App\Http\Controllers;

use App\Models\Poin;

class AgenPoinController extends Controller
{
    /**
     * Riwayat poin milik agen yang sedang login.
     */
    public function index()
    {
        $poins = Poin::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('agen.poin.index', [
            'title' => 'Riwayat Poin',
            'page' => 'poin',
            'poins' => $poins,
            'totalPoin' => Poin::where('user_id', auth()->id())->sum('jumlah_poin'),
        ]);
    }

    /**
     * Detail satu baris poin milik sendiri.
     */
    public function show(Poin $poin)
    {
        abort_unless($poin->user_id === auth()->id(), 403);

        return view('agen.poin.show', [
            'title' => 'Detail Poin',
            'page' => 'poin',
            'poin' => $poin,
        ]);
    }
}
