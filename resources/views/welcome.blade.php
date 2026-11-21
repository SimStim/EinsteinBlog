@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <div class="px-4 py-5 mt-4 text-center bg-light rounded-3">
        <h1 class="display-4 fw-bold">{{ config('app.name') }}</h1>
        <div class="col-lg-7 mx-auto">
            <p class="lead mb-4">
                A minimal blog about curious things. “Make it as simple as possible.” — Albert Einstein.
            </p>
            <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg">Show Blog</a>
        </div>
    </div>
@endsection
