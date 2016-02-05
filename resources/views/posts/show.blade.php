@extends('layouts.template')

@section('content')

	<div style="margin-top:150px;">
		<h1>{{ $post->title }}</h1>
		<p>{{ $post->description }}</p>
		<img src="{{ asset('images/portfolio/'.$post->thumb) }}">
		<p>active : {{ $post->active }}</p>
		<p>views : {{ $post->views }}</p>
		<p>likes : {{ $post->likes()->count() }}</p>
		<p>cat : {{ $post->cat->title }}</p>
		<a href="{{ route('admin.post.edit', ['post' => $post->id]) }}">edit</a>
		<a href="{{ route('admin.post.destroy', ['post' => $post->id]) }}">delete</a>

	</div>

	<br>
	<br>

@stop