<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\IsuPerjalanan;
use Illuminate\Http\Request;

class AdminIsuPerjalananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Grup $grup = null)
    {
        return view('admin.paket.grup.isu-perjalanan.index', [
            'title' => 'Data Isu Perjalanan',
            'page' => 'isu-perjalanan',
            'grup' => $grup,
            'isuPerjalanans' => ($grup) ? $grup->isuPerjalanans : IsuPerjalanan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Grup $grup = null)
    {
        return view('admin.paket.grup.isu-perjalanan.create', [
            'title' => 'Buat Isu Perjalanan',
            'page' => 'isu-perjalanan',
            'grup' => $grup,
            'grups' => Grup::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'grup_id' => 'required|integer',
            'masalah' => 'required|string',
            'solusi' => 'nullable|string',
            'waktu_pelaporan' => 'nullable|string',
            'waktu_penyelesaian' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
        $validateData['status'] ??= 0;

        IsuPerjalanan::create($validateData);
        return back()->with('success', 'Data Grup berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(IsuPerjalanan $isuPerjalanan)
    {
        return view('admin.paket.grup.isu-perjalanan.show', [
            'title' => 'Detail Isu Perjalanan',
            'page' => 'isu-perjalanan',
            'isuPerjalanan' => $isuPerjalanan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IsuPerjalanan $isuPerjalanan)
    {
        return view('admin.paket.grup.isu-perjalanan.edit', [
            'title' => 'Edit Isu Perjalanan',
            'page' => 'isu-perjalanan',
            'isuPerjalanan' => $isuPerjalanan,
            'grups' => Grup::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IsuPerjalanan $isuPerjalanan)
    {
        $validateData = $request->validate([
            'grup_id' => 'required|integer',
            'masalah' => 'required|string',
            'solusi' => 'nullable|string',
            'waktu_pelaporan' => 'nullable|string',
            'waktu_penyelesaian' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
        $validateData['status'] ??= 0;

        $isuPerjalanan->update($validateData);
        return back()->with('success', 'Data Isu Perjalanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IsuPerjalanan $isuPerjalanan)
    {
        $isuPerjalanan->delete();
        return back()->with('success', 'Data Isu Perjalanan berhasil dihapus');
    }
}
