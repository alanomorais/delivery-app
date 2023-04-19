<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClienteController;
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

Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/register', [RegisterController::class, 'register']);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('/clientes')->name('api.clientes.')->group(function () {

        Route::get('/', [ClienteController::class, 'index'])->name('index');

        Route::post('/', [ClienteController::class, 'store'])->name('store');

        Route::put('/{cliente}', [ClienteController::class, 'update'])->name('update');

        Route::delete('/{cliente}', [ClienteController::class, 'destroy'])->name('destroy');
    });
});
