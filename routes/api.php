<?php

use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\KantorController;
use App\Http\Controllers\Api\V1\KontenController;
use App\Http\Controllers\Api\V1\PaketController;
use App\Http\Controllers\Api\V1\TestimoniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Read-only, public marketing data consumed by the Next.js experience site.
Route::prefix('v1')->group(function () {
    Route::get('/packages', [PaketController::class, 'index']);
    Route::get('/packages/{paket}', [PaketController::class, 'show']);
    Route::get('/hotels', [HotelController::class, 'index']);
    Route::get('/testimonials', [TestimoniController::class, 'index']);
    Route::get('/content', [KontenController::class, 'index']);
    Route::get('/offices', [KantorController::class, 'index']);
});
