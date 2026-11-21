@extends('layouts.app')

@section('title', 'Our Blog')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="display-5 fw-bold">Our Blog!</h1>
                    <p class="fs-5 mb-0">Enjoy reading our posts. Click on a post to read it.</p>
                </div>
                <a href="{{ route('blog.create') }}" class="btn btn-primary">Add Post</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <h2 class="h4 mb-3">Posts</h2>
            @forelse ($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="h5 card-title mb-1">
                            <a href="{{ route('blog.show', $post) }}" class="text-decoration-none">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="card-text text-muted small mb-0">
                            {{ $post->category->label() }}
                            &middot; by {{ $post->author->name }}
                            &middot; {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">No blog posts available.</div>
            @endforelse
        </div>

        <div class="col-md-4">
            <h2 class="h4 mb-3">Categories</h2>
            <ul class="list-unstyled">
                @foreach ($categories as $category)
                    <li class="mb-2">
                        <a href="{{ route('blog.category', $category) }}">{{ $category->label() }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
