<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Country;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Program>
 */
class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 year', 'now');
        $endDate = fake()->dateTimeBetween($startDate, '+1 year');

        return [
            'name' => fake()->sentence(3),
            'type' => fake()->randomElement(['travel', 'anniversary']),
            'description' => fake()->paragraph(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'no_of_days' => (int) $startDate->diff($endDate)->days + 1,
            'location' => fake()->city(),
            'country_id' => Country::query()->inRandomOrder()->value('id') ?? Country::factory(),
            'parent_id' => null,
        ];
    }
}
