<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => rtrim($this->faker->sentence(6), '.'),
            'body'  => $this->faker->paragraphs(4, true),
            'image' => null,
        ];
    }
}