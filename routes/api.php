<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChairController;
use App\Http\Controllers\ItemController;
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

//Login routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//Customer routes
Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::post('/customers/{id}/orders', [CustomerController::class, 'storeOrder']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

// Order routes
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::patch('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

//Chair routes
Route::get('/chairs', [ChairController::class, 'index']);
Route::get('/chairs/{id}', [ChairController::class, 'show']);
Route::post('/chairs', [ChairController::class, 'store']);
Route::put('/chairs/{id}', [ChairController::class, 'update']);
Route::delete('/chairs/{id}', [ChairController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('chairs', ChairController::class);
    Route::apiResource('items', ItemController::class);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
