<?php

namespace Database\Factories;

use App\Enums\Category;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'body' => fake()->paragraphs(3, true),
            'category' => fake()->randomElement(Category::cases()),
        ];
    }

    public function configure(): static
    {
        return $this->for(User::factory(), 'author');
    }
}
