<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderLine>
 */
class OrderLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'order_id' => Order::inRandomOrder()->first()->id,
            'album_id' => Album::inRandomOrder()->first()->id,
        ];
    }
}
