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
        factory(App\Models\City::class, 30)->create();
        factory(App\Models\Location::class, 300)->create();
        factory(App\Models\City::class, 10)->create();
        factory(App\Models\Tour::class, 100)->create();
    }
}
