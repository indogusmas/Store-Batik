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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/barang/{id}', 'BarangController@index');
Route::post('/pesanan/store','PesanController@store');
Route::post('/pesanan/delete','PesanController@delete');
Route::get('/check-out', 'PesanController@checkout');

