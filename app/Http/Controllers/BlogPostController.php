<?php

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        return view('blog.index', [
            'posts' => BlogPost::with('author')->latest()->get(),
            'categories' => Category::cases(),
        ]);
    }

    public function category(Category $category): View
    {
        return view('blog.category', [
            'posts' => BlogPost::with('author')
                ->where('category', $category)
                ->latest()
                ->get(),
            'category' => $category,
            'categories' => Category::cases(),
        ]);
    }

    public function create(): View
    {
        return view('blog.create', [
            'categories' => Category::cases(),
        ]);
    }

    public function store(BlogPostRequest $request): RedirectResponse
    {
        $post = BlogPost::create([
            ...$request->validated(),
            'user_id' => Auth::id() ?? User::query()->firstOrFail()->id,
        ]);

        return redirect()->route('blog.show', $post)->with('status', 'Post created.');
    }

    public function show(BlogPost $blogPost): View
    {
        return view('blog.show', [
            'post' => $blogPost->load('author'),
        ]);
    }

    public function edit(BlogPost $blogPost): View
    {
        return view('blog.edit', [
            'post' => $blogPost,
            'categories' => Category::cases(),
        ]);
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost): RedirectResponse
    {
        $blogPost->update($request->validated());

        return redirect()->route('blog.show', $blogPost)->with('status', 'Post updated.');
    }

    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        $blogPost->delete();

        return redirect()->route('blog.index')->with('status', 'Post deleted.');
    }
}
