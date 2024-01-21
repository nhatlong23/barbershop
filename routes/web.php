<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\v1\ServiceController;
use App\Http\Controllers\Api\v1\InformationController;
use App\Http\Controllers\Api\v1\HairdresserController;
use App\Http\Controllers\Api\v1\BranchController;
use App\Http\Controllers\Api\v1\BookingController;
use App\Http\Controllers\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [IndexController::class, 'home'])->name('homepage');

Route::prefix('v1')->group(function () {
    Route::resource('service', ServiceController::class)->only(['index', 'store', 'update', 'destroy', 'edit']);
    Route::resource('hairdresser', HairdresserController::class)->only(['index', 'store', 'update', 'destroy', 'edit']);
    Route::resource('branch', BranchController::class)->only(['index', 'store', 'update', 'destroy', 'edit']);
    Route::resource('information', informationController::class)->only(['index', 'show', 'update', 'edit']);
    Route::resource('booking', BookingController::class)->only(['index', 'store', 'edit', 'destroy']);
});

//route php info()
Route::get('/phpinfo', function () {
    return phpinfo();
});
