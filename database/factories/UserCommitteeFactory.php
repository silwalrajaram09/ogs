<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserCommittee;
use App\Models\User;
use App\Models\Committee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<UserCommittee>
 */
class UserCommitteeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = UserCommittee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_no' => fake()->randomFloat(2, 0, 999999),
            'updated_by' => null,
            'committee_id' => Committee::factory(),
        ];
    }
}
