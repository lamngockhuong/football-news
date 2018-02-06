<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\Bet;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Country;
use App\Models\League;
use App\Models\MatchEvent;
use App\Models\Match;
use App\Models\PlayerAward;
use App\Models\Player;
use App\Models\Position;
use App\Models\Post;
use App\Models\User;
use App\Models\Rank;
use App\Models\TeamAchievement;
use App\Policies\TeamPolicy;
use App\Policies\BetPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use App\Policies\CountryPolicy;
use App\Policies\LeaguePolicy;
use App\Policies\MatchPolicy;
use App\Policies\MatchEventPolicy;
use App\Policies\PlayerAwardPolicy;
use App\Policies\PlayerPolicy;
use App\Policies\PositionPolicy;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Policies\RankPolicy;
use App\Policies\TeamAchievementPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Bet::class => BetPolicy::class,
        Category::class => CategoryPolicy::class,
        Comment::class => CommentPolicy::class,
        Country::class => CountryPolicy::class,
        League::class => LeaguePolicy::class,
        MatchEvent::class => MatchEventPolicy::class,
        Match::class => MatchPolicy::class,
        PlayerAward::class => PlayerAwardPolicy::class,
        Player::class => PlayerPolicy::class,
        Position::class => PositionPolicy::class,
        Post::class => PostPolicy::class,
        Rank::class => RankPolicy::class,
        TeamAchievement::class => TeamAchievementPostPolicy::class,
        User::class => UserPolicy::class,
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
