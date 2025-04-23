<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role_id != 3) {
            // abort(403);
            return response()->view('errors.index', [
                'title' => 'Akses ditolak',
                'message' => 'Anda dilarang mengakses halaman ini',
                'code' => '403',
            ], 403);
        }
        return $next($request);
    }
}
