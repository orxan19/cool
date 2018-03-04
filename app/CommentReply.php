<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    	protected $fillable = [
			'post_id',
			'author',
			'email',
			'body',
			'is_active'
		];

		public function comment(){
			$this->belongsTo('App\Comment');
		}
}
