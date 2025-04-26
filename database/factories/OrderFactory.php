<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->boolean(),
            'order_date' => $this->faker->date(),
            'total_cost' => $this->faker->numberBetween(100, 10000),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
