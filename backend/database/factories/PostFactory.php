<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
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
            'category_id' => $this->faker->numberBetween(1, 5),
            'description' =>$this->faker->text,
            'image' => $this->faker->imageUrl

        ];
    }
}
