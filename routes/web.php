<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentMethodController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/customer/all', [CustomerController::class, 'all']);
Route::get('/customer/delete', [CustomerController::class, 'delete'])->name('customer.delete');
Route::post('/customer/retrieve', [CustomerController::class, 'retrieve'])->name('customer.retrieve');

Route::post('/card/all', [CardController::class, 'all']);
Route::get('/card/delete', [CardController::class, 'delete'])->name('card.delete');
Route::post('/card/retrieve', [CardController::class, 'retrieve'])->name('card.retrieve');

Route::post('/charge/all', [ChargeController::class, 'all']);
Route::get('/charge/delete', [ChargeController::class, 'delete'])->name('charge.delete');
Route::post('/charge/retrieve', [ChargeController::class, 'retrieve'])->name('charge.retrieve');

Route::post('/paymentmethod/all', [PaymentMethodController::class, 'all']);
Route::get('/paymentmethod/delete', [PaymentMethodController::class, 'delete'])->name('paymentmethod.delete');
Route::post('/paymentmethod/retrieve', [PaymentMethodController::class, 'retrieve'])->name('paymentmethod.retrieve');
Route::get('/paymentmethod/getcustomer', [PaymentMethodController::class, 'getcustomer'])->name('paymentmethod.getcustomer');
Route::post('/paymentmethod/attach', [PaymentMethodController::class, 'attach'])->name('paymentmethod.attach');

Route::resources([
    '/customer' => CustomerController::class,
    '/card' => CardController::class,
    '/charge' => ChargeController::class,
    '/paymentmethod' => PaymentMethodController::class
]);
