<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', fn (User $user) => $user->isAdmin());
        Gate::define('superadmin', fn (User $user) => $user->isSuperAdmin());
        Gate::define('adminkantor', fn (User $user) => $user->isAdminKantor());
        Gate::define('author', fn (User $user) => $user->isAuthor());
        Gate::define('member', fn (User $user) => $user->isMember());
        Gate::define('jemaah', fn (User $user) => $user->isJemaah());
        Gate::define('pusat', fn (User $user) => $user->isPusat());
        Gate::define('perwakilan', fn (User $user) => $user->isPerwakilan());
        Gate::define('cabang', fn (User $user) => $user->isCabang());
        Gate::define('agen', fn (User $user) => $user->isAgen());
    }
}
