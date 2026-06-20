<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Committee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Committee>
 */
class CommitteeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Committee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'updated_by' => null,
            'user_id' => User::factory(),
            'parent_id' => null,
        ];
    }
}
