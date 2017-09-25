<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ConnectionController extends Controller
{
    public function index(){
        return response()->json(['connected'=>'true'],200);
    }
}
