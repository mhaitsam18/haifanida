<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Grup $grup = null)
    {
        return view('admin.paket.grup.jadwal.index', [
            'title' => 'Data Jadwal',
            'page' => 'jadwal',
            'grup' => $grup,
            'jadwals' => ($grup) ? $grup->jadwals : Jadwal::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Grup $grup = null)
    {
        return view('admin.paket.grup.jadwal.create', [
            'title' => 'Buat Agenda',
            'page' => 'jadwal',
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
            'nama_agenda' => 'required|string',
            'lokasi' => 'nullable|string',
            'waktu_mulai' => 'nullable|string',
            'waktu_selesai' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        Jadwal::create($validateData);
        return back()->with('success', 'Data Grup berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        return view('admin.paket.grup.jadwal.show', [
            'title' => 'Detail Jadwal',
            'page' => 'jadwal',
            'jadwal' => $jadwal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        return view('admin.paket.grup.jadwal.edit', [
            'title' => 'Edit Jadwal',
            'page' => 'jadwal',
            'jadwal' => $jadwal,
            'grups' => Grup::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validateData = $request->validate([
            'grup_id' => 'required|integer',
            'nama_agenda' => 'required|string',
            'lokasi' => 'nullable|string',
            'waktu_mulai' => 'nullable|string',
            'waktu_selesai' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal->update($validateData);
        return back()->with('success', 'Data Jadwal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return back()->with('success', 'Data Jadwal berhasil dihapus');
    }
}
