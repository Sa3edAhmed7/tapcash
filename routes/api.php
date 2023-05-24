<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\getallchildren;
use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\PurchasesController;
use App\Http\Controllers\Api\SmartCartController;
use App\Http\Controllers\Api\getchildtransactions;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\getmytransactions;
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

Route::middleware('auth:sanctum')->get('/api/dashboard', function (Request $request) {
    return $request->user();
});








Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/refresh', [AuthController::class, 'refresh']);



});

Route::group(['middleware' => 'auth:sanctum','prefix' => 'options'], function () {

    Route::post('/children', [ChildController::class, 'store']);
    Route::get('/children', [ChildController::class, 'index']);
    Route::get('/child/{id}', [ChildController::class, 'show']);
    Route::post('/child/{id}', [ChildController::class, 'destroy']);
   

    Route::post('/getallchildren', [getallchildren::class, 'index']);

    Route::post('/getchildtransactions', [getchildtransactions::class, 'show']);

    Route::post('/getmytransactions', [getmytransactions::class, 'index']);

    


    Route::post('/transfer', [TransactionController::class, 'store']);

    Route::post('/check_smartcart', [SmartCartController::class, 'index']);
    Route::post('/create_smartcart', [SmartCartController::class, 'store']);
    Route::post('/inc_money_smartcart', [SmartCartController::class, 'inc_money']);
    Route::post('/dec_money_smartcart', [SmartCartController::class, 'dec_money']);

    Route::post('/purchases', [PurchasesController::class, 'store']);

});