@extends('layouts.template')

@section('title')
	{{ 'ایجاد نمونه کار جدید' }}
@stop

@section('nav')
    @include('layouts.smallnav')
@stop

@section('content')

<section class="container-fluid formSection" style="background-image:url({{ asset('img/backgrounds/'.$backgrounds->random()) }});">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="text-shadow text-right">ایجاد نمونه کار جدید <i class="fa fa-plus yellow"></i></h3>
        </div>
        <div class="col-md-8 col-md-offset-2 shadow formContent">
        
            <!-- Show Errors And Success -->
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            {!! Form::open(array('method' => 'post', 'class' => 'ContactForm', 'route' => 'admin.post.store', 'files' => true)) !!}

                <div class="form-group col-md-6">
                        
                    <select class="form-control" name="cat_id">

                        <option>دسته را انتخاب کنید</option>

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
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        {!! Form::text('title', null, array('class' => 'form-control','placeholder' => 'نام پست')) !!}
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                        {!! Form::textarea('smalldescription', null, array('class' => 'form-control','placeholder' => 'توضیحات کوتاه','rows' => 3)) !!}
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>
                        {!! Form::textarea('description', null, array('class' => 'form-control','placeholder' => 'توضیحات کامل','rows' => 5)) !!}
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-link"></i></span>
                        {!! Form::text('link', null, array('class' => 'form-control','placeholder' => ' لینک')) !!}
                    </div>
                </div>

                <div class="form-group col-md-6 fileInput">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-picture-o"></i>
                            <input type="file" name="image">
                        </span>
                        <input type="text" class="form-control fileInputText" placeholder="لطفا عکس را انتخاب کنید">
                    </div>
                </div>

                <div class="form-group col-md-12 btn-group btn-group-lg" role="group" aria-label="...">
                    {!! Form::button('ایجاد پست جدید<i class="fa fa-plus"></i>', array('class' => 'btn btn-xl', 'type' => 'submit')) !!}
                    {!! Form::button('<i class="fa fa-retweet"></i>', array('class' => 'btn btn-default', 'type' => 'reset')) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>

@stop

@section('js')
    <script src='{{ asset('js/file-input.js') }}'></script>
@stop