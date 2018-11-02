<?php

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

Route::match(['get', 'post'], '/order/{id}/payment', 'PayForOrder')->name('order.payment');

Route::get('/order/{id}/confirmation', 'OrderConfirmation')->name('order.confirmation');

Route::get('/invoice/{id}', function ($id) {
    $order = \App\Order::find($id);

    return new \App\Mail\OrderInvoice($order);
});
