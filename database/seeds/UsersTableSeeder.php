<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create([
            'name' => 'Lâm Ngọc Khương',
            'email' => 'chatwithme9x@gmail.com',
        ]);
        factory(User::class, 5)->create();
    }
}
