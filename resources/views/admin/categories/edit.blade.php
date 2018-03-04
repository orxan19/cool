@extends('layouts.admin')

@section('content')
	<h1>Categories</h1>

	<div class="col-sm-9">
		{!! Form::open(['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->id]]) !!}

    <div class="form-group">
    	{!!Form::label('name', 'Name:')!!}
    	{!!Form::text('name', $category->name, ['class' => 'form-control'])!!}
    </div>

    <div class="form-group">
			{!!Form::submit('Update Category', ['class' => 'btn btn-primary'])!!}
    </div>

  {!! Form::close() !!}
	</div>

	<div class="col-sm-3">
		{!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!}
        		{!!Form::label('', 'Deleting:')!!}
        		<div class="form-group">
            {!!Form::submit('Delete Category', ['class' => 'btn btn-danger'])!!}
        </div>
    {!! Form::close() !!}
	</div>
@endsection