<?php

Auth::routes();

Route::get('/admin', 'Admin\HomeController@index')->name('admin.home');
Route::get('/', 'Outside\HomeController@index')->name('home');
