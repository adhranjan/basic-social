@extends('layout.master')
@section('title')
    Dashboard
@endsection

@section('section')
    @include('includes.header')
    <div class="row new-post" xmlns="http://www.w3.org/1999/html">
            <div class="col-md-8">
                <div class="col-md-offset-2">
                    <header>
                        <h3>My Profile</h3>
                    </header>
                    <div class="form">
                        {!!Form::model($profile,['route'=>['postUpdateProfile','id'=>$profile->id],'method'=>'put','class'=>'form-horizontal'])!!}
                        <div class="form-group {{($errors->has('email')? 'has-error' : '')}}">
                            <label for="email">Email address:</label>
                            <input type="email" disabled="disabled" name="email" value="{{$profile->fullname}}" class="form-control" id="email {{($errors->has('email')? 'inputError' : '')}}">
                        </div>
                        <div class="form-group {{($errors->has('fullname')? 'has-error' : '')}}">
                                <label for="fullname">Full Name:</label>
                                <input type="text" name="fullname" value="{{$profile->fullname}}" class="form-control" id="fullname">
                            </div>
                            <div class="form-group {{($errors->has('password')? 'has-error' : '')}}">
                                <label for="pwd">Password:</label>
                                <input type="password" name="password" class="form-control" id="pwd">
                            </div>
                            <div class="form-group editabletext">
                                <label for="pwd">Confirm Password:</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation ">
                            </div>
                        <br/>
                        <br/>
                        <button type="submit" class="btn btn-primary">Update</button>
                        {!!  Form::close()!!}
                    </div>
                    <br/>
                    @include('includes.message')
              </div>
            </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="post-body">
                                <textarea class="form-control" name="post-body" id="post-body" style="margin: 0px -23px 0px 0px; max-width: 570px; width: 575px; height: 97px;"></textarea>
                            </label>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        var token='{{Session::token()}}}';
        var url='{{route('edit')}}';
    </script>
@endsection
