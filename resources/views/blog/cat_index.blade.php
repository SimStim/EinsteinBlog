@extends('layouts.app') @section('content')
<div class="container">
	<div class="jumbotron text-center">
		<div class="col-12 pt-2">
			<div class="row">
				<div class="col-12">
					<p>
						<a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
					</p>
					<h1 class="display-one">Posts in {{ $cat_name }}</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					@forelse($posts as $post)
					<ul>
						<li><a href="/blog/{{ $post->id }}">{{ ucfirst($post->title) }}</a></li>
					</ul>
					@empty
					<p class="text-warning">No blog Posts available</p>
					@endforelse
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
