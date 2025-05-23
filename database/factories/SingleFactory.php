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
        $realMp3Urls = [
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3',
        ];

        return [
            'title' => $this->faker->sentence(),
            'duration' => $this->faker->numberBetween(10, 100),
            'file' => $this->faker->randomElement($realMp3Urls),
            'album_id' => Album::inRandomOrder()->first()->id,
        ];
    }
}
