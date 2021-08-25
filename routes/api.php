<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Jwt\AuthController;
use App\Http\Controllers\Order\OrderConfirmController;
use App\Http\Controllers\Order\StatusController;
use App\Http\Controllers\PickupOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('image', [TestController::class, 'getImages']);

Route::post('auth/checktoken', [AuthController::class, 'isTokenValid']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/registration', [AuthController::class, 'registration']);

Route::group(['prefix' => 'auth','middleware'=>'jwt'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    // Profile Controller
    Route::post('profile/update',   [ProfileController::class, 'update']);
    Route::post('profile/changepassword', [ProfileController::class, 'passwordUpdate']);
    Route::post('profile/delete',   [ProfileController::class, 'delete']);

    Route::group(['prefix' => 'pickup'], function () {
        //Pickup Order Controller
        Route::get('orders',[StatusController::class,'index']);
        Route::post('order-create', [PickupOrderController::class, 'create']);
        Route::post('order-update', [PickupOrderController::class, 'update']);
        Route::post('order-cancel', [PickupOrderController::class, 'cancel']);

        //Pickup Order Status Controller
        Route::get('all-order',         [StatusController::class, 'getOrder']);
        Route::get('single-order-info/{id}', [StatusController::class, 'getSingleOrder'])->middleware(['management']);
        Route::post('status-update',    [StatusController::class, 'statusUpdate']);
        Route::post('assign-rider',     [StatusController::class, 'assignRider']);

        //Pickup Order Status Controller
        Route::post('order-deliver', [OrderConfirmController::class, 'orderDeliver']);
    });

    // Get Branch
    Route::get('branch/all-branch',  [BranchController::class, 'allBranch']);

    //Get all type of users
    Route::group(['prefix' => 'admin','middleware'=>'admin'], function () {
        Route::get('all-user',    [UserController::class, 'getAllUser']);
        Route::get('managers',    [UserController::class, 'managers']);
        Route::get('riders',      [UserController::class, 'riders']);
        Route::get('customers',   [UserController::class, 'customers']);
    });

    //Branch Controller
    Route::group(['prefix' => 'branch','middleware'=>'admin'], function () {
        Route::post('create',     [BranchController::class, 'create']);
        Route::post('update',     [BranchController::class, 'update']);
        Route::post('delete',     [BranchController::class, 'delete']);
    });



});
