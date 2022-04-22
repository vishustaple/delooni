<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
         $this->call(PermissionRolesSeeder::class);
        $this->call(serviceCategoriesTableDataSeeder::class);
        $this->call(servicesTableDataSeeder::class);
        $this->call(importCountryDataSeeder::class);

    }
}
