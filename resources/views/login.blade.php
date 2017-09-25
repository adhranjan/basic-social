@extends('layout.master')

@section('title')
    Login
@endsection
@section('section')
    <div class="row">
        <div class="col-md-6">
            <h1> Login </h1>
            {!!  Form::open(array('route' => 'postSignIn'))!!}
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" name="password" class="form-control" id="pwd">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>

            {!!  Form::close()!!}
            <br/>
            <a href="register"><button href="#" class="btn btn-primary">New User</button></a>

        </div>

    </div>
@endsection