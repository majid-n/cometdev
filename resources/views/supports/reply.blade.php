@extends('layouts.template')

@section('content')

    <div style="margin-top:150px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <h1>{{ $support->fullname }}</h1>
        <p>{{ $support->email }}</p>
        <p>tel: {{ $support->tel }}</p>
        <p>des : {{ $support->description }}</p>
        <p>ip : {{ $support->ip }}</p>
        <p>created at : {{ $support->created_at }}</p>

        {!! Form::open(array('method' => 'post', 'route' => array('admin.support.update', $support->id))) !!}
            {!! method_field('PUT') !!}
            {!! Form::textarea('replymsg', null, array('class' => 'form-control','placeholder' => ' متن پیام ...','rows' => 3)) !!}
            {!! Form::button('reply', array('type' => 'submit')) !!}
        {!! Form::close() !!}

        {!! Form::open(array('method' => 'post', 'route' => array('admin.support.destroy', $support->id))) !!}
            {!! method_field('DELETE') !!}
            {!! Form::button('delete', array('type' => 'submit')) !!}
        {!! Form::close() !!}

    </div>

@stop