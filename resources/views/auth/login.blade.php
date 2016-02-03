

<div class="row">
<div class="col-md-6 col-md-offset-3">

			<ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>


		{!! Form::open(array('autocomplete' => 'off')) !!}
			<div class="form-group">
				{!! Form::email('email', null, array('placeholder' => ' آدرس ایمیــل ...', 'class' => 'form-control')) !!}
				
			</div>

			<div class="form-group">
				{!! Form::password('password', array('placeholder' => ' کلمـــه عبـــور ...', 'class' => 'form-control')) !!}
			
				<a role="button" href="{{ URL::to('reset') }}" class="ig-color pull-left">{{trans('general.forgetpassword')}}</a><br>
			</div>

			<div class="form-group">
				<label for="remember">
				  <input type="checkbox" id="remember"/>
				  <i></i> <span>{{trans('general.rememberme')}}</span>
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
