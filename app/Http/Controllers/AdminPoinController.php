<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Poin;
use Illuminate\Http\Request;

class AdminPoinController extends Controller
{
    /**
     * Buku besar poin lintas semua agen.
     */
    public function index()
    {
        return view('admin.poin.index', [
            'title' => 'Manajemen Poin Agen',
            'page' => 'poin',
            'poins' => Poin::with('user')->latest()->paginate(20),
            'agens' => Agen::with('user')->get(),
        ]);
    }

    /**
     * Simpan penyesuaian poin manual (tipe = penyesuaian).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'jumlah_poin' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        Poin::create([
            'user_id' => $validated['user_id'],
            'tipe' => 'penyesuaian',
            'jumlah_poin' => $validated['jumlah_poin'],
            'keterangan' => $validated['keterangan'],
        ]);

        return redirect()->route('admin.poin.index')->with('success', 'Penyesuaian poin berhasil ditambahkan');
    }

    /**
     * Hapus satu baris poin yang keliru.
     */
    public function destroy(Poin $poin)
    {
        $poin->delete();

        return back()->with('success', 'Poin berhasil dihapus');
    }
}
