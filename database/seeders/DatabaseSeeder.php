<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CountrySeeder::class,
            PostSeeder::class,
            PageSeeder::class,
            ProgramSeeder::class,
            CommitteeSeeder::class,
            UserProgrammSeeder::class,
            UserCommitteeSeeder::class,
        ]);
    }
}
