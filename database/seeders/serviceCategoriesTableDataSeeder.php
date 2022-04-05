<?php

namespace Database\Seeders;

use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class serviceCategoriesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_categories')->insert([
            [
                'name' => 'Tutoring',
                'status' => 1,
            ],
            [
                'name' => 'Maintenance Services',
                'status' => 1,
            ],
            [
                'name' => 'House Services',
                'status' => 1,
            ],
        ]);
        DB::table('service_categories')->insert([
            [
                'name' => 'House Cleaning',
                'status' => 1,
                'is_parent'=>3,
            ],
            [
                'name' => 'Cook',
                'status' => 1,
                'is_parent'=>3,
            ],
            [
                'name' => 'Pest Control',
                'status' => 1,
                'is_parent'=>3
            ]
        ]);
    }
}
