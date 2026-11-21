<?php

namespace Database\Seeders;

use App\Enums\Category;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $author = User::factory()->create([
            'name' => 'Albert Einstein',
            'email' => 'albert@example.com',
        ]);

        foreach (Category::cases() as $category) {
            BlogPost::factory()
                ->count(3)
                ->for($author, 'author')
                ->create(['category' => $category]);
        }
    }
}
