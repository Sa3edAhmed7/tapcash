<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\PurchasesController;
use App\Http\Controllers\Api\SmartCartController;
use App\Http\Controllers\Api\TransactionController;

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

Route::middleware('auth:api')->get('/api/dashboard', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api','prefix' => 'auth'],function () {

    Route::post('/login', [AuthController::class,'login']);
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/logout', [AuthController::class,'logout']);
    Route::post('/refresh', [AuthController::class,'refresh']);
    

    Route::post('/children',[ChildController::class,'store']);
    Route::get('/children',[ChildController::class,'index']);
    Route::get('/child/{id}',[ChildController::class,'show']);
 
    Route::post('/child/{id}',[ChildController::class,'destroy']);


    Route::post('/transfer',[TransactionController::class,'store']);

    Route::post('/create_smartcart',[SmartCartController::class,'store']);

    Route::post('/purchases',[PurchasesController::class,'store']);

});



