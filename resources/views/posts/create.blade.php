@extends('layouts.template')


@section('title')
	{{ 'مدیریت پست ها' }}
@stop


@section('css')
	<link href="{{ asset('css/file-input.css') }}" rel="stylesheet">

	<!-- remove if modernizer included -->
	<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
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

	    {!! Form::open(array('method' => 'post', 'class' => 'ContactForm', 'route' => 'post.store', 'files' => true)) !!}
        	<div class="form-group col-md-6">
        		{!! Form::select('cat_id', $cats, null, array('class' => 'form-control', 'dir' => 'rtl', 'style' => 'height:57px;')) !!}
        	</div>
            <div class="form-group col-md-6">
            	{!! Form::text('title', null, array('class' => 'form-control','placeholder' => ' نـــام پست ...')) !!}
            </div>

            <div class="form-group col-md-12">
            	{!! Form::textarea('smalldescription', null, array('class' => 'form-control','placeholder' => ' توضیحات کوتاه ...','rows' => 3)) !!}
            </div>

	        <div class="form-group col-md-12">
	        	{!! Form::textarea('description', null, array('class' => 'form-control','placeholder' => ' توضیحات کامل ...','rows' => 5)) !!}
	        </div>

	        <div class="form-group col-md-6">
	        	{{-- Form::file('image', null, array('class' => 'form-control inputfile inputfile-6')) --}}
	        	<input type="file" name="image" id="image" class="inputfile inputfile-6" data-multiple-caption="{count} فایل" multiple />
	        	<label for="image" class="form-control"><span></span> <strong>انتخاب عکس</strong></label>
	        	
	        	<!-- <input type="file" name="file-7" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} فایل" multiple /> -->
	        	<!-- <label for="image"><span></span> <strong>انتخاب عکس</strong></label> -->
	        	
	        </div>
        	<div class="form-group col-md-6">
        		{!! Form::text('link', null, array('class' => 'form-control','placeholder' => ' لینک ...')) !!}
        	</div>

	        <div class="form-group btn-group btn-group-lg shadow" role="group" aria-label="...">
	            {!! Form::button('<span class="glyphicon glyphicon-retweet"></span>', array('class' => 'btn btn-default', 'type' => 'reset')) !!}
	            {!! Form::button('ارســــــــال<span class="Spin"></span><span class="comet-spaceman"></span>', array('class' => 'btn btn-xl HoverAnimation', 'id' => 'submit', 'type' => 'submit')) !!}
	        </div>
	    {!! Form::close() !!}

	</div>
</div>
</div>
</section>

@stop

@section('js')
	<script src="{{ asset('js/file-input.js') }}"></script>
@stop