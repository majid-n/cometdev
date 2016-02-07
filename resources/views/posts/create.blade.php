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
<div class="container" style="margin-top:150px;">
<div class="row">
	<div class="col-md-8 col-md-offset-2">
	
	<!-- Show Errors And Success -->
		<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

	    {!! Form::open(array('method' => 'post', 'class' => 'ContactForm', 'route' => 'admin.post.store', 'files' => true)) !!}

        	<div class="form-group col-md-6">

        		<select class="form-control" dir="rtl" style="height:57px;" name="cat_id">

        			<option>دســـته را انتخاب کنید</option>

        			@foreach( $cats as $cat )

        				@if( $cat->parent === 0 )

        					<optgroup label="{{ $cat->title }}">

	        					@foreach( $cats as $subcat )

	        						@if( $subcat->parent === $cat->id )
	        							<option value="{{ $subcat->id }}" data-posts="{{ $subcat->posts()->count() }}">{{ $subcat->title }}</option>
	        						@endif

	        					@endforeach

        					</optgroup>

        				@endif
        					
        			@endforeach

        		</select>

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
	        	<input type="file" name="image" id="image" class="inputfile inputfile-6"/>
	        	<label for="image" class="form-control"><span></span> <strong><i class="fa fa-2x fa-picture-o"></i></strong></label>
	        </div>
        	<div class="form-group col-md-6">
        		{!! Form::text('link', null, array('class' => 'form-control','placeholder' => ' لینک ...')) !!}
        	</div>

	        <div class="form-group col-md-12 btn-group btn-group-lg" role="group" aria-label="...">
             	{!! Form::button('<i class="fa fa-retweet"></i>', array('class' => 'btn btn-default', 'type' => 'reset')) !!}
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