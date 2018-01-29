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
            Contracts\TeamRepositoryInterface::class,
            Eloquent\TeamRepository::class
        );

        $this->app->bind(
            Contracts\PlayerRepositoryInterface::class,
            Eloquent\PlayerRepository::class
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
    }
}
