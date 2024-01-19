<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Grup;
use App\Models\Jemaah;
use App\Models\Paket;
use Illuminate\Http\Request;

class AdminGrupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Paket $paket = null)
    {
        return view('admin.paket.grup.index', [
            'title' => 'Data grup',
            'page' => 'grup',
            'paket' => $paket,
            'grups' => ($paket) ? $paket->grups : Grup::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paket $paket = null)
    {
        return view('admin.paket.grup.create', [
            'title' => 'Tambah Data Grup',
            'page' => 'grup',
            'paket' => $paket,
            'pakets' => Paket::all(),
            'agens' => Agen::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'agen_id' => 'nullable|integer',
            'nama_grup' => 'required|string',
            'ketua_grup' => 'nullable|string',
            'keterangan_grup' => 'nullable|string',
            'status_grup' => 'nullable|string',
            'kuota_grup' => 'nullable|integer',
        ]);

        Grup::create($validateData);
        return back()->with('success', 'Data Grup berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grup $grup)
    {
        $jemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($grup) {
            $query->where('paket_id', $grup->paket_id);
        })->whereNull('grup_id')->get();
        return view('admin.paket.grup.show', [
            'title' => 'Detail grup',
            'page' => 'grup',
            'grup' => $grup,
            'jemaahs' => $jemaahs,
            'anggotas' => Jemaah::where('grup_id', $grup->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grup $grup)
    {
        return view('admin.paket.grup.edit', [
            'title' => 'Edit grup',
            'page' => 'grup',
            'grup' => $grup,
            'pakets' => Paket::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grup $grup)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'agen_id' => 'nullable|integer',
            'nama_grup' => 'required|string',
            'ketua_grup' => 'nullable|string',
            'keterangan_grup' => 'nullable|string',
            'status_grup' => 'nullable|string',
            'kuota_grup' => 'nullable|integer',
        ]);

        $grup->update($validateData);
        return back()->with('success', 'Data Grup berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grup $grup)
    {
        $grup->delete();
        return back()->with('success', 'Data Grup berhasil dihapus');
    }



    public function pindahKeGrup(Request $request)
    {
        $jemaahIds = $request->input('jemaah_ids');
        if ($jemaahIds) {
            Jemaah::whereIn('id', $jemaahIds)->update(['grup_id' => $request->grup_id]);
        }
        return response()->json(['message' => 'Data berhasil dipindahkan ke grup.']);
    }

    public function kembaliKeJemaah(Request $request)
    {
        $anggotaIds = $request->input('anggota_ids');
        if ($anggotaIds) {
            Jemaah::whereIn('id', $anggotaIds)->update(['grup_id' => null]);
        }
        return response()->json(['message' => 'Data berhasil dikembalikan ke jemaah.']);
    }
}
