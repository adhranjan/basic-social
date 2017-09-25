<?php

namespace App\Http\Controllers;

use App\Emailkey;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use Auth;

class UserController extends Controller
{
    public function postSignUp(RegisterRequest $registerRequest){
        Auth::login(User::create(
            ['fullname' => $registerRequest->get('fullname'),
                'email' => $registerRequest->get('email'),
                'password' => bcrypt($registerRequest->get('password'))
            ]));
        (Emailkey::create(
            ['user_id' => Auth::id(),
                'key' => str_random(4)
            ]));
        return redirect()->route('dashboard');
    }

    public function profile(){
        $user=User::where('id','=',Auth::USER()->id)->first();
        return view('Authenticate/profile')->with('profile',$user);
    }

    public function postUpdateProfile(RegisterRequest $request,$id){
       $user=Auth::user();
        if($id!=$user->id){
                return redirect()->back();
        }else{
            $user->fullname=$request['fullname'];
            $user->password=$request['password'];
            $user->update();
            return redirect()->back();

        }
    }
    public function postSignIn(LoginRequest $request){
       if( Auth::attempt(
           [
               'email'=>$request['email'],
               'password'=>$request['password']
           ]
       )){
           return redirect()->route('dashboard');
       }else{
           return redirect()->back()->with('email',$request['email']);
       }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}
