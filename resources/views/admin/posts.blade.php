@extends('layouts.template')


@section('title')
	{{ 'مدیریت پست ها' }}
@stop


@section('content')

<section id="contact">
<div class="container" style="margin-top:100px;">
<div class="row">
	<div class="col-md-8 col-md-offset-2">

	<!-- Show Errors And Success -->
		@if ($errors->any())
		   <div class="alert alert-danger alert-block">
		      <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
		      <strong>{{trans('general.error')}}</strong>
		      @if ($message = $errors->first(0, ':message'))
		         {{ $message }}
		      @else
		         {{trans('validation.check_errors')}}
		      @endif
		   </div>
		@endif

		@if ($message = Session::get('success'))
		   <div class="alert alert-success alert-block">
		      <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
		      <strong>{{trans('general.success')}}</strong> {{ $message }}
		   </div>
		@endif

	    {!! Form::open(array('method' => 'post', 'class' => 'ContactForm', 'route' => 'AddPost', 'files' => true)) !!}
        	<div class="form-group col-md-6">
        		{!! Form::select('cat_id', $listArray, 'category', array('class' => 'form-control', 'dir' => 'rtl', 'style' => 'height:57px;')) !!}
        	</div>
            <div class="form-group col-md-6">
            	{!! Form::text('title', null, array('class' => 'form-control','placeholder' => ' نـــام پست ...')) !!}
            </div>

	        <div class="form-group col-md-12">
	        	{!! Form::textarea('description', null, array('class' => 'form-control','placeholder' => ' توضیحات ...','rows' => 4)) !!}
	        </div>

	        <div class="form-group col-md-12">
	        	{!! Form::textarea('smalldescription', null, array('class' => 'form-control','placeholder' => ' توضیحات کوتاه ...','rows' => 3)) !!}
	        </div>

	        <div class="form-group col-md-6">
	        	{!! Form::file('image', null, array('class' => 'form-control')) !!}
	        </div>
        	<div class="form-group col-md-6">
        		{!! Form::text('link', null, array('class' => 'form-control','placeholder' => ' لینک ...')) !!}
        	</div>
        	


	        <div class="btn-group btn-group-lg pull-left shadow" role="group" aria-label="...">
	            {!! Form::button('<span class="glyphicon glyphicon-retweet"></span>', array('class' => 'btn btn-default', 'type' => 'reset')) !!}
	            {!! Form::button('ارســــــــال<span class="Spin"></span><span class="comet-spaceman"></span>', array('class' => 'btn btn-xl HoverAnimation', 'id' => 'submit', 'type' => 'submit')) !!}
	        </div>
	    {!! Form::close() !!}

	</div>
</div>
</div>
</section>

@stop