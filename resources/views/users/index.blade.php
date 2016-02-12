
@extends('layouts.template')

@section('content')

	@foreach( $users as $user )

		<div>
			
			<img src="{{ asset('images/profile/'.$user->photo) }}">
			<img src="{{ asset('images/cover/'.$user->cover) }}">
			<h1>{{ $user->first_name.' '.$user->last_name }}</h1>
			<p>{{ $user->email }}</p>
			<p>{{ $user->resume->jobtitle }}</p>
			<p>{{ $user->resume->bio }}</p>
			<p>{{ $user->resume->duty }}</p>
			<p>total likes : {{ $user->likes()->count() }}</p>
			<p>total comments : {{ $user->comments()->count() }}</p>
			<p>total profile comments : {{ $user->profileComments()->count() }}</p>
			<p>profile avg rate : {{ $user->profileRates()->avg('score') }}</p>
			<p>total rates : {{ $user->rates()->count() }}</p>
			<p>Role : {{ $user->roles()->first()->name }}</p>

			<a href="{{ route('admin.user.edit', ['user' => $user->id]) }}">edit</a>
			{!! Form::open(array('method' => 'post', 'route' => array('admin.user.destroy', $user->id))) !!}
			    
			    {!! method_field('DELETE') !!}
			    
			    {!! Form::button('delete', array('type' => 'submit')) !!}
			{!! Form::close() !!}

		</div>

		<br>
		<br>

	@endforeach

	{!! $users->links() !!}

@stop