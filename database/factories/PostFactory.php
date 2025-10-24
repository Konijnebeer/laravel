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
        $catImageUrls = [
            'https://cataas.com/cat?width=400&height=1200',
            'https://cataas.com/cat/cute?width=400&height=1200',
            'https://cataas.com/cat?width=400&height=1200&filter=mono',
            'https://cataas.com/cat/cute,funny?width=400&height=1200',
            'https://cataas.com/cat/kitten?width=400&height=1200',
        ];

        return [
            'name' => $this->faker->sentence(6),
            'header_image' => $this->faker->randomElement($catImageUrls),
            'rich_text' => json_encode(['content' => $this->faker->paragraphs(2)]),
            'text' => $this->faker->paragraph(4),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
