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

// Dashboard
Route::get('/home', 'HomeController@index')->name('home');

// Customers
Route::get('/customer', 'CustomerController@index')->name('customer');
Route::get('/customer/{id}', 'CustomerController@detail')->where('id', '[0-9]+');

// Inventories
Route::get('/inventory', 'InventoryController@index')->name('inventory');
Route::get('/inventory/{id}', 'InventoryController@detail')->where('id', '[0-9]+');

// Activities (Orders)
Route::get('/order', 'OrderController@index')->name('order');
Route::get('/order/{id}', 'OrderController@detail')->where('id', '[0-9]+');

// Menus
Route::get('/menu', 'MenuController@index')->name('menu');
Route::get('/menu/{id}', 'MenuController@detail')->where('id', '[0-9]+');

// POS
Route::get('/pos', 'POSController@index')->name('pos');