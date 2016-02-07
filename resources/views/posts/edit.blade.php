@extends('layouts.template')

@section('content')

    <div style="margin-top:150px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <!-- add this in form -->
        <!-- Create form here and add this data in it -->
        <img src="{{ asset('images/portfolioThumb/'.$post->thumb) }}">

        {!! Form::open(array('method' => 'post', 'route' => array('admin.post.update', $post->id))) !!}
            
            {!! method_field('PUT') !!}

            {!! Form::text('title', $post->title) !!}
            {!! Form::text('link', $post->link) !!}
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
            {!! Form::text('views', $post->views) !!}
            {!! Form::checkbox('active',  1, (boolean) $post->active) !!}
            {!! Form::textarea('description', $post->description) !!}
            {!! Form::textarea('smalldescription', $post->smalldescription) !!}
            {!! Form::button('edit', array('type' => 'submit')) !!}
        {!! Form::close() !!}

        {!! Form::open(array('method' => 'post', 'route' => array('admin.post.destroy', $post->id))) !!}
            
            {!! method_field('DELETE') !!}
            
            {!! Form::button('delete', array('type' => 'submit')) !!}
        {!! Form::close() !!}

    </div>

@stop