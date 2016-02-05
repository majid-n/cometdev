@extends('layouts.template')

@section('content')
<div class="container">
	

	<div class="row" style="margin-top:150px;">
	<div class=" col-md-8 col-md-offset-2">

			<ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>

	{!! Form::open(array('class' => 'form-horizontal')) !!}
		<div class="form-group">
			<div class="col-md-6">
				{!! Form::text('first_name', null, array('class' => 'form-control','placeholder' => ' نـــام ...')) !!}
			</div>
			<div class="col-md-6">
				{!! Form::text('last_name', null, array('class' => 'form-control','placeholder' => ' نـــام خانوادگــی ...')) !!}
			</div>
		</div>

		<div class="form-group col-md-12">
			{!! Form::email('email', null, array('class' => 'form-control','placeholder' => ' پست الکترونیک ...')) !!}
		</div>

		<div class="form-group">
			<div class="col-md-6">
				{!! Form::password('password', array('class' => 'form-control','placeholder' => ' کلمـــه عبور ...')) !!}
			</div>
			<div class="col-md-6">
				{!! Form::password('password_confirm', array('class' => 'form-control','placeholder' => ' تکرار کلمـــه عبور ...')) !!}
			</div>
		</div>

		<div class="form-group pull-left">
			{!! Form::reset(trans('general.reset'), array('class' => 'btn btn1 btn-default')) !!}
			{!! Form::submit(trans('general.register'), array('class' => 'btn btn1 btn-ig')) !!}
		</div>
	{!! Form::close() !!}


	</div>
	</div>
	</div>

@stop