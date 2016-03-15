@extends('layouts.template')

@section('title')
    {{ 'ویرایش نمونه کار' }}
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
                <h3 class="text-shadow text-right">ویرایش نمونه کار <i class="fa fa-pencil yellow"></i></h3>
            </div>
            <div class="col-md-8 col-md-offset-2 shadow formContent">

                {!! Form::open([ 'method' => 'post', 'route' => ['admin.post.update', $post->id] ]) !!}

                    {!! method_field('PUT') !!}

                    <div class="form-group col-md-6">
                        <select class="form-control" name="cat_id">

                            <option>دسته را انتخاب کنید</option>

                            @foreach( $cats as $cat )

                                @if( $cat->parent === 0 )

                                    <optgroup label="&#xf00b; {{ $cat->title }}">

                                        @foreach( $cats as $subcat )

                                            @if( $subcat->parent === $cat->id )

                                                @if( $subcat->id === $post->cat->id )
                                                    <option value="{{ $subcat->id }}" data-title="{{ $subcat->posts()->count() }}" selected>{{ $subcat->title }}</option>
                                                @else
                                                    <option value="{{ $subcat->id }}" data-title="{{ $subcat->posts()->count() }}">{{ $subcat->title }}</option>
                                                @endif

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
                            {!! Form::text('title', $post->title, ['class' => 'form-control','placeholder' => 'نام پست']) !!}
                        </div>
                        {!! ($errors->has('title')) ? $errors->first('title','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                            {!! Form::textarea('smalldescription', $post->smalldescription, ['class' => 'form-control','placeholder' => 'توضیحات مختصر','rows' => 3]) !!}
                        </div>
                        {!! ($errors->has('smalldescription')) ? $errors->first('smalldescription','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>
                            {!! Form::textarea('description', $post->description, ['class' => 'form-control','placeholder' => 'توضیحات','rows' => 5]) !!}
                        </div>
                        {!! ($errors->has('description')) ? $errors->first('description','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                            {!! Form::text('link', $post->link, ['class' => 'form-control','placeholder' => 'آدرس اینترنتی']) !!}
                        </div>
                        {!! ($errors->has('link')) ? $errors->first('link','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-eye"></i></span>
                            {!! Form::text('views', $post->views, ['class' => 'form-control','placeholder' => 'تعداد بازدید']) !!}
                        </div>
                        {!! ($errors->has('views')) ? $errors->first('views','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-12 switch">
                        <div class="input-group">
                            <span class="text-shadow">وضعیت : <b class="yellow">{{ $post->active == 1 ? 'فعال' : 'تعلیق' }}</b></span>
                            <div class="onoffswitch">
                                {!! Form::checkbox('active',  1, (boolean) $post->active, ['class' => 'onoffswitch-checkbox', 'id' => 'myonoffswitch']) !!}
                                <label class="onoffswitch-label" for="myonoffswitch">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                        {!! ($errors->has('active')) ? $errors->first('active','<p class="formError text-shadow"><i class="fa fa-exclamation-triangle yellow"></i>:message</p>') : "" !!}
                    </div>

                    <div class="form-group col-md-12 btn-group btn-group-lg" role="group">
                        {!! Form::button('ویرایش نمونه کار<i class="fa fa-pencil"></i>',['class' => 'btn btn-primary transitionfast', 'type' => 'submit']) !!}
                        {!! Form::button('حذف نمونه کار<i class="fa fa-trash"></i>',['class' => 'btn btn-danger transitionfast', 'type' => 'submit']) !!}
                        {!! Form::button('<i class="fa fa-retweet"></i>', ['class' => 'btn btn-default transitionfast', 'type' => 'reset']) !!}
                    </div>
                {!! Form::close() !!}
                
                {!! Form::open([ 'method' => 'post', 'route' => ['admin.post.destroy', $post->id] ]) !!}
                            
                    {!! method_field('DELETE') !!}
                    {!! Form::button('حذف نمونه کار<i class="fa fa-trash"></i>',['class' => 'btn btn-danger transitionfast', 'type' => 'submit']) !!}
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