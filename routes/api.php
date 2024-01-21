<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ServiceController;
use App\Http\Controllers\Api\v1\HairdresserController;
use App\Http\Controllers\Api\v1\InformationController;
use App\Http\Controllers\Api\v1\BranchController;
use App\Http\Controllers\Api\v1\BookingController;
use App\Http\Controllers\HomeController;
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


Route::prefix('v1')->group(function () {
    Route::apiResource('service', ServiceController::class);
    Route::apiResource('hairdresser', HairdresserController::class);
    Route::apiResource('branch', BranchController::class);
    Route::apiResource('information', informationController::class);
    Route::apiResource('booking', BookingController::class);
});
