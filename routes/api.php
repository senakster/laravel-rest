<?php

use App\Http\Controllers\api\v1\GroupController;
use App\Http\Controllers\api\v1\GrouplinkController;
use App\Http\Controllers\api\v1\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * http/middleware/authentication unauthorized default redirect
 */
Route::get('/unauthorized', function () {
    return response()->json(['error' => 'Unauthorized'], 401);
})->name('unauthorized');

Route::prefix('v1')->group(function () {
    Route::apiResource('groups', GroupController::class);
});

Route::prefix('v1')->group(function () {
    Route::apiResource('grouplinks', GrouplinkController::class);
});

Route::prefix('v1')->group(function () {
    Route::apiResource('projects', ProjectController::class);
});
