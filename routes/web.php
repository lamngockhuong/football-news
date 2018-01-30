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
    Route::get('match/upcoming', 'MatchController@upcoming')->name('match.upcoming');
    Route::get('match/upcoming/{slug}-{id}', 'MatchController@upcomingByLeague')->name('match.upcoming_league')->where(['slug' => '.+', 'id' => '[0-9]+']);
    Route::get('match/result/{slug}-{id}', 'MatchController@result')->name('match.result')->where(['slug' => '.+', 'id' => '[0-9]+']);
    Route::get('team/{slug}-{id}', 'TeamController@show')->name('team.show')->where(['slug' => '.+', 'id' => '[0-9]+']);
    Route::get('player/{slug}-{id}', 'PlayerController@show')->name('player.show')->where(['slug' => '.+', 'id' => '[0-9]+']);
    Route::get('ranking/{slug}-{id}', 'RankController@show')->name('rank.show')->where(['slug' => '.+', 'id' => '[0-9]+']);
    Route::get('{slug}-{id}', 'PostController@show')->name('post.show')->where(['slug' => '.+', 'id' => '[0-9]+']);
});
