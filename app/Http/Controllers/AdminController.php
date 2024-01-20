<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Paket;
use App\Models\Pembayaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        //Preparation Month dan Year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        //Daftar Jemaah Bulan ini

        $jemaah_daftar_bulan_ini = Jemaah::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        //menghitung jemaah per bulannya

        $jemaah_per_bulan = DB::table(DB::raw("(SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) as months"))
            ->leftJoin(DB::raw('(SELECT MONTH(created_at) as month, COUNT(*) as jumlah_jemaah FROM jemaah WHERE YEAR(created_at) = :year GROUP BY MONTH(created_at)) as jemaah_per_month'), function ($join) {
                $join->on('months.month', '=', 'jemaah_per_month.month');
            })
            ->setBindings(['year' => $currentYear])
            ->select('months.month', DB::raw('COALESCE(jemaah_per_month.jumlah_jemaah, 0) as jumlah_jemaah'))
            ->get();

        //menghitung persentase peningkatan jemaah
        // Jumlah jemaah bulan kemarin
        $previousMonth = ($currentMonth - 1 <= 0) ? 12 : $currentMonth - 1;
        $previousYear = ($currentMonth - 1 <= 0) ? $currentYear - 1 : $currentYear;

        $jemaah_daftar_bulan_kemarin = Jemaah::whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $previousYear)
            ->count();

        // Persentase peningkatan atau penurunan
        $persentase_peningkatan = 0;

        if ($jemaah_daftar_bulan_kemarin != 0) {
            $persentase_peningkatan = (($jemaah_daftar_bulan_ini - $jemaah_daftar_bulan_kemarin) / $jemaah_daftar_bulan_kemarin) * 100;
        } else {
            // Kasus khusus jika bulan kemarin tidak ada yang mendaftar
            $persentase_peningkatan = ($jemaah_daftar_bulan_ini > 0) ? 100 : 0; // Misalnya, jika bulan ini ada yang mendaftar, maka persentase peningkatannya 100%, jika tidak, maka 0%.
        }

        $jumlah_keberangkatan_bulan_ini = Paket::whereMonth('tanggal_mulai', $currentMonth)
            ->whereYear('tanggal_mulai', $currentYear)
            ->count();

        // Jumlah keberangkatan per bulan
        $jumlah_keberangkatan_per_bulan = DB::table(DB::raw("(SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) as months"))
            ->leftJoin(DB::raw('(SELECT MONTH(tanggal_mulai) as month, COUNT(*) as jumlah_keberangkatan FROM paket WHERE YEAR(tanggal_mulai) = :year GROUP BY MONTH(tanggal_mulai)) as keberangkatan_per_month'), function ($join) {
                $join->on('months.month', '=', 'keberangkatan_per_month.month');
            })
            ->setBindings(['year' => $currentYear])
            ->select('months.month', DB::raw('COALESCE(keberangkatan_per_month.jumlah_keberangkatan, 0) as jumlah_keberangkatan'))
            ->get();

        // Inisialisasi nilai 0 untuk setiap bulan jika tidak ada data
        $hasil_keberangkatan_per_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $hasil_keberangkatan_per_bulan[$i] = 0;
        }

        // Memasukkan hasil query ke dalam array
        foreach ($jumlah_keberangkatan_per_bulan as $item) {
            $hasil_keberangkatan_per_bulan[$item->month] = $item->jumlah_keberangkatan;
        }

        // Selisih keberangkatan bulan ini dengan bulan kemarin
        $selisih_keberangkatan = 0;
        if (isset($jumlah_keberangkatan_per_bulan[$previousMonth - 1])) {
            $selisih_keberangkatan = $jumlah_keberangkatan_bulan_ini - $jumlah_keberangkatan_per_bulan[$previousMonth - 1]->jumlah_keberangkatan;
        }



        $jumlah_transaksi_bulan_ini = Pembayaran::whereMonth('tanggal_pembayaran', $currentMonth)
            ->whereYear('tanggal_pembayaran', $currentYear)
            ->sum('jumlah_pembayaran');
        // Ambil jumlah pemasukan bulan ini
        $jumlah_pemasukan_bulan_ini = Pembayaran::whereMonth('tanggal_pembayaran', $currentMonth)
            ->whereYear('tanggal_pembayaran', $currentYear)
            ->sum('jumlah_pembayaran');

        // Ambil jumlah pemasukan bulan sebelumnya
        $bulan_sebelumnya = ($currentMonth == 1) ? 12 : $currentMonth - 1;
        $tahun_sebelumnya = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;

        $jumlah_pemasukan_bulan_sebelumnya = Pembayaran::whereMonth('tanggal_pembayaran', $bulan_sebelumnya)
            ->whereYear('tanggal_pembayaran', $tahun_sebelumnya)
            ->sum('jumlah_pembayaran');

        // Hitung persentase kenaikan atau penurunan
        if ($jumlah_pemasukan_bulan_sebelumnya > 0) {
            $kenaikan_persentase = (($jumlah_pemasukan_bulan_ini - $jumlah_pemasukan_bulan_sebelumnya) / abs($jumlah_pemasukan_bulan_sebelumnya)) * 100;
        } else {
            // Handle jika bulan sebelumnya tidak ada pemasukan
            $kenaikan_persentase = $jumlah_pemasukan_bulan_ini >= 0 ? 100 : -100;
        }

        // Jumlah transaksi per bulan
        $jumlah_transaksi_per_bulan = DB::table(DB::raw("(SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) as months"))
            ->leftJoin(DB::raw('(SELECT MONTH(tanggal_pembayaran) as month, SUM(jumlah_pembayaran) as jumlah_transaksi FROM pembayaran WHERE YEAR(tanggal_pembayaran) = :year GROUP BY MONTH(tanggal_pembayaran)) as transaksi_per_month'), function ($join) {
                $join->on('months.month', '=', 'transaksi_per_month.month');
            })
            ->setBindings(['year' => $currentYear])
            ->select('months.month', DB::raw('COALESCE(transaksi_per_month.jumlah_transaksi, 0) as jumlah_transaksi'))
            ->get();

        return view('admin.index', [
            'title' => 'Dashboard',
            'page' => 'index',
            'jemaah_daftar_bulan_ini' => $jemaah_daftar_bulan_ini,
            'jemaah_per_bulan' => $jemaah_per_bulan,
            'persentase_peningkatan' => $persentase_peningkatan,
            'jumlah_keberangkatan_bulan_ini' => $jumlah_keberangkatan_bulan_ini,
            'jumlah_keberangkatan_per_bulan' => $jumlah_keberangkatan_per_bulan,
            'hasil_keberangkatan_per_bulan' => $hasil_keberangkatan_per_bulan,
            'selisih_keberangkatan' => $selisih_keberangkatan,
            'jumlah_transaksi_bulan_ini' => $jumlah_transaksi_bulan_ini,
            'kenaikan_persentase' => $kenaikan_persentase,
            'jumlah_transaksi_per_bulan' => $jumlah_transaksi_per_bulan,
        ]);
    }
    public function profile()
    {
        return view('admin.profile', [
            'title' => 'Profil Saya',
            'page' => 'index',
        ]);
    }
    public function profileUpdate(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number,' . $user->id, 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
        ]);

        // Assign custom attribute names:
        $validator->customAttributes = [
            'name' => 'Nama Lengkap',
            'username' => 'Nama Pengguna',
            'phone_number' => 'Nomor Ponsel',
            'photo' => 'Foto',
        ];


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Terjadi kesalahan dalam pengisian formulir.')
                ->withInput();
        }
        $user = User::find($request->id);
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        $user->name = $request->input('name');
        $user->email = strtolower($request->input('email'));
        $user->username = strtolower($request->input('username'));
        $user->phone_number = $request->input('phone_number');
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('user-photo');
            $user->photo = $path;
        }
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function passwordUpdate(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Terjadi kesalahan dalam pengisian formulir.')
                ->withInput();
        }

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()
                ->with('error', 'Password saat ini tidak cocok.')
                ->withInput();
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    public function pusat()
    {
    }
    public function cabang()
    {
    }
    public function perwakilan()
    {
    }
}
