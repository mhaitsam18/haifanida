<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\BerkasJemaah;
use App\Models\Berkas;
use App\Models\Pemesanan;
use App\Models\Jemaah;

class BerkasController extends Controller
{

    public function create($pemesananId, $jemaahId)
    {
        $pemesanan = Pemesanan::findOrFail($pemesananId);
        $jemaah = Jemaah::findOrFail($jemaahId);
        $berkass = Berkas::all(); 
        $title = 'Tambah Berkas Jemaah';

        return view('home.pemesanan.berkas.add-berkas', compact('pemesanan', 'jemaah', 'berkass', 'title'));
    }

    // PERBAIKAN: Tambahkan parameter $pemesananId dan $jemaahId
    public function store(Request $request, $pemesananId, $jemaahId)
    {
        $request->validate([
            'berkas_id' => 'required|exists:berkas,id',
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        // Validasi pemesanan dan jemaah
        $pemesanan = Pemesanan::findOrFail($pemesananId);
        $jemaah = Jemaah::findOrFail($jemaahId);

        $path = null;
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $request->file('file_path')->store('jemaah-berkas', 'public');

        }

        BerkasJemaah::create([
            'jemaah_id' => $jemaahId, 
            'berkas_id' => $request->berkas_id,
            'file_path' => $path,
            'keterangan' => $request->keterangan,
            'status' => 'tertunda', 
        ]);

        // PERBAIKAN: Redirect ke halaman berkas jemaah
        return redirect()->route('pemesanan.jemaah.berkas', [$pemesananId, $jemaahId])
            ->with('success', 'Berkas berhasil dikirim dan sedang ditinjau.');
    }

    /**
     * Menampilkan berkas jemaah
     */
    public function berkasJemaah(Pemesanan $pemesanan, Jemaah $jemaah)
    {
        $berkasJemaahs = BerkasJemaah::with('berkas')
            ->where('jemaah_id', $jemaah->id)
            ->whereHas('jemaah', function ($query) use ($pemesanan) {
                $query->where('pemesanan_id', $pemesanan->id);
            })
            ->get();

        $title = 'Berkas Jemaah';

        return view('home.pemesanan.berkas.berkas', compact('pemesanan', 'jemaah', 'berkasJemaahs', 'title'));
    }
    public function preview(Pemesanan $pemesanan, Jemaah $jemaah, BerkasJemaah $berkasJemaah)
    {
        
        if (!Storage::disk('public')->exists($berkasJemaah->file_path)) {
            abort(404);
        }

        $mime = Storage::disk('public')->mimeType($berkasJemaah->file_path);
        $file = Storage::disk('public')->get($berkasJemaah->file_path);

        return response($file, 200)->header('Content-Type', $mime);
    }
    /**
     * Menampilkan form edit berkas jemaah
     */
    public function editBerkasJemaah(Pemesanan $pemesanan, Jemaah $jemaah, BerkasJemaah $berkasJemaah)
    {
        $berkass = Berkas::all(); 
        $title = 'Edit Berkas Jemaah';
        
        return view('home.pemesanan.berkas.edit', [
            'pemesanan' => $pemesanan,
            'jemaah' => $jemaah,
            'berkasJemaah' => $berkasJemaah,
            'berkass' => $berkass,
            'title' => $title
        ]);
    }

    /**
     * Update berkas jemaah
     */
    public function updateBerkasJemaah(Request $request, Pemesanan $pemesanan, Jemaah $jemaah, BerkasJemaah $berkasJemaah)
    {
        $validateData = $request->validate([
            //'berkas_id' => 'required|exists:berkas,id',
            'file_path' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:3145728', // 3MB max
            'keterangan' => 'nullable|string',
        ]);

        // Jika ada file baru yang diupload
        if ($request->hasFile('file_path')) {
            // Hapus file lama jika ada
            if ($berkasJemaah->file_path && Storage::disk('public')->exists($berkasJemaah->file_path)) {
                Storage::disk('public')->delete($berkasJemaah->file_path);
            }
            
            // Simpan file baru
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('berkas-jemaah', $filename, 'public');
            $validateData['file_path'] = $path;
        }

        // Update data
        $berkasJemaah->update($validateData);

        return redirect()->route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id])
            ->with('success', 'Berkas jemaah berhasil diperbarui.');
    }

    /**
     * Hapus berkas jemaah
     */
    public function destroyBerkasJemaah(Pemesanan $pemesanan, Jemaah $jemaah, BerkasJemaah $berkasJemaah)
    {
        // Hapus file dari storage jika ada
        if ($berkasJemaah->file_path && Storage::disk('public')->exists($berkasJemaah->file_path)) {
            Storage::disk('public')->delete($berkasJemaah->file_path);
        }
        
        // Hapus record dari database
        $berkasJemaah->delete();

        return redirect()->route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id])
            ->with('success', 'Berkas jemaah berhasil dihapus.');
    }
}