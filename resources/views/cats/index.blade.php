
@extends('layouts.template')

@section('content')

	@foreach( $cats as $cat )

		<div>
			
			<h1>{{ $cat->title }}</h1>
			<p>id : {{ $cat->id }}</p>
			<p>parent : {{ $cat->parent }}</p>
			<a href="{{ route('admin.cat.edit',    ['cat' => $cat->id]) }}">edit</a>
			<a href="{{ route('admin.cat.destroy', ['cat' => $cat->id]) }}">delete</a>

		</div>

		<br>
		<br>

	@endforeach

	{!! $cats->links() !!}

@stop