<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\PemesananStatusHistory;
use App\Models\Poin;
use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pemesanan $pemesanan = null)
    {
        return view('admin.paket.pemesanan.pembayaran.index', [
            'title' => 'Riwayat Pembayaran',
            'page' => 'pembayaran',
            'pemesanan' => $pemesanan,
            'pembayarans' => ($pemesanan) ? $pemesanan->pembayarans()->paginate(200) : Pembayaran::paginate(200),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'pemesanan_id' => 'required|integer',
            'jumlah_pembayaran' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'tanggal_pembayaran' => 'required|date',
            'status_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:3145728',
            'keterangan' => 'nullable|string',
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('pembayaran-bukti');
            $validateData['bukti_pembayaran'] = $path;
        }

        Pembayaran::create($validateData);
        return back()->with('success', 'Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('admin.paket.pemesanan.pembayaran.show', [
            'title' => 'Detail Pembayaran',
            'page' => 'pembayaran',
            'pembayaran' => $pembayaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validateData = $request->validate([
            'pemesanan_id' => 'required|integer',
            'jumlah_pembayaran' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'tanggal_pembayaran' => 'required|date',
            'status_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:3145728',
            'keterangan' => 'nullable|string',
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('pembayaran-bukti');
            $validateData['bukti_pembayaran'] = $path;
        } else {
            $validateData['bukti_pembayaran'] = $pembayaran->bukti_pembayaran;
        }

        $pembayaran->update($validateData);
        return back()->with('success', 'Pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return back()->with('success', 'Pembayaran berhasil dihapus');
    }

    /**
     * Verifikasi pembayaran: tandai diterima, catat siapa yang memverifikasi,
     * dan tulis satu baris ke pemesanan_status_history.
     */
    public function verify(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status_pembayaran' => 'diterima',
            'diverifikasi_oleh' => auth()->id(),
        ]);

        PemesananStatusHistory::create([
            'pemesanan_id' => $pembayaran->pemesanan_id,
            'status' => 'pembayaran_diterima',
            'catatan' => 'Pembayaran Rp' . number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') . ' diverifikasi oleh ' . auth()->user()->name,
            'changed_by' => auth()->id(),
        ]);

        $this->awardKomisiAgen($pembayaran);
        $this->awardBonusReferral($pembayaran);

        return back()->with('success', 'Pembayaran berhasil diverifikasi');
    }

    /**
     * Beri poin komisi ke agen yang menaungi jemaah dari pemesanan ini
     * (ditelusuri lewat pemesanan -> jemaah -> grup -> agen), bila ada.
     * Rasio poin diatur di config('finance.komisi_agen_poin_per_rp').
     */
    private function awardKomisiAgen(Pembayaran $pembayaran): void
    {
        $pemesanan = $pembayaran->pemesanan;

        if (! $pemesanan) {
            return;
        }

        $grup = $pemesanan->jemaahs->pluck('grup')->filter()->first();
        $agen = $grup?->agen;

        if (! $agen || ! $agen->user_id) {
            return;
        }

        $rate = (float) config('finance.komisi_agen_poin_per_rp', 100000);
        $jumlahPoin = $rate > 0 ? intdiv((int) $pembayaran->jumlah_pembayaran, (int) $rate) : 0;

        if ($jumlahPoin <= 0) {
            return;
        }

        Poin::create([
            'user_id' => $agen->user_id,
            'tipe' => 'komisi_agen',
            'referensi_type' => Pembayaran::class,
            'referensi_id' => $pembayaran->id,
            'jumlah_poin' => $jumlahPoin,
            'keterangan' => 'Komisi dari pembayaran pemesanan #' . $pemesanan->id . ' (Rp' . number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') . ')',
        ]);
    }

    /**
     * Beri poin bonus_referral ke agen perujuk saat pembayaran PERTAMA dari
     * member yang direferensikannya berhasil diverifikasi. Nilai poin diatur
     * di config('finance.bonus_referral_poin').
     */
    private function awardBonusReferral(Pembayaran $pembayaran): void
    {
        $pemesanan = $pembayaran->pemesanan;

        if (! $pemesanan || ! $pemesanan->user_id) {
            return;
        }

        $member = Member::where('user_id', $pemesanan->user_id)->first();

        if (! $member || ! $member->referred_by) {
            return;
        }

        $pemesananIds = Pemesanan::where('user_id', $member->user_id)->pluck('id');

        $sudahPernahBayar = Pembayaran::whereIn('pemesanan_id', $pemesananIds)
            ->where('status_pembayaran', 'diterima')
            ->where('id', '!=', $pembayaran->id)
            ->exists();

        if ($sudahPernahBayar) {
            return;
        }

        $agen = $member->referrer;

        if (! $agen || ! $agen->user_id) {
            return;
        }

        $poin = (int) config('finance.bonus_referral_poin', 10);

        if ($poin <= 0) {
            return;
        }

        Poin::create([
            'user_id' => $agen->user_id,
            'tipe' => 'bonus_referral',
            'referensi_type' => Member::class,
            'referensi_id' => $member->id,
            'jumlah_poin' => $poin,
            'keterangan' => 'Bonus referral: pembayaran pertama dari ' . ($member->nama_lengkap ?? 'member #' . $member->id),
        ]);
    }

    /**
     * Tolak pembayaran: tandai ditolak, catat siapa yang menolak,
     * dan tulis satu baris ke pemesanan_status_history.
     */
    public function reject(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update([
            'status_pembayaran' => 'ditolak',
            'diverifikasi_oleh' => auth()->id(),
            'keterangan' => $validated['keterangan'] ?? $pembayaran->keterangan,
        ]);

        PemesananStatusHistory::create([
            'pemesanan_id' => $pembayaran->pemesanan_id,
            'status' => 'pembayaran_ditolak',
            'catatan' => 'Pembayaran Rp' . number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') . ' ditolak oleh ' . auth()->user()->name . ($validated['keterangan'] ?? '' ? ': ' . $validated['keterangan'] : ''),
            'changed_by' => auth()->id(),
        ]);

        return back()->with('success', 'Pembayaran berhasil ditolak');
    }
}
