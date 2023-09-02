<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class AdminKontakController extends Controller
{
    public function index()
    {
        return view('admin.kontak.index', [
            'kontak' => Kontak::get(),
        ]);
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
}
