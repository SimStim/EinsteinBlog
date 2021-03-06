@extends('layouts.app') @section('content')
<div class="container">
	<div class="jumbotron text-center">
		<div class="col-12 pt-2">
			<a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
			<div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
				<h1 class="display-4">Edit Post</h1>
				<p>Edit and submit this form to update a post</p>

				<hr>

				<form action="" method="POST">
					@csrf @method('PUT')
					<div class="row">
						<div class="control-group col-12">
							<label for="title">Post Title</label> <input type="text"
								id="title" class="form-control" name="title"
								placeholder="Enter Post Title" value="{{ $post->title }}"
								required>
						</div>
						<div class="control-group col-12 mt-2">
							<label for="body">Post Body</label>
							<textarea id="body" class="form-control" name="body"
								placeholder="Enter Post Body" rows="5" required>{{ $post->body }}</textarea>
						</div>
						<div class="control-group col-12 mt-2">
							<label for="cat_name">Choose a category:</label> <select
								id="cat_name" name="cat_name">
								<option value="IT" @if($post->cat_name == "IT") selected @endif>IT</option>
								<option value="Philology" @if($post->cat_name == "Philology") selected @endif>Philology</option>
								<option value="General" @if($post->cat_name == "General") selected @endif>General</option>
								<option value="Nonsense" @if($post->cat_name == "Nonsense") selected @endif>Nonsense</option>
							</select>
						</div>
					</div>
					<div class="row mt-2">
						<div class="control-group col-12 text-center">
							<button id="btn-submit" class="btn btn-primary">Update Post</button>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

@endsection
