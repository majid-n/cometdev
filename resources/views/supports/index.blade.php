
@extends('layouts.template')

@section('content')

	@foreach( $supports as $support )

		<div>
			
			<h1>{{ $support->fullname }}</h1>
			<p>{{ $support->email }}</p>
			<p>tel: {{ $support->tel }}</p>
			<p>des : {{ $support->description }}</p>
			<p>ip : {{ $support->ip }}</p>
			<p>created at : {{ $support->created_at }}</p>
			@if( $support->seen === 1 )
				<p>cat : {{ $support->replymsg }}</p>
				<p>updated at : {{ $support->updated_at }}</p>
				{!! Form::open(array('method' => 'post', 'route' => array('admin.support.destroy', $support->id))) !!}
				    {!! method_field('DELETE') !!}
				    {!! Form::button('delete', array('type' => 'submit')) !!}
				{!! Form::close() !!}
			@else
				<a href="{{ route('admin.support.edit', ['support' => $support->id]) }}">reply</a>
			@endif

		</div>

		<br>
		<br>

	@endforeach

	{!! $supports->links() !!}

@stop