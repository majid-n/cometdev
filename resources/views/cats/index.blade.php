
@extends('layouts.template')

@section('content')

	@foreach( $cats as $cat )

		<div>
			
			<h1>{{ $cat->title }}</h1>
			<p>id : {{ $cat->id }}</p>
			<p>parent : {{ $cat->parent }}</p>
			<a href="{{ route('admin.cat.edit',    ['cat' => $cat->id]) }}">edit</a>
			{!! Form::open(array('method' => 'post', 'route' => array('admin.cat.destroy', $cat->id))) !!}
			    {!! method_field('DELETE') !!}
			    {!! Form::button('delete', array('type' => 'submit')) !!}
			{!! Form::close() !!}
		</div>

		<br>
		<br>

	@endforeach

	{!! $cats->links() !!}

@stop