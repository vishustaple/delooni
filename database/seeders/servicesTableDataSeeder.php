<?php

namespace Database\Seeders;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class servicesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => 'Academics',
                'status' => 1,
                'service_category_id' => 1,
            ],
            [
                'name' => 'Science',
                'status' => 1,
                'service_category_id' => 1,
            ],
            [
                'name' => 'English',
                'status' => 1,
                'service_category_id' => 1,
            ],
            [
                'name' => 'Plumber',
                'status' => 1,
                'service_category_id' => 2,
            ],
            [
                'name' => 'Elecrical',
                'status' => 1,
                'service_category_id' => 2,
            ],
        ]);
    }
}
