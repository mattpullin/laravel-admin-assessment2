<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;

/**
 * @extends Factory<Post>
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
    return [
        'title'       => fake()->sentence(4),
        'content'     => fake()->paragraph(3),
        'is_active'   => fake()->randomElement(['Yes', 'No']),
        'user_id'     => User::inRandomOrder()->value('id') ?? User::factory(),
        'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),
    ];
}
    
}
