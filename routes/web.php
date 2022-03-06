<?php

use App\Http\Controllers\Api\FranqueadoController;
use App\Http\Controllers\Api\MoneyController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Controllers\Api\PaymentFranchiseeController;
use App\Http\Controllers\Api\SaleController as ApiSaleController;
use App\Http\Controllers\Dashboard\DashBoardController;
use App\Http\Controllers\Dashboard\SaleController as DashboardSaleController;
use App\Http\Controllers\Tray\AffiliateController;
use App\Http\Controllers\Tray\CustomerController;
use App\Http\Controllers\Tray\NotificationController;
use App\Http\Controllers\Tray\OrderController;
use App\Http\Controllers\Tray\PaymentController;
use App\Http\Controllers\Tray\ProductController;
use App\Http\Controllers\Tray\SaleController;
use App\Http\Controllers\Tray\TrayTokenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/request/read', [NotificationController::class, 'read']);
Route::post('/request', [NotificationController::class, 'save']);

Route::prefix('api')->group(function () {
    Route::get('total/payments',[ApiSaleController::class,'getOrdersByUserTotalSale']);
    Route::get('total/medium_ticket',[ApiSaleController::class,'getMediumTicket']);
    Route::get('all_sales',[ApiSaleController::class,'getOrdersByUserId']);

    Route::get('payments',[PaymentController::class,'getByDatabase']);
    Route::get('franqueados', [FranqueadoController::class, 'getIdAndMail']);
    Route::get('total', [MoneyController::class, 'total']);
    Route::get('total_mounth', [MoneyController::class, 'totalMounth']);
    Route::get('total_by_interval', [MoneyController::class, 'totalByInterval']);
    Route::get('total_by_payment_interval', [MoneyController::class, 'totalByPaymentInterval']);
    Route::get('order_by_status', [ApiOrderController::class, 'orderByStatus']);
    Route::get('/mapsales/{order_id?}', [ApiOrderController::class, 'mapsales']);


    //Total
    Route::get('sales/total/payment',[ApiSaleController::class,'salesByPaymentForm']);
    Route::get('sales/total/status',[ApiSaleController::class,'salesByStatus']);
    Route::get('sales/total/clients',[ApiSaleController::class,'salesByTotalClients']);
    Route::get('sales/total/sales',[ApiSaleController::class,'salesByTotal']);
});

Route::prefix('tray')->group(function () {

    /** Token tray */
    Route::get('/token-api', [TrayTokenController::class, 'get']);
    Route::get('/token-api-update', [TrayTokenController::class, 'updateToken'])->name('tray.token.update');

    /** Products */
    Route::get('/products/{product_id?}', [ProductController::class, 'get']);

    /** Orders */
    Route::get('/orders/create', [OrderController::class, 'create']);
    Route::get('/orders/modified', [OrderController::class, 'getModifiedByDateNow']);
    Route::get('/orders/show', [OrderController::class, 'show']);
    Route::get('/orders/{order_id?}', [OrderController::class, 'get']);

    /** Sales */
    Route::get('/sales/{sold_id?}', [SaleController::class, 'get']);

    /** Customer */
    Route::get('/customers/{customer_id?}', [CustomerController::class, 'get']);

    /** Payment */
    Route::get('/payments/{payments_id?}', [PaymentController::class, 'get']);

    /** Profile */
    Route::prefix('/me')->group(function () {
        Route::get('/dashboard', [DashBoardController::class, 'index']);
    });

    /** Customers */
    Route::get('/get-customer', [CustomerController::class, 'getCustomer']);

    /** Affiliate */
    Route::get('/affiliates/show/{id}', [AffiliateController::class, 'show']);
    Route::get('/affiliates/get', [AffiliateController::class, 'get']);

});

Route::group(['prefix' => 'admin'], function () {

    /** Page view Sale */
    Route::get('/sales', [DashboardSaleController::class, 'get']);
    Route::get('/show', [DashboardSaleController::class, 'show']);
    Route::get('/mapsales', [DashboardSaleController::class, 'mapsales']);
    Route::get('/payment_franchisee', [PaymentFranchiseeController::class, 'get']);

    /** Dashboard */
    Route::get('/dashboard', [DashBoardController::class, 'index']);

    Voyager::routes();
});
