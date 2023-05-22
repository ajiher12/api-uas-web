<?php

// Import Controllers

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth

use App\Http\Controllers\Api\V1\ItemController;
use App\Http\Controllers\Api\Auth\LoginController;
// 
use App\Http\Controllers\Api\V1\ModelNoController;

use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\V1\TransactionController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;

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





Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
   
  
    Route::apiResource('/items', ItemController::class);

    Route::apiResource('/model-no', ModelNoController::class);

    Route::apiResource('/transaction', TransactionController::class);
});




Route::prefix('auth')->group(function () {
    // 'middleware' => ''
    Route::post('/login', LoginController::class)->middleware('throttle:3,1');
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::post('/register', RegisterController::class);
    Route::post('/forget-password', [ForgotPasswordController::class, 'forgetPassword']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
