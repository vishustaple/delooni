<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlFile = '/database/sql_data/cities (1).sql';
        \DB::unprepared(\File::get(base_path() . $sqlFile));
    }
}
