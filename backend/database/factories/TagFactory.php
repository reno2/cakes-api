<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(2, true),
            'slug' => $this->faker->words(2, true),
            'description' =>$this->faker->text,
            'image' => $this->faker->imageUrl,
            'sort' => 500,
            'published' => 1
        ];
    }
}
