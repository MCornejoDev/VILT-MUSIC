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
            'title' => $this->faker->sentence(),
            'artist' => $this->faker->name(),
            'description' => $this->faker->paragraph(1),
            'stocks' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'release_date' => $this->faker->dateTimeThisYear(),
            'cover' => "https://picsum.photos/300/200?random={$this->faker->unique()->randomNumber}",
            'category_id' => $this->faker->randomElement(Category::all()->pluck('id')->toArray()),
        ];
    }
}
