<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Kantor;
use App\Models\Paket;
use Illuminate\Http\Request;

class AdminPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.paket.index', [
            'title' => 'Data paket',
            'page' => 'paket',
            'pakets' => Paket::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kantor = Kantor::find(auth()->user()->admin->kantor_id);
        return view('admin.paket.create', [
            'title' => 'Tambah Paket',
            'page' => 'paket',
            'kantor' => $kantor,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Paket $paket)
    {
        $validateData = $request->validate([
            // 'kode_paket' => 'nullable',
            'nama_paket' => 'required|string',
            'destinasi' => 'required|string',
            'jenis_paket' => 'required|in:haji,umroh,wisata_halal',
            'durasi' => 'required|numeric',
            'harga' => 'required|integer',
            'fasilitas' => 'required|string',
            'deskripsi' => 'required|string',
            'tempat_keberangkatan' => 'required|string',
            'tempat_kepulangan' => 'required|string',
            'tanggal_mulai' => 'required|string',
            'tanggal_selesai' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
        ]);

        $validateData['published_at'] = $request->published_at ? now() : null;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('paket-gambar', 'public');
            $paket->gambar = str_replace('public/', '', $path);
            $validateData['gambar'] = $path;
        }

        if (is_array($validateData)) {
            Paket::create($validateData);
            return redirect('/admin/paket')->with('success', 'Data paket berhasil ditambah');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat validasi data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        $jemaahs = Jemaah::query();

        if ($paket) {
            $jemaahs->whereHas('pemesanan', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            })->orWhereHas('grup', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            });
        }
        $jemaahs = $jemaahs->get();

        return view('admin.paket.show', [
            'title' => 'Detail Paket',
            'page' => 'paket',
            'paket' => $paket,
            'jemaahs' => $jemaahs,
            'kantors' => Kantor::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        return view('admin.paket.edit', [
            'title' => 'Edit Paket',
            'page' => 'paket',
            'paket' => $paket,
            'kantors' => Kantor::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paket $paket)
    {
        $validateData = $request->validate([
            // 'kode_paket' => 'nullable',
            'nama_paket' => 'required|string',
            'destinasi' => 'required|string',
            'jenis_paket' => 'required|in:haji,umroh,wisata_halal',
            'durasi' => 'required|numeric',
            'harga' => 'required|integer',
            'fasilitas' => 'required|string',
            'deskripsi' => 'required|string',
            'tempat_keberangkatan' => 'required|string',
            'tempat_kepulangan' => 'required|string',
            'tanggal_mulai' => 'required|string',
            'tanggal_selesai' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
        ]);

        $validateData['published_at'] = $request->published_at ? now() : null;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('paket-gambar', 'public');
            $paket->gambar = str_replace('public/', '', $path);
            $validateData['gambar'] = $path;
        } else {
            $validateData['gambar'] = $paket->gambar;
        }

        if (is_array($validateData)) {
            $paket->update($validateData);
            return redirect('/admin/paket')->with('success', 'Data paket berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat validasi data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect('/admin/paket')->with('success', 'Data Paket berhasil dihapus');
    }
}