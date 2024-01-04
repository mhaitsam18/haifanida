<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kabupaten $kabupaten)
    {
        //
    }

    public function getKabupaten(Request $request)
    {
        $kabupatenData = [];
        if ($request->provinsi_id) {
            $kabupatenData = Kabupaten::where('provinsi_id', $request->provinsi_id)->get();
        }
        if ($request->provinsi) {
            $provinsi = Provinsi::where('provinsi', $request->provinsi)->first();
            $kabupatenData = Kabupaten::where('provinsi_id', $provinsi->id)->get();
        }

        return response()->json($kabupatenData);
    }
}
