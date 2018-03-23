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

Route::get('/business/contract/list', 'Business\ContractController@index');
Route::get('/business/contract/auto_insert_example', 'Business\ContractController@process_auto_insert_example');

Route::post('/business/contract/ajax_change_payment_state', 'Business\ContractController@ajax_change_payment_state');
Route::post('/business/order_detail/ajax_change_quantity_order_detail', 'Business\OrderDetailController@ajax_change_quantity_order_detail');
Route::post('/business/order_detail/ajax_add_order_detail', 'Business\OrderDetailController@ajax_add_order_detail');
