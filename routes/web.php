<?php

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/category','CategoryController');
Route::post('/check-category-product','CategoryController@CategoryWiseProductCheck');
Route::resource('/product','ProductController');
Route::resource('/customer','CustomerController');
