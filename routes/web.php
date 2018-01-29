<?php

Auth::routes();
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('', 'HomeController@index')->name('admin.home');
});

Route::namespace('Outside')->prefix('')->group(function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('404', 'PageNotFoundController@index')->name('404');
    Route::get('team/{slug}-{id}', 'TeamController@show')->name('team.show')->where(['slug' => '.+', 'id' => '[0-9]+']);
    Route::get('{slug}-{id}', 'PostController@show')->name('post.show')->where(['slug' => '.+', 'id' => '[0-9]+']);
});
