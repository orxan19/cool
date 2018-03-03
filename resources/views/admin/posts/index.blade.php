@extends('layouts.admin')



@section('content')

@php
    use Carbon\Carbon;

    $locale = session()->get('locale');
    Carbon::setLocale($locale);
@endphp
	<h1>Posts</h1>

	<table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
		
	@if ($posts)
		
		@foreach ($posts as $post)
			      <tr>
	             <td>{{$post->id}}</td>
                 <td>

                    <img src="{{$post->photo ? $post->photo->file : 'http://via.placeholder.com/350x150?text=NoImage'}}" width="100px" alt="">

                </td>
	             <td><a href="{{ route('posts.edit', $post->id) }}">{{$post->user->name}}</a></td>
	             <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
	             
	             <td>{{$post->title}}</td>
	             <td>{{str_limit($post->body, 17)}}</td>
	             <td>{{$post->created_at->diffForHumans()}}</td>
	             <td>{{$post->updated_at->diffForHumans()}}</td>
            </tr>
		@endforeach

    @endif
    </tbody>
  </table>
@endsection