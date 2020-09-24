<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['can:admin-panel'], 'as' => 'admin.'], function () {
    Route::get('/', 'HomeController@index')->name('home');
});
Auth::routes();
Route::get('/', function () {
    return view('app');
});
