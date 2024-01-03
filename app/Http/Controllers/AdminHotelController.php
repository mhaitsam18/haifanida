<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class AdminHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.hotel.index', [
            'title' => 'Data Hotel',
            'page' => 'hotel',
            'hotels' => Hotel::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hotel.create', [
            'title' => 'Tambah Hotel',
            'page' => 'hotel',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_hotel' => 'nullable',
            'nama_hotel' => 'required|string',
            'bintang' => 'required|integer',
            'bintang_setaraf' => 'nullable|integer',
            'kota' => 'required|string',
            'negara' => 'required|string',
            'alamat' => 'nullable|string',
            'link_gmaps' => 'nullable|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'deskripsi' => 'nullable|string',
        ]);
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('hotel-gambar');
            $validateData['gambar'] = $path;
        }

        Hotel::create($validateData);
        return redirect('/admin/hotel')->with('success', 'Data Hotel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return view('admin.hotel.show', [
            'title' => 'Detail Hotel',
            'page' => 'hotel',
            'hotel' => $hotel,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        return view('admin.hotel.edit', [
            'title' => 'Edit Hotel',
            'page' => 'hotel',
            'hotel' => $hotel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $validateData = $request->validate([
            'kode_hotel' => 'nullable',
            'nama_hotel' => 'required|string',
            'bintang' => 'required|integer',
            'bintang_setaraf' => 'nullable|integer',
            'kota' => 'required|string',
            'negara' => 'required|string',
            'alamat' => 'nullable|string',
            'link_gmaps' => 'nullable|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'deskripsi' => 'nullable|string',
        ]);
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('hotel-gambar');
            $validateData['gambar'] = $path;
        } else {
            $validateData['gambar'] = $hotel->gambar;
        }
        $hotel->update($validateData);
        return redirect('/admin/hotel')->with('success', 'Data Hotel berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect('/admin/hotel')->with('success', 'Data Hotel berhasil dihapus');
    }
}
