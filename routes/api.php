<?php

use App\Http\Controllers\Jwt\AuthController;
use App\Http\Controllers\Jwt\CheckTokenController;
use Illuminate\Support\Facades\Route;


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('auth/checktoken', [AuthController::class, 'isTokenValid']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/registration', [AuthController::class, 'registration']);

Route::group(['prefix' => 'auth','middleware'=>'jwt'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
