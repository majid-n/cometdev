@extends('layouts.template')

@section('title')
	{{ 'ایجاد نمونه کار جدید' }}
@stop

@section('seo')
    <meta name="robots" content="noindex,nofollow,nocache,noarchive">
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

                {!! Form::open(['method' => 'post', 'route' => 'admin.post.store', 'files' => true]) !!}

                    <div class="form-group col-md-6">
                        <select class="form-control" name="cat_id">

                            <option>دسته را انتخاب کنید</option>

                            @foreach( $cats as $cat )

                                @if( $cat->parent === 0 )

                                    <optgroup label="&#xf00b; {{ $cat->title }}">

                                        @foreach( $cats as $subcat )

                                            @if( $subcat->parent === $cat->id )
                                                <option value="{{ $subcat->id }}" data-title="{{ $subcat->posts()->count() }}">{{ $subcat->title }}</option>
                                            @endif

                                        @endforeach

                                    </optgroup>

                                @endif
                                    
                            @endforeach
                        </select>
                        <span class="badge backYellow selectBadge"></span>
                        {!! ($errors->has('cat_id')) ? $errors->first('cat_id','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            {!! Form::text('title', null, ['class' => 'form-control','placeholder' => 'نام پست']) !!}
                        </div>
                        {!! ($errors->has('title')) ? $errors->first('title','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                            {!! Form::textarea('smalldescription', null, ['class' => 'form-control','placeholder' => 'توضیحات مختصر','rows' => 3]) !!}
                        </div>
                        {!! ($errors->has('smalldescription')) ? $errors->first('smalldescription','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>
                            {!! Form::textarea('description', null, ['class' => 'form-control','placeholder' => 'توضیحات','rows' => 5]) !!}
                        </div>
                        {!! ($errors->has('description')) ? $errors->first('description','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                            {!! Form::text('link', null, ['class' => 'form-control','placeholder' => 'آدرس اینترنتی']) !!}
                        </div>
                        {!! ($errors->has('link')) ? $errors->first('link','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-6 fileInput">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-picture-o"></i>
                                <input type="file" name="image">
                            </span>
                            <input type="text" class="form-control fileInputText" placeholder="لطفا عکس را انتخاب کنید">
                        </div>
                        {!! ($errors->has('image')) ? $errors->first('image','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-12 btn-group btn-group-lg" role="group">
                        {!! Form::button('ایجاد پست جدید<i class="fa fa-plus"></i>',['class' => 'btn btn-xl', 'type' => 'submit']) !!}
                        {!! Form::button('<i class="fa fa-retweet"></i>', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </section>
@stop

@section('customjs')
    <script type="text/javascript">
        $(document).ready(function() {
            SetCenter('.formSection .row');
            fileInput();
            SelectInit();
        });
    </script>
@stop