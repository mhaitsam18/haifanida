<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json";
        $response = $client->request('GET', $url);
        // Ambil isi dari respons dalam bentuk JSON
        $provinces = json_decode($response->getBody(), true);

        dd($provinces);

        // Sekarang Anda memiliki data provinsi dalam bentuk array asosiatif
        // Anda dapat melakukan apa pun yang Anda inginkan dengan data tersebut
        // Contoh: Tampilkan data provinsi dalam bentuk daftar
        return view('provinces.index', compact('provinces'));
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
