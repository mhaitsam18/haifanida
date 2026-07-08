<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMenuPermission
{
    /**
     * Menegakkan can_view/can_edit/can_delete dari tabel menu_roles untuk
     * request yang cocok dengan salah satu url Menu.
     *
     * Menu yang belum dikonfigurasi sama sekali di menu_roles (untuk role
     * pengguna saat ini) dibiarkan lolos (fail-open) — supaya tidak
     * mengunci semua admin dari menu yang belum pernah diatur izinnya.
     * Begitu ada baris menu_roles yang eksplisit dibuat untuk kombinasi
     * menu+role tersebut, barulah izin itu benar-benar ditegakkan.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $menu = $this->resolveMenu($request->path());

        if (!$menu) {
            return $next($request);
        }

        $roleIds = array_filter([
            auth()->user()->role_id,
            auth()->user()->admin?->is_superadmin ? Role::idFor('superadmin') : null,
            auth()->user()->admin?->kantor_id ? Role::idFor('adminkantor') : null,
        ]);

        $configured = $menu->menuRoles()->whereIn('role_id', $roleIds)->get();

        if ($configured->isEmpty()) {
            return $next($request);
        }

        $permissionColumn = match ($request->method()) {
            'DELETE' => 'can_delete',
            'POST', 'PUT', 'PATCH' => 'can_edit',
            default => 'can_view',
        };

        if ($configured->contains(fn ($row) => $row->{$permissionColumn})) {
            return $next($request);
        }

        return response()->view('errors.index', [
            'title' => 'Akses ditolak',
            'message' => 'Anda tidak memiliki izin untuk melakukan aksi ini.',
            'code' => '403',
        ], 403);
    }

    private function resolveMenu(string $path): ?Menu
    {
        $menus = Menu::whereNotNull('url')
            ->where('url', '!=', '')
            ->where('url', '!=', '#')
            ->get(['id', 'url']);

        $best = null;
        foreach ($menus as $menu) {
            $menuPath = ltrim($menu->url, '/');
            if ($menuPath !== '' && ($path === $menuPath || str_starts_with($path, $menuPath . '/'))) {
                if (!$best || strlen($menuPath) > strlen(ltrim($best->url, '/'))) {
                    $best = $menu;
                }
            }
        }

        return $best;
    }
}
