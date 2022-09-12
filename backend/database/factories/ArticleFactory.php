<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
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
            'published'=> 1,
            'sort' => 100,
            'slug'=> $this->faker->name,
            'user_id' => 1,
            'description' => $this->faker->text,
            'price' => 17,
            'deal_address' => $this->faker->words(2, true),
            'image' => $this->faker->image(null, 360, 360, 'animals', true)
        ];
    }
}
