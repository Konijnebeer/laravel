<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(6),
            'header_image' => 'https://picsum.photos/640/480?random=' . $this->faker->numberBetween(1, 1000),
            'rich_text' => json_encode(['content' => $this->faker->paragraphs(2)]),
            'text' => $this->faker->paragraph(4),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
