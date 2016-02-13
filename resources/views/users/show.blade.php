@extends('layouts.template')

@section('content')

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

		@foreach( $comments as $comment )

			<img src="{{ asset('images/profile/'.$comment->fromUser->photo) }}" width="50">
			<h6>{{ $comment->fromUser->first_name." ".$comment->fromUser->last_name }}</h6>
			<p>{{ $comment->text }}</p>

		@endforeach

		{!! Form::open(array('method' => 'post', 'route' => array('admin.user.destroy', $user->id))) !!}
		    
		    {!! method_field('DELETE') !!}
		    
		    {!! Form::button('delete', array('type' => 'submit')) !!}
		{!! Form::close() !!}

	</div>

	<br>
	<br>

@stop