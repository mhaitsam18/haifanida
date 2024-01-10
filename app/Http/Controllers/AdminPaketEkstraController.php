<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use App\Models\Paket;
use App\Models\PaketEkstra;
use Illuminate\Http\Request;

class AdminPaketEkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Paket $paket = null)
    {
        return view('admin.paket.ekstra.index', [
            'title' => 'Data Ekstra paket',
            'page' => 'paket-ekstra',
            'paket' => $paket,
            'paketEkstras' => ($paket) ? $paket->paketEkstras : PaketEkstra::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paket $paket = null)
    {
        return view('admin.paket.ekstra.create', [
            'title' => 'Tambah Data Paket Ekstra',
            'page' => 'paket-ekstra',
            'paket' => $paket,
            'pakets' => Paket::all(),
            'ekstras' => Ekstra::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'ekstra_id' => 'required|integer',
            'harga' => 'nullable|integer',
        ]);

        PaketEkstra::create($validateData);
        return back()->with('success', 'Data Paket Ekstra berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaketEkstra $paketEkstra)
    {
        return view('admin.paket.ekstra.show', [
            'title' => 'Detail Paket Ekstra',
            'page' => 'paket-ekstra',
            'paketEkstra' => $paketEkstra,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaketEkstra $paketEkstra)
    {
        return view('admin.paket.ekstra.edit', [
            'title' => 'Edit Paket Ekstra',
            'page' => 'paket-ekstra',
            'paketEkstra' => $paketEkstra,
            'pakets' => Paket::all(),
            'ekstras' => Ekstra::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaketEkstra $paketEkstra)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'ekstra_id' => 'required|integer',
            'harga' => 'nullable|integer',
        ]);

        $paketEkstra->update($validateData);
        return back()->with('success', 'Data Paket Ekstra berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaketEkstra $paketEkstra)
    {
        $paketEkstra->delete();
        return back()->with('success', 'Data Paket Ekstra berhasil dihapus');
    }
}
