<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    /**
     * Show the form for creating a new payment.
     */
    public function createPembayaran(Pemesanan $pemesanan)
    {
        // Check if pemesanan exists and belongs to the authenticated user
        if (!$pemesanan->exists || $pemesanan->user_id != Auth::id()) {
            return redirect()->route('home')->with('error', 'Pemesanan tidak ditemukan atau Anda tidak memiliki akses.');
        }

        return view('home.pemesanan.pembayaran.add-pembayaran', [
            'title' => 'Tambah Pembayaran',
            'page' => 'pembayaran',
            'pemesanan' => $pemesanan,
        ]);
    }

    /**
     * Store a newly created payment in storage.
     */
    public function storePembayaran(Request $request)
    {
        $validatedData = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id',
            'jumlah_pembayaran' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string|max:255',
            'tanggal_pembayaran' => 'required|date',
            'bukti_pembayaran' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:3145728',
            'keterangan' => 'nullable|string|max:1000',
        ], [
            'pemesanan_id.required' => 'Pemesanan tidak ditemukan.',
            'pemesanan_id.exists' => 'Pemesanan tidak valid.',
            'jumlah_pembayaran.required' => 'Jumlah pembayaran harus diisi.',
            'jumlah_pembayaran.numeric' => 'Jumlah pembayaran harus berupa angka.',
            'jumlah_pembayaran.min' => 'Jumlah pembayaran minimal adalah 1.',
            'metode_pembayaran.required' => 'Metode pembayaran harus diisi.',
            'metode_pembayaran.string' => 'Metode pembayaran harus berupa teks.',
            'tanggal_pembayaran.required' => 'Tanggal pembayaran harus diisi.',
            'tanggal_pembayaran.date' => 'Tanggal pembayaran tidak valid.',
            'bukti_pembayaran.required' => 'Bukti pembayaran harus diunggah.',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file JPEG, PNG, JPG, GIF, atau PDF.',
            'bukti_pembayaran.max' => 'Bukti pembayaran tidak boleh lebih dari 3MB.',
        ]);

        // Verify user ownership
        $pemesanan = Pemesanan::findOrFail($validatedData['pemesanan_id']);
        if ($pemesanan->user_id !== Auth::id()) {
            Log::warning('Unauthorized access attempt: User ID ' . Auth::id() . ', Pemesanan ID ' . $pemesanan->id);
            return back()->with('error', 'Anda tidak memiliki akses ke pemesanan ini.');
        }

        // Handle file upload
        if ($request->hasFile('bukti_pembayaran') && $request->file('bukti_pembayaran')->isValid()) {
            $path = $request->file('bukti_pembayaran')->store('pembayaran-bukti', 'public');
            $validatedData['bukti_pembayaran'] = $path;
        } else {
            Log::error('Invalid file upload for bukti_pembayaran');
            return back()->with('error', 'Gagal mengunggah bukti pembayaran. Pastikan file valid dan kurang dari 3MB.');
        }

        // Set default status for admin verification
        $validatedData['status_pembayaran'] = 'tertunda';

        // Create the payment
        Pembayaran::create($validatedData);

        return redirect()->route('pemesanan.detail', $pemesanan->id)
                        ->with('success', 'Pembayaran berhasil diajukan dan menunggu verifikasi admin.');
    }
}
