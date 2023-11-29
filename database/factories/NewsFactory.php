<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class NewsFactory extends Factory
{
    const PATH = 'uploaded/news/';
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'image' => UploadedFile::fake()->image('news.jpg')->move(public_path(self::PATH), time() . '_news.jpg')->getFilename(),
            'date' => $this->faker->date,
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph
        ];
    }
}
