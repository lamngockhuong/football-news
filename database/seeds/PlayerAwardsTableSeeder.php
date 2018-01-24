<?php

use App\Models\PlayerAward;
use Illuminate\Database\Seeder;

class PlayerAwardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PlayerAward::class, 5)->create();
    }
}
