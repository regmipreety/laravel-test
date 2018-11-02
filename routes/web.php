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
Route::get('/','ProductController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('profile','UserController@profile');
Route::post('profile','UserController@update_avatar');
Route::get('products/{locale}','ProductController@index')->name('products');
Route::post('products','ProductController@store');
Route::get('products/{id}/delete','ProductController@destroy')->name('products.delete');
Route::get('products/{id}/show','ProductController@show')->name('products.show');
Route::post('products/{id}/reviews','ProductController@reviews')->name('products.reviews');