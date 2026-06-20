<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\UserProgramm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserProgrammSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Schema::hasTable('user_programms')) {
            return;
        }

        try {
            UserProgramm::factory()->count(10)->create();
        } catch (\Throwable $e) {
            $this->command?->warn("Skipped seeding user_programms: " . $e->getMessage());
        }
    }
}
