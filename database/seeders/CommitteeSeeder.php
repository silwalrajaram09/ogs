<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Committee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Schema::hasTable('committee')) {
            return;
        }

        try {
            Committee::factory()->count(10)->create();
        } catch (\Throwable $e) {
            $this->command?->warn("Skipped seeding committee: " . $e->getMessage());
        }
    }
}
