<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'artist' => fake()->name(),
            'description' => fake()->paragraph(),
            'stocks' => fake()->numberBetween(0, 100),
            'price' => fake()->randomFloat(2, 0, 100),
            'release_date' => fake()->dateTimeThisYear(),
            'cover' => fake()->imageUrl(200, 200),
            'category_id' => fake()->randomElement(Category::all()->pluck('id')->toArray()),
        ];
    }
}
