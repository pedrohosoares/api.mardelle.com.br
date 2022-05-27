<?php

use App\Http\Controllers\Api\MoneyController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Tray\NotificationController;
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

Route::post('/request', [NotificationController::class, 'save']);
