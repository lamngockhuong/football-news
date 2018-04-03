<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert(
            [
                ['name' => 'Thủ môn'],
                ['name' => 'Trung vệ'],
                ['name' => 'Hậu vệ quét'],
                ['name' => 'Hậu vệ tư do'],
                ['name' => 'Hậu vệ cánh'],
                ['name' => 'Tiền vệ phòng ngự'],
                ['name' => 'Tiền vệ trung tâm'],
                ['name' => 'Tiền vệ chạy cánh'],
                ['name' => 'Tiền vệ tấn công'],
                ['name' => 'Tiền đạo'],
            ]
        );
    }
}
