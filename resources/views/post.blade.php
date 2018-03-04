@extends('layouts.blog-post')

@section('content')
	
	<h1>{{$post->title}}</h1>


		<p class="lead">
			by	<a href="#">{{$post->user->name}}</a>
		</p>

		<hr>

		<p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
	
		<img src="{{$post->photo->file}}" class="img-responsive" alt=""><hr>
		<p>{{$post->body}}</p>

		<hr>

		<div class="well">
			@if (Session::has('comment_message'))
				<div class="alert alert-info">{{Session::get('comment_message')}}</div>
			@endif
			<h4>Leave a Comment</h4>

			{!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}

				<input type="hidden" name="post_id" value="{{$post->id}}">

    <div class="form-group">
    	{!!Form::label('body', 'Body:')!!}
    	{!!Form::textarea('body', null, ['class' => 'form-control', 'rows'=> 3])!!}
    </div>

    <div class="form-group">
			{!!Form::submit('Submit Comment', ['class' => 'btn btn-primary'])!!}
    </div>

  {!! Form::close() !!}
		</div>
@endsection











@section('categories')
	
@if ($categories)
	@foreach ($categories as $category)
		<li><a href="#">{{$category->name}}</a></li>
	@endforeach
@endif
	          
@endsection