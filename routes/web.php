<?php

Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('auth/{provider}', 'AuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
    Route::get('verify/{token}', 'RegisterController@verify')->name('auth.verify');
    Route::get('resend/{basecode}', 'RegisterController@resendConfirmLink')->name('auth.resend_confirm_link');
});
    
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    Route::get('', 'HomeController@index')->name('admin.home');
    Route::resource('countries', 'CountryController', ['except' => ['create', 'show']]);
    Route::resource('leagues', 'LeagueController', ['except' => ['create', 'show']]);
    Route::resource('teams', 'TeamController', ['except' => ['create', 'show']]);
    Route::resource('players', 'PlayerController', ['except' => ['create', 'show']]);
    Route::resource('users', 'UserController', ['except' => ['create', 'show']]);
    Route::resource('matches', 'MatchController', ['except' => ['create', 'show']]);
    Route::resource('ranks', 'RankController', ['except' => ['create', 'store', 'show', 'edit']]);
    Route::resource('player-awards', 'PlayerAwardController', ['except' => ['create', 'show']]);
    Route::resource('team-achievements', 'TeamAchievementController', ['except' => ['create', 'show']]);
    Route::resource('positions', 'PositionController', ['except' => ['create', 'show']]);
    Route::resource('bets', 'BetController', ['except' => ['create', 'show']]);
    Route::resource('posts', 'PostController', ['except' => ['show']]);
    Route::get('posts/trashed', 'PostController@trashed')->name('posts.trashed');
    Route::delete('posts/trash/{id}', 'PostController@trash')->name('posts.trash');
    Route::delete('posts/untrash/{id}', 'PostController@untrash')->name('posts.untrash');
    Route::put('posts/active/{id}', 'PostController@active')->name('posts.active')->where(['id' => '[0-9]+']);
    Route::resource('match-events', 'MatchEventController', ['except' => ['show']]);
    Route::get('match-events/trashed', 'MatchEventController@trashed')->name('match-events.trashed');
    Route::delete('match-events/trash/{id}', 'MatchEventController@trash')->name('match-events.trash');
    Route::delete('match-events/untrash/{id}', 'MatchEventController@untrash')->name('match-events.untrash');
    Route::put('match-events/active/{id}', 'MatchEventController@active')->name('match-events.active')->where(['id' => '[0-9]+']);
});

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('', 'Admin\HomeController@index')->name('user.home');
    Route::resource('bets', 'User\BetController',
        [
            'except' => ['create', 'show'],
            'names' => [
                'index' => 'user.bets.index',
                'store' => 'user.bets.store',
                'edit' => 'user.bets.edit',
                'update' => 'user.bets.update',
                'destroy' => 'user.bets.destroy',
            ],
        ]
    );
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
