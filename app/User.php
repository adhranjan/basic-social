<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{

    use \Illuminate\Auth\Authenticatable;
    protected $fillable = array('fullname', 'email','password');

    public function posts(){
        return $this->hasMany('\App\Post');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function commentreplys(){
        return $this->hasMany('\App\Commentreply');
    }

    public function Emailkey(){
        return $this->hasOne('\App\Emailkey');
    }

}
