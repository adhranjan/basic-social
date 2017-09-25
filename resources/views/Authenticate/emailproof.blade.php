@extends('layout.master')
@section('title')
    Proof
@endsection

@section('section')
    @include('includes.header')
    <div class="row new-post" id="wholeBody" xmlns="http://www.w3.org/1999/html">
            <div class="col-md-8">
                <div class="col-md-offset-2">
                    <header>
                        <h4>Code we sent</h4>
                    </header>
                    <div class="form">
                        {!!  Form::open(array('route' => 'emailverification'))!!}
                            <div class="form-group {{($errors->has('body')? 'has-error' : '')}}">
                                <input type="email" disabled="disabled" name="email" value="{{$email}}" class="form-control" id="email">
                            </div>
                        <div class="form-group {{($errors->has('key')? 'has-error' : '')}}">
                            <input type="text"  name="key" value="{{old('key')}}" class="form-control" id="key">
                        </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        {!!  Form::close()!!}
                    </div>
                    <br/>
                    @include('includes.message')
              </div>

            </div>
    </div>
    <div class="row connectionlessTimer" style="display:none;">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <button class="btn btn-warning btn-sm">Reconnect</button>
        </div>
        <div class="col-md-4"></div>
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
        var urlEdit='{{route('edit')}}';
        var urlLike='{{route('like')}}';
        var urlComment='{{route('comment')}}';
        var urlCommentreply='{{route('commentreply')}}';
        var urlConnection='{{route('connection')}}';
    </script>
@endsection
