<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'content' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(300, 300),
            'user_id' => mt_rand(1,2),
            'category_id' => mt_rand(1,3),
        ];
    }
}
