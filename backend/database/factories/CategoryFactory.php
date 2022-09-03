<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'h1' => $this->faker->name,
            'published'=> 1,
            'sort' => 100,
            'parent_id' => 0,
            'slug'=> $this->faker->name
        ];
    }
}
