@extends('layouts.template')

@section('content')

<div class="row" style="margin-top:150px;">
    <div class="col-md-6 col-md-offset-3">

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>


        {!! Form::open() !!}
            <div class="form-group">
                {!! Form::email('email', null, array('placeholder' => ' آدرس ایمیــل ...', 'class' => 'form-control')) !!}
                
            </div>

            <div class="form-group">
                {!! Form::password('password', array('placeholder' => ' کلمـــه عبـــور ...', 'class' => 'form-control')) !!}
            
                <a role="button" href="{{ route('forgot') }}" class="ig-color pull-left">{{trans('general.forgetpassword')}}</a><br>
            </div>

            <div class="form-group">
                <label for="remember">
                  <input name="remember" type="checkbox" id="remember"/>
                  <span>{{trans('general.rememberme')}}</span>
                </label>                    
            </div>
            <br>
            <div class="form-group pull-left">
                {!! Form::reset(trans('general.reset'), array('class' => 'btn btn1 btn-default')) !!}
                {!! Form::submit(trans('general.login'), array('class' => 'btn btn1 btn-ig')) !!}
            </div>
        {!! Form::close() !!}

    </div>
</div>

@endsection