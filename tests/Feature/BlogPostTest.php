<?php

namespace Tests\Feature;

use App\Enums\Category;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_index_lists_posts_and_categories(): void
    {
        BlogPost::factory()->create(['title' => 'A Curious Post']);

        $this->get(route('blog.index'))
            ->assertOk()
            ->assertSee('A Curious Post')
            ->assertSee(Category::General->label());
    }

    public function test_show_renders_the_post_title_and_body(): void
    {
        $post = BlogPost::factory()->create([
            'title' => 'Relativity',
            'body' => 'Space and time are linked.',
        ]);

        $this->get(route('blog.show', $post))
            ->assertOk()
            ->assertSee('Relativity')
            ->assertSee('Space and time are linked.');
    }

    public function test_show_escapes_user_supplied_content(): void
    {
        $post = BlogPost::factory()->create([
            'title' => '<script>alert(1)</script>',
            'body' => '<script>alert(2)</script>',
        ]);

        $this->get(route('blog.show', $post))
            ->assertOk()
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false)
            ->assertSee('&lt;script&gt;alert(2)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(2)</script>', false);
    }

    public function test_category_route_renders_only_matching_posts(): void
    {
        BlogPost::factory()->create([
            'category' => Category::General,
            'title' => 'A General Post',
        ]);
        BlogPost::factory()->create([
            'category' => Category::Nonsense,
            'title' => 'A Nonsense Post',
        ]);

        $this->get(route('blog.category', Category::General))
            ->assertOk()
            ->assertSee('A General Post')
            ->assertDontSee('A Nonsense Post');
    }

    public function test_category_route_rejects_an_unknown_category(): void
    {
        $this->get('/cat/Unknown')->assertNotFound();
    }

    public function test_store_rejects_invalid_payload_with_user_visible_errors(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('blog.store'), [
                'title' => '',
                'body' => '',
                'category' => 'Not a category',
            ])
            ->assertSessionHasErrors([
                'title' => 'The title field is required.',
                'body' => 'The body field is required.',
                'category' => 'The selected category is invalid.',
            ]);
    }

    public function test_store_creates_a_post_for_the_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('blog.store'), [
            'title' => 'My First Post',
            'body' => 'Hello world.',
            'category' => Category::It->value,
        ]);

        $post = BlogPost::query()->firstOrFail();
        $response->assertRedirect(route('blog.show', $post));

        $this->assertModelExists($post);
        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'title' => 'My First Post',
            'body' => 'Hello world.',
            'category' => Category::It->value,
            'user_id' => $user->id,
        ]);
    }

    public function test_update_persists_the_changed_post(): void
    {
        $post = BlogPost::factory()->create();

        $this->put(route('blog.update', $post), [
            'title' => 'An Updated Title',
            'body' => 'An updated body.',
            'category' => Category::Philology->value,
        ])->assertRedirect(route('blog.show', $post));

        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'title' => 'An Updated Title',
            'body' => 'An updated body.',
            'category' => Category::Philology->value,
        ]);
    }

    public function test_destroy_removes_the_post(): void
    {
        $post = BlogPost::factory()->create();

        $this->delete(route('blog.destroy', $post))
            ->assertRedirect(route('blog.index'));

        $this->assertModelMissing($post);
    }
}
