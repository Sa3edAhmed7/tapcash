<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmartCartController;
use App\Http\Controllers\SmartWalletController;
use App\Http\Controllers\purchasesController;
use App\Http\Controllers\HistoryTransactionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('money_transaction', HistoryTransactionsController::class);
    Route::resource('child', ChildController::class);
    Route::resource('smartcart', SmartCartController::class);
    Route::resource('smartwallet', SmartWalletController::class);
    Route::resource('purchases', purchasesController::class);
    

});

require __DIR__.'/auth.php';
