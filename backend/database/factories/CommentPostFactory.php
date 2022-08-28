<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_id' => $this->faker->numberBetween(1,80),
            'post_id'=> $this->faker->numberBetween(1, 50)
        ];
    }
}
