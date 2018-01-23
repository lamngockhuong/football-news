<?php

use App\Models\TeamAchievement;
use Illuminate\Database\Seeder;

class TeamAchievementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TeamAchievement::class, 5)->create();
    }
}
