@foreach( $posts as $post )

	<div>
		
		<h1>{{ $post->title }}</h1>
		<p>{{ $post->description }}</p>
		<img src="{{ asset('images/portfolioThumb/'.$post->thumb) }}">
		<p>active : {{ $post->active }}</p>
		<p>views : {{ $post->views }}</p>
		<p>likes : {{ $post->likes()->count() }}</p>
		<p>cat : {{ $post->cat->title }}</p>
		<a href="{{ route('post.edit', ['post' => $post->id]) }}">edit</a>
		<a href="{{ route('post.destroy', ['post' => $post->id]) }}">delete</a>

	</div>

	<br>
	<br>

@endforeach
