<?php

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


Auth::routes(['register' => false]);;

Route::get('/', 'ManagementsController@index')->name('home');
Route::get('/home', 'ManagementsController@index')->name('home');
Route::get('/show/{id?}', 'ManagementsController@show')->name('user.show');
Route::get('/create/emplyee', 'ManagementsController@createEmployee')->name('emplyee.create');
Route::get('/create/customer', 'ManagementsController@createCustomer')->name('customer.create');
Route::post('/user/store', 'ManagementsController@storeUser')->name('user.store');
Route::post('/customer/update', 'ManagementsController@updateCustomer')->name('customer.update');

