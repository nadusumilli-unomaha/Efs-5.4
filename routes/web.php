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

Auth::routes();

Route::resource('customers','CustomerController');
Route::resource('stocks','StockController');
Route::resource('investments','InvestmentController');
Route::get('/home', 'HomeController@index');

Route::any('.*', function () {
    return view('welcome');
});

Route::get('/customers/{any}', function ($any) {
    return view('welcome');
})->where('any', '.*');

Route::get('/{any}', function ($any) {
  return view('welcome');
})->where('any', '.*');
