<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Board;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity' => fake()->word(),
            'description' => fake()->sentence(),
            'state' => fake()->randomElement(['TODO', 'WORKING', 'REVIEW', 'DONE']),
            'color' => fake()->randomElement(['yellow', 'orange', 'pink', 'purple', 'blue']),
            'board_id' => fake()->randomElement(Board::all()->pluck('id')),
        ];
    }
}
