<?php

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/category','CategoryController');
Route::post('/check-category-product','CategoryController@CategoryWiseProductCheck');
Route::resource('/product','ProductController');
Route::resource('/customer','CustomerController');
Route::resource('/customer-product-service','CustomerProductServiceController');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
