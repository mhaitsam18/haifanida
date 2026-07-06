<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class AgenController extends Controller
{
    public function index()
    {
        $agen = auth()->user()->agen;
        $currentYear = now()->year;

        $grupIds = $agen?->grups()->pluck('id') ?? collect();
        $jemaahs = Jemaah::whereIn('grup_id', $grupIds)->get();
        $pemesananIds = $jemaahs->pluck('pemesanan_id')->filter()->unique()->values();

        $jumlahJemaah = $jemaahs->count();
        $jumlahPemesanan = $pemesananIds->count();
        $totalPoin = $agen?->poins()->sum('jumlah_poin') ?? 0;

        $pemasukanPerBulan = DB::table(DB::raw("(SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) as months"))
            ->leftJoinSub(
                Pembayaran::selectRaw('MONTH(tanggal_pembayaran) as month, SUM(jumlah_pembayaran) as total')
                    ->whereIn('pemesanan_id', $pemesananIds)
                    ->where('status_pembayaran', 'diterima')
                    ->whereYear('tanggal_pembayaran', $currentYear)
                    ->groupBy('month'),
                'pemasukan_per_month',
                'months.month',
                '=',
                'pemasukan_per_month.month'
            )
            ->select('months.month', DB::raw('COALESCE(pemasukan_per_month.total, 0) as total'))
            ->get();

        return view('agen.index', [
            'title' => 'Dashboard Agen',
            'page' => 'index',
            'agen' => $agen,
            'jumlahJemaah' => $jumlahJemaah,
            'jumlahPemesanan' => $jumlahPemesanan,
            'totalPoin' => $totalPoin,
            'pemasukanPerBulan' => $pemasukanPerBulan,
        ]);
    }
}
