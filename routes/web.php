<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');


Route::group(['prefix' => 'categories', 'middleware' => 'auth'], function() {
    Route::get('/', 'CategoryController@index')->name('categories.index');
    Route::get('/create', 'CategoryController@create')->name('categories.create');
    Route::post('/', 'CategoryController@store')->name('categories.store');
    Route::get('/{id}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::put('/{id}', 'CategoryController@update')->name('categories.update');
    Route::delete('/{id}', 'CategoryController@destroy')->name('categories.destroy');
});

Route::group(['prefix' => 'products', 'middleware' => 'auth'], function() {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/create', 'ProductController@create')->name('products.create');
    Route::post('/', 'ProductController@store')->name('products.store');
    Route::get('/{id}/edit', 'ProductController@edit')->name('products.edit');
    Route::put('/{id}', 'ProductController@update')->name('products.update');
    Route::delete('/{id}', 'ProductController@destroy')->name('products.destroy');
});

Route::group(['prefix' => 'transactions', 'middleware' => 'auth'], function() {
    Route::get('/', 'TransactionController@index')->name('transactions.index');
    Route::get('/create', 'TransactionController@create')->name('transactions.create');
    Route::post('/', 'TransactionController@store')->name('transactions.store');
    Route::get('/{id}', 'TransactionController@show')->name('transactions.show');
    Route::get('/{id}/print', 'TransactionController@print')->name('transactions.print');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
