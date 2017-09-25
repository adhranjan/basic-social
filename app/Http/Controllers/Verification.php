<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;

class Verification extends Controller
{
    public function emailproof(){
        $user=Auth::user();
        $email=$user->email;
        return view('Authenticate/emailproof')->with('email',$email);
    }

    public function testCode(Request $request){
        $key =User::join('emailkeys', 'emailkeys.user_id', '=', 'users.id')->where('users.id','=',Auth::id())->select('emailkeys.key')->first();
        if($key->key==$request['key']){

        }else{

        }

    }
}
