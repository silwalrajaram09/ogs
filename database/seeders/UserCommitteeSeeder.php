<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\UserCommittee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserCommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Schema::hasTable('user_committees')) {
            return;
        }

        try {
            UserCommittee::factory()->count(10)->create();
        } catch (\Throwable $e) {
            $this->command?->warn("Skipped seeding user_committees: " . $e->getMessage());
        }
    }
}
