@extends('layout.master')

@section('title')
    Register
@endsection
@section('section')
    <div class="row">
        <div class="col-md-6">
            <h1> REGISTER </h1>
           {!! Form::open(array('route' => 'postSignUp'))!!}
                <div class="form-group {{($errors->has('fullname')? 'has-error' : '')}}">
                    <label for="fullname">Full Name:</label>
                    <input type="text" name="fullname" value="{{old('fullname')}}" class="form-control" id="fullname">
                    <p class="text-danger">{{($errors->has('fullname')? $errors->first('fullname') : '')}}</p>
                </div>
                <div class="form-group {{($errors->has('email')? 'has-error' : '')}}">
                    <label for="email">Email address:</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email {{($errors->has('email')? 'inputError' : '')}}">
                    <p class="text-danger">{{($errors->has('email')? $errors->first('email') : '')}}</p>
                </div>
                <div class="form-group {{($errors->has('password')? 'has-error' : '')}}">
                    <label for="pwd">Password:</label>
                    <input type="password" name="password" class="form-control" id="pwd">
                    <p class="text-danger">{{($errors->has('password')? $errors->first('password') : '')}}</p>
                </div>
                <div class="form-group">
                    <label for="pwd">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation ">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            {!!  Form::close()!!}
            <br/>
            <a href="login"><button class="btn btn-primary">Old User</button></a>
        </div>
    </div>
@endsection
