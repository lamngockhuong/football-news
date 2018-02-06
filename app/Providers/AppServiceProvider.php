<?php

namespace App\Providers;

use \App\Repositories\Contracts;
use \App\Repositories\Eloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Contracts\PostRepositoryInterface::class,
            Eloquent\PostRepository::class
        );

        $this->app->bind(
            Contracts\TeamRepositoryInterface::class,
            Eloquent\TeamRepository::class
        );

        $this->app->bind(
            Contracts\PlayerRepositoryInterface::class,
            Eloquent\PlayerRepository::class
        );

        $this->app->bind(
            Contracts\MatchRepositoryInterface::class,
            Eloquent\MatchRepository::class
        );

        $this->app->bind(
            Contracts\RankRepositoryInterface::class,
            Eloquent\RankRepository::class
        );

        $this->app->bind(
            Contracts\LeagueRepositoryInterface::class,
            Eloquent\LeagueRepository::class
        );

        $this->app->bind(
            Contracts\UserRepositoryInterface::class,
            Eloquent\UserRepository::class
        );

        $this->app->bind(
            Contracts\CountryRepositoryInterface::class,
            Eloquent\CountryRepository::class
        );

        $this->app->bind(
            Contracts\PositionRepositoryInterface::class,
            Eloquent\PositionRepository::class
        );

        $this->app->bind(
            Contracts\PlayerAwardRepositoryInterface::class,
            Eloquent\PlayerAwardRepository::class
        );

        $this->app->bind(
            Contracts\TeamAchievementRepositoryInterface::class,
            Eloquent\TeamAchievementRepository::class
        );

        $this->app->bind(
            Contracts\BetRepositoryInterface::class,
            Eloquent\BetRepository::class
        );
    }
}
