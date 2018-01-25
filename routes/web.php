<?php

Auth::routes();
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/admin', 'Admin\HomeController@index')->name('admin.home');
Route::get('/', 'Outside\HomeController@index')->name('home');
Route::get('404', 'Outside\PageNotFoundController@index')->name('404');
