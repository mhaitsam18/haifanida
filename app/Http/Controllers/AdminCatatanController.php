<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;

class AdminCatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catatan = Catatan::with('kategori')->get();

        return view('admin.catatan.index', [
            // Kelompokkan berdasarkan kategori
            // dan mbil semua catatan kecuali untuk kategori jadwal_keberangkatan
            'kategoriCatatan' => $catatan->groupBy('kategori_catatan_id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
