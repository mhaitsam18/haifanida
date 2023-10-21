<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.index', [
                'title' => 'Halaman tidak ditemukan',
                'message' => 'Maaf, halaman yang Anda cari tidak dapat ditemukan.',
                'code' => '404',
            ], 404);
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return response()->view('errors.index', [
                'title' => 'Tidak Memiliki Wewenang',
                'message' => 'Anda tidak memiliki wewenang untuk mengakses halaman ini',
                'code' => '401',
            ], 401);
        }

        if ($exception instanceof AccessDeniedHttpException) {
            return response()->view('errors.index', [
                'title' => 'Akses Ditolak',
                'message' => 'Anda dilarang mengakses halaman ini',
                'code' => '403',
            ], 403);
        }

        // Penanganan pengecualian lainnya
        // if ($exception instanceof \Exception && !($exception instanceof \Illuminate\Validation\ValidationException)) {
        //     return response()->view('errors.index', [
        //         'title' => 'Terjadi Kesalahan',
        //         'message' => 'Terjadi kesalahan dalam sistem',
        //         'code' => '500',
        //     ], 500);
        // }


        return parent::render($request, $exception);
    }
}
