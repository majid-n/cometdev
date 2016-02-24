<div>
	<h1>{{ $user->first_name.' '.$user->last_name }}</h1>
	<p>{{ $user->email }}</p>
	<p>total likes : {{ $user->likes()->count() }}</p>
	<p>total comments : {{ $user->comments()->count() }}</p>
	<p>total profile comments : {{ $user->profileComments()->count() }}</p>
	<p>profile avg rate : {{ $user->profileRates()->avg('score') }}</p>
	<p>total rates : {{ $user->rates()->count() }}</p>
	<p>Role : {{ $user->roles()->first()->name }}</p>
</div>

<div>
	<h1>resume</h1>
	<p>{{ $user->resume->jobtitle }}</p>
	<p>{{ $user->resume->bio }}</p>
	<p>{{ $user->resume->duty }}</p>
	<p>{{ $user->resume->tel }}</p>
	<p>{{ $user->resume->address }}</p>
	<p>{{ $user->resume->rel }}</p>
	<p>{{ $user->resume->gender }}</p>

	{!! Form::open(array('method' => 'post', 'route' => array('resume.destroy', $user->resume->id))) !!}
	    
	    {!! method_field('DELETE') !!}
	    
	    {!! Form::button('delete resume', array('type' => 'submit')) !!}
	{!! Form::close() !!}

</div>


<div>
	<h1>Skills</h1>
	@foreach( $user->skills as $skill )
		<p>{{ $skill->title }}</p>
		<p>{{ $skill->description }}</p>
		<p>{{ $skill->score }}</p>

		{!! Form::open(array('method' => 'post', 'route' => array('skill.destroy', $skill->id))) !!}
		    
		    {!! method_field('DELETE') !!}
		    
		    {!! Form::button('delete skill', array('type' => 'submit')) !!}
		{!! Form::close() !!}
	@endforeach
</div>

<div>
	<h1>Xps</h1>
	@foreach( $user->xps as $xp )
		<p>{{ $xp->startyear }}</p>
		<p>{{ $xp->endyear }}</p>
		<p>{{ $xp->company }}</p>

		{!! Form::open(array('method' => 'post', 'route' => array('xp.destroy', $xp->id))) !!}
		    
		    {!! method_field('DELETE') !!}
		    
		    {!! Form::button('delete xp', array('type' => 'submit')) !!}
		{!! Form::close() !!}
	@endforeach
</div>

<div>
	<h1>Edu</h1>
	@foreach( $user->edus as $edu )
		<p>{{ $edu->startyear }}</p>
		<p>{{ $edu->endyear }}</p>
		<p>{{ $edu->uni }}</p>
		<p>{{ $edu->degree }}</p>
		<p>{{ $edu->score }}</p>

		{!! Form::open(array('method' => 'post', 'route' => array('edu.destroy', $edu->id))) !!}
		    
		    {!! method_field('DELETE') !!}
		    
		    {!! Form::button('delete edu', array('type' => 'submit')) !!}
		{!! Form::close() !!}
	@endforeach
</div>

<div>
	<h1>Langs</h1>
	@foreach( $user->langs as $lang )
		<p>{{ $lang->title }}</p>
		<p>{{ $lang->score }}</p>

		{!! Form::open(array('method' => 'post', 'route' => array('lang.destroy', $lang->id))) !!}
		    
		    {!! method_field('DELETE') !!}
		    
		    {!! Form::button('delete lang', array('type' => 'submit')) !!}
		{!! Form::close() !!}
	@endforeach
</div>

<div>
	<h1>Comments</h1>
	@foreach( $comments as $comment )

		<img src="{{ asset('images/profile/'.$comment->fromUser->photo) }}" width="50">
		<h6>{{ $comment->fromUser->first_name." ".$comment->fromUser->last_name }}</h6>
		<p>{{ $comment->text }}</p>

		{!! Form::open(array('method' => 'post', 'route' => array('comment.destroy', $comment->id))) !!}
		    
		    {!! method_field('DELETE') !!}
		    
		    {!! Form::button('delete comment', array('type' => 'submit')) !!}
		{!! Form::close() !!}

	@endforeach
</div>