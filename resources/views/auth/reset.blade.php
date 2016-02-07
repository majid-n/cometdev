@extends('layouts.template')

@section('content')

    <div class="container" style="margin-top:150px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                    
                <h3>Reset Password</h3>

                {!! Form::open(array('method' => 'post','route'=>'reset.post')) !!}

                    <div class="form-group">
                        {!! Form::password('password', array('placeholder' => 'Password', 'required' => 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::password('password_confirm', array('placeholder' => 'Password confirmation','required' => 'required')) !!}
                    </div>

                    {!! Form::hidden('code', $code )!!}
                    {!! Form::hidden('email', $user->email )!!}


                    <div class="form-group">
                        {!! Form::submit('Reset Password') !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection