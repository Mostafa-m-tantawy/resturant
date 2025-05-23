<?php

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
         $this->call(permissionSeeder::class);
         $this->call(CountriesSeeder::class);
         $this->call(StatesSeeder::class);
         $this->call(categoriesSeeder::class);

    }
}
