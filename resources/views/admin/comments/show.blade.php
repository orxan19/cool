@extends('layouts.admin')

@section('content')
    <h1>Comments for Post {{$id}}</h1>

@if (count($comments))

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
                @foreach ($comments as $comment)
                    
               
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->author}}</td>
                        <td>{{$comment->email}}</td>
                        <td>{{str_limit($comment->body, 10)}}</td>
                        <td><a href="{{ route('home.post', $comment->post->id) }}">View Post</a></td>

                        <td>
                            @if ($comment->is_active == 1)
                                {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                    {!!Form::submit('Unapprove', ['class' => 'btn btn-warning'])!!}
                            </div>

                            {!! Form::close() !!}

  @else
                                {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}

                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                    {!!Form::submit('Approve', ['class' => 'btn btn-success'])!!}
                            </div>

                            {!! Form::close() !!}


                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!}

                            

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

        <h1 class="text-center">No comments</h1>
@endif
    
@endsection