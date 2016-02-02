
	<div>
		<!-- add this in form -->
		<!-- Create form here and add this data in it -->
		<img src="{{ asset('images/portfolioThumb/'.$post->thumb) }}">

	    {!! Form::open(array('method' => 'post', 'route' => array('post.update', $post->id))) !!}
        	
        	{!! method_field('PUT') !!}

            {!! Form::text('title', $post->title) !!}
            {!! Form::text('link', $post->link) !!}
            {!! Form::text('views', $post->views) !!}
            {!! Form::text('active', $post->active) !!}
	        {!! Form::textarea('description', $post->description) !!}
	        {!! Form::textarea('smalldescription', $post->smalldescription) !!}
	        {!! Form::button('edit', array('type' => 'submit')) !!}
	    {!! Form::close() !!}

	    {!! Form::open(array('method' => 'post', 'route' => array('post.destroy', $post->id))) !!}
        	
        	{!! method_field('DELETE') !!}
        	
	        {!! Form::button('delete', array('type' => 'submit')) !!}
	    {!! Form::close() !!}

	</div>