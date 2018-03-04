@extends('layouts.admin')

@section('content')
	<h1>Comments</h1>

@if (count($comments) > 0)

		<table class="table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Author</th>
					<th>Email</th>
					<th>Body</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($comments as $comment)
					<tr>
						<td>{{$comment->id}}</td>
						<td>{{$comment->author}}</td>
						<td>{{$comment->email}}</td>
						<td>{{str_limit($comment->body, 10)}}</td>
						<td><a href="{{ route('home.post', $comment->post->id) }}">View Post</a></td>
					</tr>
				@endforeach
				

			</tbody>
		</table>

		@else

		<h1 class="text-center">No comments</h1>
@endif
	
@endsection