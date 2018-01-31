<?php

Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('auth/{provider}', 'AuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
    Route::get('verify/{token}', 'RegisterController@verify')->name('auth.verify');
    Route::get('resend/{basecode}', 'RegisterController@resendConfirmLink')->name('auth.resend_confirm_link');
});

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('', 'HomeController@index')->name('admin.home');
    Route::resource('countries', 'CountryController', ['except' => ['create', 'show']]);
    Route::resource('leagues', 'LeagueController', ['except' => ['create', 'show']]);
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
    Route::get('search', 'SearchController@search')->name('search');
    Route::get('{slug}-{id}', 'PostController@show')->name('post.show')->where(['slug' => '.+', 'id' => '[0-9]+']);
});
