<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsJemaah
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mendapatkan pengguna saat ini
        $user = auth()->user();

        // Memeriksa apakah pengguna adalah jemaah yang diizinkan
        if ($user->pemesanans->whereHas('jemaah', function ($query) {
            $query->where('is_active', 1);
        })->count() == 0) {
            return response()->view('errors.index', [
                'title' => 'Akses ditolak',
                'message' => 'Anda dilarang mengakses halaman ini',
                'code' => '403',
            ], 403);
        }
        return $next($request);
    }
}
