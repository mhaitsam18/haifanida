<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use Illuminate\Http\Request;

class AdminAgenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.agen.index', [
            'title' => 'Data agen',
            'page' => 'agen',
            'agens' => Agen::with('user')->get(),
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
    public function show(Agen $agen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agen $agen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agen $agen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agen $agen)
    {
        //
    }
}
