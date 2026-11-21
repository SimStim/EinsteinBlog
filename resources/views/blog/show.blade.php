@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <p>
        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-sm">&larr; Go back</a>
    </p>

    <article class="p-4 bg-light rounded-3">
        <p class="text-muted small mb-1">
            In category <strong>{{ $post->category->label() }}</strong>
            &middot; by {{ $post->author->name }}
            &middot; {{ $post->created_at->diffForHumans() }}
        </p>
        <h1 class="display-5">{{ $post->title }}</h1>
        <hr>
        <div style="white-space: pre-wrap;">{{ $post->body }}</div>
    </article>

    <div class="d-flex align-items-center gap-2 mt-4">
        <a href="{{ route('blog.edit', $post) }}" class="btn btn-outline-primary">Edit Post</a>
        <form method="POST" action="{{ route('blog.destroy', $post) }}"
              onsubmit="return confirm('Delete this post?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Post</button>
        </form>
    </div>
@endsection
