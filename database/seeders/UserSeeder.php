<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        try {
            User::factory()->create([
                'full_name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'type' => 'admin',
            ]);

           
        } catch (\Throwable $e) {
            $this->command?->warn("Skipped seeding users: " . $e->getMessage());
        }

    }
}
