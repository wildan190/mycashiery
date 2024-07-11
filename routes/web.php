<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notifications/read/{id}', 'NotificationController@markAsRead')->name('notifications.read');
Route::get('/notifications/mark-all-read', 'NotificationController@markAllAsRead')->name('notifications.markAllRead');


Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

// Categories Routes
Route::group(['prefix' => 'categories', 'middleware' => 'auth', 'middleware' => 'role:Admin'], function() {
    Route::get('/', 'CategoryController@index')->name('categories.index');
    Route::get('/create', 'CategoryController@create')->name('categories.create');
    Route::post('/', 'CategoryController@store')->name('categories.store');
    Route::get('/{id}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::put('/{id}', 'CategoryController@update')->name('categories.update');
    Route::delete('/{id}', 'CategoryController@destroy')->name('categories.destroy');
});

// Products Routes
Route::group(['prefix' => 'products', 'middleware' => 'auth'], function() {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/create', 'ProductController@create')->name('products.create')->middleware('permission:Add Products');
    Route::post('/', 'ProductController@store')->name('products.store')->middleware('permission:Add Products');
    Route::get('/{id}/edit', 'ProductController@edit')->name('products.edit');
    Route::put('/{id}', 'ProductController@update')->name('products.update');
    Route::delete('/{id}', 'ProductController@destroy')->name('products.destroy')->middleware('permission:Delete Products');
});

// Transactions Routes
Route::group(['prefix' => 'transactions', 'middleware' => 'auth', 'middleware' => 'permission:Transaction'], function() {
    Route::get('/', 'TransactionController@index')->name('transactions.index');
    Route::get('/create', 'TransactionController@create')->name('transactions.create');
    Route::post('/', 'TransactionController@store')->name('transactions.store');
    Route::get('/{id}', 'TransactionController@show')->name('transactions.show');
    Route::get('/{id}/print', 'TransactionController@print')->name('transactions.print');
});

// Reports Routes
Route::group(['prefix' => 'reports', 'middleware' => 'auth', 'middleware' => 'permission:Report Access'], function() {
    Route::get('/monthly', 'ReportController@monthlyReport')->name('reports.monthly');
    Route::get('/products', 'ReportController@productReport')->name('reports.product');
});

// Roles Routes
Route::group(['prefix' => 'roles', 'middleware' => 'auth', 'middleware' => 'role:Admin'], function() {
    Route::get('/', 'RoleController@index')->name('roles.index');
    Route::get('/create', 'RoleController@create')->name('roles.create');
    Route::post('/', 'RoleController@store')->name('roles.store');
    Route::get('/{id}/edit', 'RoleController@edit')->name('roles.edit');
    Route::put('/{id}', 'RoleController@update')->name('roles.update');
    Route::delete('/{id}', 'RoleController@destroy')->name('roles.destroy');
});

// Permissions Routes
Route::group(['prefix' => 'permissions', 'middleware' => 'auth', 'middleware' => 'role:Admin'], function() {
    Route::get('/', 'PermissionController@index')->name('permissions.index');
    Route::get('/create', 'PermissionController@create')->name('permissions.create');
    Route::post('/', 'PermissionController@store')->name('permissions.store');
    Route::get('/{id}/edit', 'PermissionController@edit')->name('permissions.edit');
    Route::put('/{id}', 'PermissionController@update')->name('permissions.update');
    Route::delete('/{id}', 'PermissionController@destroy')->name('permissions.destroy');
});

// Users Routes
Route::group(['prefix' => 'users', 'middleware' => 'auth', 'middleware' => 'role:Admin|Leader'], function() {
    Route::get('/', 'UserController@index')->name('users.index');
    Route::get('/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::put('/{id}', 'UserController@update')->name('users.update');
    Route::delete('/{id}', 'UserController@destroy')->name('users.destroy');
});

// Log Routes
Route::group(['prefix' => 'logs', 'middleware' => 'auth', 'middleware' => 'role:Admin'], function() {
    Route::get('/', 'UserLogController@index')->name('logs.index');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
