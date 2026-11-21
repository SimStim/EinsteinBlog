@extends('layouts.app')

@section('title', 'Posts in '.$category->label())

@section('content')
    <p>
        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-sm">&larr; Go back</a>
    </p>

    <div class="p-4 mb-4 bg-light rounded-3">
        <h1 class="display-6 mb-0">Posts in {{ $category->label() }}</h1>
    </div>

    @forelse ($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="h5 card-title mb-1">
                    <a href="{{ route('blog.show', $post) }}" class="text-decoration-none">
                        {{ $post->title }}
                    </a>
                </h2>
                <p class="card-text text-muted small mb-0">
                    by {{ $post->author->name }} &middot; {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">No blog posts available in this category.</div>
    @endforelse
@endsection
