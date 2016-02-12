
@extends('layouts.template')

@section('content')

	@foreach( $posts as $post )

		<div>
			
			<h1>{{ $post->title }}</h1>
			<p>{{ $post->description }}</p>
			<img src="{{ asset('images/portfolioThumb/'.$post->thumb) }}">
			<p>active : {{ $post->active }}</p>
			<p>views : {{ $post->views }}</p>
			<p>link : {{ $post->link }}</p>
			<p>likes : {{ $post->likes()->count() }}</p>
			<p>cat : {{ $post->cat->title }}</p>
			<a href="{{ route('admin.post.edit', ['post' => $post->id]) }}">edit</a>
			{!! Form::open(array('method' => 'post', 'route' => array('admin.post.destroy', $post->id))) !!}
			            
	            {!! method_field('DELETE') !!}
	            
	            {!! Form::button('delete', array('type' => 'submit')) !!}
	        {!! Form::close() !!}

		</div>

		<br>
		<br>

	@endforeach

	{!! $posts->links() !!}

@stop