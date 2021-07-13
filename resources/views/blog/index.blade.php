@extends('layouts.app') @section('content')
<div class="container">
	<div class="jumbotron text-center">
		<div class="col-12 pt-2">
			<div class="row">
				<div class="col-8">
					<h1 class="display-one">Our Blog!</h1>
					<p>Enjoy reading our posts. Click on a post to read!</p>
				</div>
				<div class="col-4">
					<p>Create new Post</p>
					<a href="/blog/create/post" class="btn btn-primary btn-sm">Add Post</a>
				</div>
			</div>
			<div class="row">
				<div class="col-8">
					@forelse($posts as $post)
					<ul>
						<li><a href="/blog/{{ $post->id }}">{{ ucfirst($post->title) }}</a></li>
					</ul>
					@empty
					<p class="text-warning">No blog Posts available</p>
					@endforelse
				</div>
				<div class="col-4">
					<p>Categories:</p>
					@forelse($cat_names as $cat_name)
					<ul>
						<li><a href="/cat/{{ $cat_name->cat_name }}">{{
								ucfirst($cat_name->cat_name) }}</a></li>
					</ul>
					@empty
					<p class="text-warning">No categories defined</p>
					@endforelse
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
