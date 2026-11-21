@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')
    <p>
        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-sm">&larr; Go back</a>
    </p>

    <div class="card">
        <div class="card-body">
            <h1 class="h2">Create a New Post</h1>
            <p class="text-muted">Fill and submit this form to create a post.</p>
            <hr>

            @include('partials.errors')

            <form action="{{ route('blog.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" id="title" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}"
                           placeholder="Enter post title" required maxlength="255">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">Post Body</label>
                    <textarea id="body" name="body" rows="8"
                              class="form-control @error('body') is-invalid @enderror"
                              placeholder="Enter post body" required>{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category"
                            class="form-select @error('category') is-invalid @enderror" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->value }}"
                                @selected(old('category') === $category->value)>
                                {{ $category->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </div>
@endsection
