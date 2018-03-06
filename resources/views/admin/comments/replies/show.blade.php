@extends('layouts.admin')

@section('content')
    <h1>Replies for Comment {{$id}}</h1>

@if (count($replies) > 0)

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                    <th>Post</th>
                    <th>Approving</th>
                    <th>Deleting</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($replies as $reply)
                    
               
                    <tr>
                        <td>{{$reply->id}}</td>
                        <td>{{$reply->author}}</td>
                        <td>{{$reply->email}}</td>
                        <td>{{str_limit($reply->body, 10)}}</td>
                        <td><a href="{{ route('home.post', $comment->post->id) }}">View Post</a></td>

                        <td>
                            @if ($reply->is_active == 1)
                                {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                    {!!Form::submit('Unapprove', ['class' => 'btn btn-warning'])!!}
                            </div>

                            {!! Form::close() !!}

  @else
                                {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                    {!!Form::submit('Approve', ['class' => 'btn btn-success'])!!}
                            </div>

                            {!! Form::close() !!}


                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}

                            

                            <div class="form-group">
                                    {!!Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
                            </div>

                            {!! Form::close() !!}
                        </td>
                    </tr>
                
                
 @endforeach
            </tbody>
        </table>

        @else

        <h1 class="text-center">No replies</h1>
@endif
    
@endsection