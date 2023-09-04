<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.faq.index', [
            'faq' => Faq::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
        ]);

        $request->session()->flash('alert-class', 'success');
        $request->session()->flash('alert', ['Berhasil', 'Berhasil menyimpan faq']);
        return redirect()->route('admin.faq.index');
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
        return view('admin.faq.edit', [
            'faq' => Faq::where('id', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Faq::where('id', $id)->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        $request->session()->flash('alert-class', 'success');
        $request->session()->flash('alert', ['Berhasil', 'Berhasil mengubah faq']);
        return redirect()->route('admin.faq.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Faq::where('id', $id)->delete();

        request()->session()->flash('alert-class', 'success');
        request()->session()->flash('alert', ['Berhasil', 'Berhasil menghapus faq']);
        return redirect()->route('admin.faq.index');
    }
}
