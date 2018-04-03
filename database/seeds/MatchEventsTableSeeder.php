<?php

use App\Models\MatchEvent;
use Illuminate\Database\Seeder;

class MatchEventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MatchEvent::class, 5)->create();
    }
}
