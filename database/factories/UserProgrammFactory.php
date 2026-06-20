<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserProgramm;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<UserProgramm>
 */
class UserProgrammFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = UserProgramm::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'program_id' => Program::factory(),
            'user_id' => User::factory(),
        ];
    }
    /**
     * Indicate that the model should be soft deleted.
     */
    public function trashed(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted_at' => now(),
        ]);
    }
}
