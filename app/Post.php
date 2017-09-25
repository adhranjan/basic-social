<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
   protected $fillable=['body','user_id','img_name'];
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
    public function commentreplys(){
        return $this->hasMany('\App\Commentreply');
    }
}
