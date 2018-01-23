<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            CommentsTableSeeder::class,
            PositionsTableSeeder::class,
            CountriesTableSeeder::class,
            TeamsTableSeeder::class,
            LeaguesTableSeeder::class,
            RanksTableSeeder::class,
            PlayersTableSeeder::class,
            MatchesTableSeeder::class,
            BetsTableSeeder::class,
            PlayerAwardsTableSeeder::class,
            TeamAchievementsTableSeeder::class,
            MatchEventsTableSeeder::class,
        ]);
    }
}
