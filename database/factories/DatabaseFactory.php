<?php

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Team;
use App\Models\League;
use App\Models\Rank;
use App\Models\Player;
use App\Models\Match;
use App\Models\Bet;
use App\Models\PlayerAward;
use App\Models\TeamAchievement;
use App\Models\MatchEvent;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'parent' => 0,
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'avatar' => $faker->imageUrl,
        'coin' => $faker->randomNumber,
    ];
});

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'content' => $faker->text,
        'image' => $faker->imageUrl,
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'user_id' => 1,
    ];
});

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'post_id' => function () {
            return factory(Post::class)->create()->id;
        },
        'content' => $faker->text,
    ];
});

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
    ];
});

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
        'logo' => $faker->imageUrl,
        'country_id' => function () {
            return factory(Country::class)->create()->id;
        },
    ];
});

$factory->define(Rank::class, function (Faker $faker) {
    return [
        'won' => $faker->numberBetween(0, 50),
        'drawn' => $faker->numberBetween(0, 50),
        'lost' => $faker->numberBetween(0, 50),
        'goals_for' => $faker->numberBetween(0, 50),
        'goals_against' => $faker->numberBetween(0, 50),
        'score' => $faker->numberBetween(0, 100),
        'team_id' => function () {
            return factory(Team::class)->create()->id;
        },
        'league_id' => $faker->numberBetween(1, 10),
    ];
});

$factory->define(Player::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'avatar' => $faker->imageUrl,
        'birthday' => $faker->year,
        'team_id' => function () {
            return factory(Team::class)->create()->id;
        },
        'country_id' => function () {
            return factory(Country::class)->create()->id;
        },
        'position_id' => $faker->numberBetween(1, 10),
    ];
});

$factory->define(Match::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
        'team1_id' => function () {
            return factory(Team::class)->create()->id;
        },
        'team2_id' => function () {
            return factory(Team::class)->create()->id;
        },
        'start_time' => $faker->dateTimeBetween('now'),
        'end_time' => $faker->dateTimeBetween('now'),
        'team1_goal' => $faker->numberBetween(0, 5),
        'team2_goal' => $faker->numberBetween(0, 5),
        'league_id' => $faker->numberBetween(1, 10),
    ];
});

$factory->define(Bet::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'match_id' => function () {
            return factory(Match::class)->create()->id;
        },
        'team1_goal' => $faker->numberBetween(0, 5),
        'team2_goal' => $faker->numberBetween(0, 5),
        'coin' => $faker->numberBetween(0, 10),
    ];
});

$factory->define(PlayerAward::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'player_id' => function () {
            return factory(Player::class)->create()->id;
        },
        'match_id' => function () {
            return factory(Match::class)->create()->id;
        },
    ];
});

$factory->define(TeamAchievement::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'team_id' => function () {
            return factory(Team::class)->create()->id;
        },
        'match_id' => function () {
            return factory(Match::class)->create()->id;
        },
    ];
});

$factory->define(MatchEvent::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'content' => $faker->text,
        'image' => $faker->imageUrl,
        'match_id' => function () {
            return factory(Match::class)->create()->id;
        },
        'user_id' => 1,
    ];
});