<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['auth']], function () {


    Route::get('/get_post',[
        'as'=>'get_post',
        'uses'=>'PostController@index',
    ]);
    Route::get('/dashboard',[
        'as'=>'dashboard',
        'uses'=>'PostController@dashboard',
    ]);
    Route::post('/postCreatePost',[
        'as'=>'postCreatePost',
        'uses'=>'PostController@postCreatePost',
    ]);
    Route::get('/edit',[
        'as'=>'edit',
        'uses'=>'PostController@edit']);

    Route::get('/like',[
        'as'=>'like',
        'uses'=>'PostController@like']);

    Route::get('/commentreply',[
        'as'=>'commentreply',
        'uses'=>'CommentreplyController@index']);

    Route::get('/profile',[
        'as'=>'viewprofile',
        'uses'=>'UserController@profile',
    ]);

    Route::get('/connection',[
        'as'=>'connection',
        'uses'=>'ConnectionController@index',
    ]);

    Route::get('/postComment',[
        'as'=>'comment',
        'uses'=>'CommentController@postComment',
    ]);


    Route::put('/postUpdateProfile/{id}',[
        'as'=>'postUpdateProfile',
        'uses'=>'UserController@postUpdateProfile',
    ]);

    Route::get('/delete/{id}',[
        'as'=>'delete',
        'uses'=>'PostController @deletePost',
    ]);


    Route::get('logout',[
        'as'=>'logout',
        'uses'=>'UserController@logout',
    ]);

    Route::get('/verify',[
        'as'=>'emailproof',
        'uses'=>'Verification@emailproof',
    ]);
    Route::post('/verification',[
        'as'=>'emailverification',
        'uses'=>'Verification@testCode',
    ]);


});



Route::get('/register', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login');
});
Route::get('/', function () {
    return view('login');
});
Route::post('/postSignUp',[
    'uses'=>'UserController@postSignUp',    
    'as'=>'postSignUp'
]);
Route::post('/postSignIn',[
    'uses'=>'UserController@postSignIn',
    'as'=>'postSignIn'
]);


