
<div class="row">
<div class=" col-md-8 col-md-offset-2">

		<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

{!! Form::open(array('class' => 'form-horizontal')) !!}
	<div class="form-group">
		<div class="col-md-6">
			{!! Form::text('first_name', null, array('class' => 'form-control','placeholder' => ' نـــام ...')) !!}
		</div>
		<div class="col-md-6">
			{!! Form::text('last_name', null, array('class' => 'form-control','placeholder' => ' نـــام خانوادگــی ...')) !!}
		</div>
	</div>

	<div class="form-group col-md-12">
		{!! Form::email('email', null, array('class' => 'form-control','placeholder' => ' پست الکترونیک ...')) !!}
		<small>پست الکترونیک معتبر وارد شود، لینک فعال سازی حساب کاربری ارسال می شود . </small>
	</div>

	<div class="form-group col-md-12">
		{!! Form::text('mobile', null, array('class' => 'form-control','placeholder' => ' شماره همــراه ...' )) !!}
		<small> شماره همراه خود را برای ارسال تراکنش های مالی وارد نمایید, شماره همراه شما در سایت محفوظ می باشد . </small>
	</div>	

	<div class="form-group">
		<div class="col-md-6">
			{!! Form::password('password', array('class' => 'form-control','placeholder' => ' کلمـــه عبور ...')) !!}
		</div>
		<div class="col-md-6">
			{!! Form::password('password_confirm', array('class' => 'form-control','placeholder' => ' تکرار کلمـــه عبور ...')) !!}
		</div>
	</div>

	<div class="form-group col-md-12">
		{!! Form::text('shout',null,array('class' => 'form-control' ,'placeholder' => ' فریـــاد ...')) !!}
	</div>	


	<div class="form-group col-md-12">
		<label class="radio-inline" for="gender">
		  <input type="radio" name="gender" id="gender"/>
		  <i></i> <span>{{trans('general.men')}}</span>
		</label>	
		<label class="radio-inline" for="gender1">
		  <input type="radio" name="gender" id="gender1"/>
		  <i></i> <span>{{trans('general.women')}}</span>
		</label>	
	</div>	

	<div class="form-group pull-left">
		{!! Form::reset(trans('general.reset'), array('class' => 'btn btn1 btn-default')) !!}
		{!! Form::submit(trans('general.register'), array('class' => 'btn btn1 btn-ig')) !!}
	</div>
{!! Form::close() !!}


</div>
</div>

