<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\BerkasJemaah;
use App\Models\Jemaah;
use Illuminate\Http\Request;
// MODIFIED--
use Illuminate\Support\Facades\Storage;
// --MODIFIED
class AdminBerkasJemaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Jemaah $jemaah = null)
    {
        return view('admin.paket.jemaah.berkas.index', [
            'title' => "Berkas Jema'ah",
            'page' => 'berkas-jemaah',
            'berkasJemaahs' => $jemaah ? BerkasJemaah::with(['jemaah', 'berkas'])->where('jemaah_id', $jemaah->id)->paginate(200) : BerkasJemaah::with(['jemaah', 'berkas'])->paginate(200),
            'jemaah' => $jemaah,
            'berkass' => Berkas::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'berkas_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
            'file_path' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:3145728',
            'status' => 'required|string',
        ]);
        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('jemaah-berkas');
            $validateData['file_path'] = $path;
        }

        BerkasJemaah::create($validateData);
        return back()->with('success', 'Data Berkas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BerkasJemaah $berkasJemaah)
    {
        return view('admin.paket.jemaah.berkas.show', [
            'title' => 'Lihat Berkas',
            'page' => 'berkas-jemaah',
            'berkasJemaah' => $berkasJemaah,
        ]);
    }
    // MODIFIED--
    public function preview($jemaah, BerkasJemaah $berkasJemaah)
    {
        
        if (!Storage::disk('public')->exists($berkasJemaah->file_path)) {
            abort(404);
        }

        $mime = Storage::disk('public')->mimeType($berkasJemaah->file_path);
        $file = Storage::disk('public')->get($berkasJemaah->file_path);

        return response($file, 200)->header('Content-Type', $mime);
    }
    // --MODIFIED
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BerkasJemaah $berkasJemaah)
    {
        $validateData = $request->validate([
            'berkas_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
            'file_path' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:3145728',
            'status' => 'required|string',
        ]);
        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('jemaah-berkas');
            $validateData['file_path'] = $path;
        } else {
            $validateData['file_path'] = $berkasJemaah->file_path;
        }

        $berkasJemaah->update($validateData);
        return back()->with('success', "Berkas Jema'ah berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BerkasJemaah $berkasJemaah)
    {
        $berkasJemaah->delete();
        return back()->with('success', 'Data Berkas Jemaah berhasil dihapus');
    }
}
