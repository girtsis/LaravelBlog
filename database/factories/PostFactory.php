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
    public function definition()
    {
        $created = fake()->dateTimeBetween();
        $updated = fake()->dateTimeBetween($created);
        if(rand(0,9)){
            $updated = $created;
        }
        return [
            'title' => fake()->sentence,
            'body' => fake()->paragraphs(10, true),
            'created_at' => $created,
            'updated_at' => $updated
        ];
    }
}
