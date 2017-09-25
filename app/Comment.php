<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['post_id','user_id','comment_body'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function commentreplys(){
        return $this->hasOne('\App\Commentreply');
    }
}
