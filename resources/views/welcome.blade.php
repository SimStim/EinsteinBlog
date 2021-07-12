@extends('layouts.app') @section('content')
<div class="container">
	<div class="jumbotron text-center">
		<h1 class="display-one mt-5">{{ config('app.name') }}</h1>
		<p>This awesome blog has many articles, click the button below to see
			them</p>
		<br> <a href="/blog" class="btn btn-outline-primary">Show Blog</a>
	</div>
</div>
@endsection
