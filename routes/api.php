<?php

use App\Http\Controllers\Api\MoneyController;
use App\Http\Controllers\Api\OrderController;
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
Route::get('total',[MoneyController::class,'total']);
Route::get('total_mounth',[MoneyController::class,'totalMounth']);
Route::get('order_by_status',[OrderController::class,'orderByStatus']);
