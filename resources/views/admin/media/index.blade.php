@extends('layouts.admin')

@section('content')

@if(Session::has('cannotdeletephoto'))
        <p class="lead bg-danger">{{ session('cannotdeletephoto') }}</p>
@endif
<h1>Media</h1>

@if ($photos)
	

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Photo</th>
				<th>Folder</th>
				<th>Name with timestamp</th>
				<th>Name</th>
				<th>Created</th>
				
			</tr>
		</thead>

		<tbody>
			@foreach ($photos as $photo)
				@if (file_exists('C:/xampp/htdocs/cool/public/' . $photo->file))
					<tr>
				<td>{{$photo->id}}</td>

				<td>
					<img width="120px" 
					src="{{file_exists('C:/xampp/htdocs/cool/public/' . $photo->file) ? $photo->file : 'http://via.placeholder.com/350x150?text=NoImage'}}"
					 alt="">
				</td>

				<td>{{file_exists('C:/xampp/htdocs/cool/public/' . $photo->file) ? explode("/", $photo->file)[1] : '-'}}</td>
				<td>{{file_exists('C:/xampp/htdocs/cool/public/' . $photo->file) ? explode("/", $photo->file)[2] : '-'}}</td>

				{{-- If file exist and filename is not placeholder.jpeg then I slice it --}}
				<td>
					@if (file_exists('C:/xampp/htdocs/cool/public/' . $photo->file) && explode("/", $photo->file)[2] != 'placeholder.jpeg')
						{{substr(explode("/", $photo->file)[2], 10)}}

						{{-- If file exist and filename is placeholder.jpeg then I dont slice it --}}
						@elseif(explode("/", $photo->file)[2] == 'placeholder.jpeg')

						{{'placeholder.jpeg'}}

					 	{{-- If file not exist  --}}
						@else
						{{'-'}}
					@endif
					
				</td>
				<td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'no date'}}</td>
				<td>
						{!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediaController@destroy', $photo->id ]]) !!}

						<div class="form-group">
							{!!Form::submit('Delete Photo', ['class' => 'btn btn-primary'])!!}
						</div>

					{!! Form::close() !!}
				</td>
			</tr>
				@endif
			
			@endforeach
		</tbody>
	</table>

@endif
@endsection