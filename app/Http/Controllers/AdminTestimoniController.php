<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class AdminTestimoniController extends Controller
{
    public function index()
    {
        return view('admin.testimoni.index', [
            'testimoni' => Testimoni::get(),
        ]);
    }

    /**
     * Aktifkan testimoni agar bisa ditampilkan di landing page
     */
    public function aktif(Request $request)
    {
        Testimoni::where('id', $request->t)->update(['shown' => 1]);

        return redirect()->route('admin.testimoni.index');
    }

    /**
     * Nonaktifkan testimoni agar tidak ditampilkan di landing page
     */
    public function nonaktif(Request $request)
    {
        Testimoni::where('id', $request->t)->update(['shown' => 0]);

        return redirect()->route('admin.testimoni.index');
    }
}
