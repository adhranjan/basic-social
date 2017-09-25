<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable=['post_id','user_id','comment_id','replyBody'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comment(){
        return $this->belongsTo('App\Comment');
    }
    public function post(){
        return $this->belongsTo('App\Post');
    }


}
