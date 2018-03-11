@extends('layouts.blog-post')

@section('content')
	
	<h1>{{$post->title}}</h1>


		<p class="lead">
			by	<a href="#">{{$post->user->name}}</a>
		</p>

		<hr>

		<p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
	
		<img src="{{$post->photo ? $post->photo->file  :  ''}}" class="img-responsive" alt=""><hr>
		<p>{!!$post->body!!}</p>

		<hr>
	

		<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://blogdisquscom-1.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

<script id="dsq-count-scr" src="//blogdisquscom-1.disqus.com/count.js" async></script>
{{-- @if (Auth::check())


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

		@endif --}}

<hr>

{{-- @if (count($comments) > 0)
	@foreach ($comments as $comment)
		<div class="media">
		<a href="#" class="pull-left">
			<img src="{{$comment->photo}}" width="64px" class="img-responsive media-object"  alt="">
		</a>
		
		<div class="media-body">
			<h4 class="media-heading">{{$comment->author}}
				<small>{{$comment->created_at->diffForHumans()}}</small>
			</h4>
			<p>{{$comment->body}}</p>


@if (count($comment->replies) > 0)

@foreach ($comment->replies as $reply) --}}

{{-- Eger reply->active == 1 olan yoxdusa kastil ))))))))) --}}

{{-- @php
	$flag = false;
@endphp

@if ($reply->is_active == 1)

@php
	$flag = true;
@endphp
	

	<div class="media nested-comment">
				<a href="" class="pull-left">
					<img width="64px" src="{{$reply->photo}}" alt="" class="media-object img-responsive">
				</a>
				<div class="media-body">
					<h4 class="media-heading">{{$reply->author}}
						<small>{{$reply->created_at->diffForHumans()}}</small>
					</h4>
					<p>{{$reply->body}}</p>

				</div>
			</div>
			
	@endif


	
	
@endforeach

@php
	if(!$flag){
		echo "<h1>No replies</h1>";
	}
@endphp

			@endif

	<div class="comment-reply-container">
		<button class="toggle-reply btn btn-primary pull-right col-sm-2">Reply</button>

		<div class="comment-reply col-sm-10">

		
			{!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}

    <div class="form-group">
<input type="hidden" name="comment_id" value="{{$comment->id}}">
    	{!!Form::textarea('body', null, ['class' => 'form-control', 'rows' => 1,'placeholder' =>'Reply'])!!}
    </div>

    <div class="form-group">
			{!!Form::submit('Submit', ['class' => 'btn btn-primary'])!!}
    </div>

  {!! Form::close() !!}

  </div>

		</div>
		</div><!-- comment reply container-->

	</div>
	@endforeach
	
@endif

@endsection


@section('scripts')
	<script>
		$('.comment-reply-container .toggle-reply').click(function(){

			$(this).next().slideToggle('slow');

		});
	</script> --}}
@endsection








@section('categories')
	
@if ($categories)
	@foreach ($categories as $category)
		<li><a href="#">{{$category->name}}</a></li>
	@endforeach
@endif
	          
@endsection