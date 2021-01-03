<?php

use App\Http\Controllers\Jwt\AuthController;
use Illuminate\Support\Facades\Route;


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['prefix' => 'auth','middleware'=>'jwt'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
