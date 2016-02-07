@extends('layouts.template')


@section('title')
    {{ 'مدیریت پست ها' }}
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

        {!! Form::open( array('method' => 'post', 'class' => 'ContactForm', 'route' => array('admin.cat.update', $cat->id) ) ) !!}
            {!! method_field('PUT') !!}
            <div class="form-group col-md-6">

                <select class="form-control" dir="rtl" style="height:57px;" name="cat_id" @if( $cat->parent === 0 ) disabled @endif>

                    <option>دســـته را انتخاب کنید</option>
                    <option value="0">دسته جدید</option>


                    @foreach( $categories as $category )
                        @if( $category->id === $cat->parent )
                            <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endif
                    @endforeach

                </select>
            

            </div>

            <div class="form-group col-md-6">
                {!! Form::text('title', $cat->title , array('class' => 'form-control','placeholder' => ' نـــام پست ...')) !!}
            </div>

            <div class="form-group col-md-12 btn-group btn-group-lg" role="group" aria-label="...">
                {!! Form::button('<i class="fa fa-retweet"></i>', array('class' => 'btn btn-default', 'type' => 'reset')) !!}
                {!! Form::button('ارســــــــال<span class="Spin"></span><span class="comet-spaceman"></span>', array('class' => 'btn btn-xl HoverAnimation', 'id' => 'submit', 'type' => 'submit')) !!}
            </div>
        {!! Form::close() !!}
        {!! Form::open(array('method' => 'post', 'route' => array('admin.cat.destroy', $cat->id))) !!}
            {!! method_field('DELETE') !!}
            {!! Form::button('delete', array('type' => 'submit')) !!}
        {!! Form::close() !!}

    </div>
</div>
</div>
</section>

@stop