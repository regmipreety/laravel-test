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

Route::get('/products', function () {
    return redirect('products/'.app()->getLocale());
});

Auth::routes();
Route::get('/','ProductController@product');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('profile','UserController@profile');
Route::post('profile','UserController@update_avatar');
Route::get('products/{locale}','ProductController@index')->name('products');
Route::post('products','ProductController@store');
Route::get('products/{id}/delete','ProductController@destroy')->name('products.delete');
Route::get('products/{id}/edit','ProductController@edit')->name('products.edit');
Route::post('products/{id}/update','ProductController@update')->name('products.update');


Route::get('products/{id}/show','ProductController@show')->name('products.show');
Route::post('products/{id}/reviews','ProductController@reviews')->name('products.reviews');
Route::get('/products/addTocart/{id}','ProductController@addTocart');
Route::get('/redirect', 'Auth\LoginController@redirect');
Route::get('/callback', 'Auth\LoginController@callback');

Route::get('/home', 'HomeController@index')->name('home');
