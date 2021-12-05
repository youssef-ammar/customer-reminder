<?php

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
Route::post('authentification/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('client', [App\Http\Controllers\CustomerController::class, 'storeClients']);
Route::post('createUser', [App\Http\Controllers\UserController::class, 'addUser']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('clients',[App\Http\Controllers\CustomerController::class, 'getClientWithLastStatus']);
});
