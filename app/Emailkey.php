<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emailkey extends Model
{
    protected $fillable=['key','user_id'];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
