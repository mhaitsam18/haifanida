<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAdminKantor;
use App\Http\Middleware\IsAgen;
use App\Http\Middleware\IsAuthor;
use App\Http\Middleware\IsCabang;
use App\Http\Middleware\IsJemaah;
use App\Http\Middleware\IsMember;
use App\Http\Middleware\IsPerwakilan;
use App\Http\Middleware\IsPusat;
use App\Http\Middleware\IsSuperAdmin;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\ValidateSignature;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            TrustProxies::class,
            HandleCors::class,
            PreventRequestsDuringMaintenance::class,
            ValidatePostSize::class,
            TrimStrings::class,
            ConvertEmptyStringsToNull::class,
        ]);

        $middleware->group('web', [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ]);

        $middleware->group('api', [
            ThrottleRequests::class.':api',
            SubstituteBindings::class,
        ]);

        $middleware->alias([
            'auth' => Authenticate::class,
            'admin' => IsAdmin::class,
            'superadmin' => IsSuperAdmin::class,
            'adminkantor' => IsAdminKantor::class,
            'author' => IsAuthor::class,
            'member' => IsMember::class,
            'jemaah' => IsJemaah::class,
            'pusat' => IsPusat::class,
            'perwakilan' => IsPerwakilan::class,
            'cabang' => IsCabang::class,
            'agen' => IsAgen::class,
            'auth.basic' => AuthenticateWithBasicAuth::class,
            'cache.headers' => SetCacheHeaders::class,
            'can' => Authorize::class,
            'guest' => RedirectIfAuthenticated::class,
            'password.confirm' => RequirePassword::class,
            'signed' => ValidateSignature::class,
            'throttle' => ThrottleRequests::class,
            'verified' => EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontFlash([
            'current_password',
            'password',
            'password_confirmation',
        ]);

        $exceptions->render(function (HttpException $e, $request) {
            if ($e instanceof ValidationException) {
                return null;
            }

            $statusCode = $e->getStatusCode();

            if ($statusCode == 401) {
                return response()->view('errors.index', [
                    'title' => 'Tidak Memiliki Wewenang',
                    'message' => 'Anda tidak memiliki wewenang untuk mengakses halaman ini',
                    'code' => '401',
                ], 401);
            } elseif ($statusCode == 403) {
                return response()->view('errors.index', [
                    'title' => 'Akses Ditolak',
                    'message' => 'Anda dilarang mengakses halaman ini',
                    'code' => '403',
                ], 403);
            } elseif ($statusCode == 404) {
                return response()->view('errors.index', [
                    'title' => 'Halaman tidak ditemukan',
                    'message' => 'Maaf, halaman yang Anda cari tidak dapat ditemukan.',
                    'code' => '404',
                ], 404);
            } else {
                $translatedMessage = trans("http.$statusCode");

                if ($translatedMessage !== "http.$statusCode") {
                    return response()->view('errors.index', [
                        'title' => 'Terjadi Kesalahan',
                        'message' => $translatedMessage,
                        'code' => "$statusCode",
                    ], $statusCode);
                }

                return response()->view('errors.index', [
                    'title' => 'Terjadi Kesalahan',
                    'message' => $e->getMessage(),
                    'code' => "$statusCode",
                ], $statusCode);
            }
        });
    })->create();
