<?php

use App\Models\League;
use Illuminate\Database\Seeder;

class LeaguesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('leagues')->insert(
            [
                ['name' => 'Giải bóng đá vô địch thế giới', 'year' => $faker->year],
                ['name' => 'Cúp liên đoàn các châu lục', 'year' => $faker->year],
                ['name' => 'Giải vô địch bóng đá U-20 thế giới', 'year' => $faker->year],
                ['name' => 'Giải vô địch bóng đá U-17 thế giới', 'year' => $faker->year],
                ['name' => 'Giải vô địch bóng đá nữ thế giới', 'year' => $faker->year],
                ['name' => 'Giải vô địch bóng đá nữ U-20 thế giới', 'year' => $faker->year],
                ['name' => 'Giải vô địch bóng đá nữ U-17 thế giới', 'year' => $faker->year],
                ['name' => 'Giải vô địch bóng đá trong nhà thế giới', 'year' => $faker->year],
                ['name' => 'Giải vô địch bóng đá bãi biển thế giới', 'year' => $faker->year],
                ['name' => 'Thế vận hội Mùa hè', 'year' => $faker->year],
            ]
        );
    }
}
