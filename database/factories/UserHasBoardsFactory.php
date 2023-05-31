<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserHasBoards>
 */
class UserHasBoardsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement(User::all()->pluck('id')),
            'board_id' => fake()->randomElement(Board::all()->pluck('id'))
        ];
    }
}
