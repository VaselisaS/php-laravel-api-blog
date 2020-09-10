<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => [], 'as' => 'admin.'], function () {
    Route::get('/', 'HomeController@index');
});
Auth::routes();
Route::get('/', function () {
    return view('app');
});
