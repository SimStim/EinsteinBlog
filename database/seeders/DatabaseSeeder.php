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

        foreach ($this->quotes() as $quote) {
            BlogPost::factory()
                ->for($author, 'author')
                ->create($quote);
        }
    }

    /**
     * @return array<int, array{title: string, body: string, category: Category}>
     */
    private function quotes(): array
    {
        return [
            [
                'title' => 'A Comprehensible Universe',
                'body' => 'The most incomprehensible thing about the universe is that it is comprehensible.',
                'category' => Category::It,
            ],
            [
                'title' => 'God Does Not Play Dice',
                'body' => 'God does not play dice with the universe.',
                'category' => Category::It,
            ],
            [
                'title' => 'Keep Your Balance',
                'body' => 'Life is like riding a bicycle. To keep your balance, you must keep moving.',
                'category' => Category::It,
            ],
            [
                'title' => 'Imagination Over Knowledge',
                'body' => 'Imagination is more important than knowledge. For knowledge is limited, whereas imagination embraces the entire world.',
                'category' => Category::Philology,
            ],
            [
                'title' => 'Never Stop Questioning',
                'body' => 'The important thing is not to stop questioning. Curiosity has its own reason for existing.',
                'category' => Category::Philology,
            ],
            [
                'title' => 'Passionately Curious',
                'body' => 'I have no special talent. I am only passionately curious.',
                'category' => Category::Philology,
            ],
            [
                'title' => 'Value, Not Success',
                'body' => 'Try not to become a person of success, but rather try to become a person of value.',
                'category' => Category::General,
            ],
            [
                'title' => 'Learning From Mistakes',
                'body' => 'Anyone who has never made a mistake has never tried anything new.',
                'category' => Category::General,
            ],
            [
                'title' => 'Look Deep Into Nature',
                'body' => 'Look deep into nature, and then you will understand everything better.',
                'category' => Category::General,
            ],
            [
                'title' => 'The Future Comes Soon Enough',
                'body' => 'I never think of the future. It comes soon enough.',
                'category' => Category::Nonsense,
            ],
            [
                'title' => 'Education Interferes',
                'body' => 'The only thing that interferes with my learning is my education.',
                'category' => Category::Nonsense,
            ],
            [
                'title' => 'The Measles of Mankind',
                'body' => 'Nationalism is an infantile disease. It is the measles of mankind.',
                'category' => Category::Nonsense,
            ],
        ];
    }
}
