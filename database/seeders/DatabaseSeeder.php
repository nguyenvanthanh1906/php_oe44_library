<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->call([
                AuthorSeeder::class,
            ]);
            $this->call([
                BookSeeder::class,
            ]);
        });
    }
}
