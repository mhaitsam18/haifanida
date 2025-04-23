<?php

namespace App\Http\Controllers;

use App\Mail\SendingEmail;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminPesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pesan.index', [
            'title' => 'Saran dan Keluhan',
            'page' => 'pesan',
            'pesans' => Pesan::all(),
        ]);
    }

    public function kirimEmail(Request $request)
    {
        $request->validate([
            'subjek' => 'required',
            'email_pengirim' => 'required|email',
            'pesan' => 'required|string',
        ]);
        Mail::to($request->email_pengirim)->send(new SendingEmail("Haifa Nida Menjawab : " . $request->subjek, $request->pesan));
        return back()->with('success', 'Email berhasil dikirim');
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
    public function show(Pesan $pesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesan $pesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesan $pesan)
    {
        //
    }
}
