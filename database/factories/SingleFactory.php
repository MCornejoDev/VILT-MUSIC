<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Single>
 */
class SingleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'duration' => $this->faker->numberBetween(10, 100),
            'file' => $this->faker->url(),
            'album_id' => Album::inRandomOrder()->first()->id,
        ];
    }
}
