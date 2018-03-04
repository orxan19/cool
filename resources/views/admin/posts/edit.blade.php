@extends('layouts.admin')

@section('content')

	<h1>Edit Post</h1>
   @include('includes.form_error')
 <div class="row">

    <div class="col-md-4">
        <img src="{{$post->photo->file}}" class="img-responsive img-rounded" alt="">
    </div>

    <div class="col-md-8">
	{!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id],'files'=>true]) !!}

    <div class="form-group">
    	{!!Form::label('title', 'Title:')!!}
    	{!!Form::text('title', null, ['class' => 'form-control'])!!}
    </div>

    <div class="form-group">
    	{!!Form::label('category_id', 'Category:')!!}
    	{!!Form::select('category_id', $categories, null, ['class' => 'form-control'])!!}
    </div>

    <div class="form-group">
    	{!!Form::label('photo_id', 'Photo:')!!}
    	{!!Form::file('photo_id', ['class' => 'form-control'])!!}
    </div>

		<div class="form-group">
	    	{!!Form::label('body', 'Description:')!!}
	    	{!!Form::textarea('body',null,  ['class' => 'form-control'])!!}
	   </div>

        <div class="form-group">
			{!!Form::submit('Update Post', ['class' => 'btn btn-primary'])!!}
    

  {!! Form::close() !!}

  {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id],'class' =>'pull-right']) !!}
        
            {!!Form::submit('Delete Post', ['class' => 'btn btn-danger'])!!}
        
    {!! Form::close() !!}
</div>
</div>
</div>
@endsection