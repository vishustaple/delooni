<?php

namespace Database\Seeders;


use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'richestsoft',
            'first_name' => 'admin',
            'last_name'=>'richestsoft',
            'email' => 'admin@richestsoft.com',
            'phone'=>'1800001291',
            'remember_token' => Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 0
        ]);
    }
}
