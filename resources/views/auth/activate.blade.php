@extends('layouts.template')

@section('content')
	<div class="row" style="margin-top:150px;">
	<div class="col-md-6 col-md-offset-3" >

				<ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>


			{!! Form::open(array('method' => 'post')) !!}
				<div class="form-group">
					{!! Form::email('email', null, array('placeholder' => ' آدرس ایمیــل ...', 'class' => 'form-control')) !!}
				</div>

				<div class="form-group pull-left">
					{!! Form::submit(trans('general.login'), array('class' => 'btn btn1 btn-ig')) !!}
				</div>
			{!! Form::close() !!}

	</div>
	</div>
@endsection