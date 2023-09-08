<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminKontakController extends Controller
{
    public function index()
    {
        return view('admin.kontak.index', [
            'kontak' => Kontak::get(),
        ]);
    }

    public function create()
    {
        return view('admin.kontak.create');
    }

    public function store(Request $request)
    {
        Kontak::create([
            'key' => $request->key,
            'value' => $request->value,
        ]);

        $request->session()->flash('alert-class', 'success');
        $request->session()->flash('alert', ['Berhasil', 'Berhasil menambah kontak']);
        return redirect()->route('admin.kontak.index');
    }

    public function show(string $key)
    {
        //
    }

    public function edit(string $key)
    {
        return view('admin.kontak.edit', [
            'kontak' => Kontak::where('key', $key)->first(),
        ]);
    }

    public function update(Request $request, string $key)
    {
        Kontak::where('key', $key)->update([
            'key'   => $request->key,
            'value' => $request->value,
        ]);

        $request->session()->flash('alert-class', 'success');
        $request->session()->flash('alert', ['Berhasil', 'Berhasil mengubah kontak']);
        return redirect()->route('admin.kontak.index');
    }

    public function destroy(string $key)
    {
        Kontak::where('key', $key)->delete();

        request()->session()->flash('alert-class', 'success');
        request()->session()->flash('alert', ['Berhasil', 'Berhasil menghapus kontak']);
        return redirect()->route('admin.kontak.index');
    }
}
