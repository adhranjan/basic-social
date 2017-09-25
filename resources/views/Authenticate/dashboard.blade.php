@extends('layout.master')
@section('title')
    Dashboard
@endsection

@section('section')
    @include('includes.header')
    <div class="row new-post" id="wholeBody" xmlns="http://www.w3.org/1999/html">
            <div class="col-md-8">
                <div class="col-md-offset-2">
                    <header>
                        <h3>Share your thoughts</h3>
                    </header>
                    <div class="form">
                        {!!  Form::open(array('route' => 'postCreatePost', 'enctype'=>'multipart/form-data'))!!}
                            <div class="form-group {{($errors->has('body')? 'has-error' : '')}}">
                                <textarea class="form-control" name="body" id="body" rows="5" placeholder="Share your thoughts................"></textarea>
                                <p class="text-danger">{{($errors->has('body')? 'Empty Post is not appreciated here.' : '')}}</p>
                            </div>
                        <div class="form-group has-error">
                            <label class="btn btn-default btn-file">
                                Post Picture <input type="file" name="post_image" style="display: none;">
                            </label> (Optional)
                            <p class="text-danger">{{($errors->has('post_image')? 'Invalid photo is not appreciated here.' : '')}}</p>
                        </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        {!!  Form::close()!!}
                    </div>
                    <br/>
                    @include('includes.message')
              </div>
                <div class="col-md-offset-2">
                    <h3>Today's Post</h3>
                    @foreach($posts as $post)
                        <article class="post" data-postid="{{$post->id}}">
                        <div class="panel panel-default">
                            <div class="panel-body"><div class="img_holder">
                                @if($post->img_name!=null)
                                    <img src="post_image/{{$post->img_name}}" width="60px" height="30px">
                                @endif
                                    <p class="small">{{$post->user->fullname}}</p>
                                </div><div class="body_holder">{{$post->body}}</div>
                                <button class="showHide fa fa-plus btn pull-right">
                                </button>
                            </div>
                            <div class="panel-footer" id="underStatus{{$post->id}}" style="display:none">
                                    <div class="interaction" id="target" data-postid="{{$post->user->fullname}}">
                                        <?php $like = DB::table('likes')->wherePost_id($post->id)->whereLike("true")->count();?>
                                        <?php $dislike = DB::table('likes')->wherePost_id($post->id)->whereLike("false")->count();?>
                                        @if($post->user_id==Auth::User()->id)
                                            <i class='fa fa-thumbs-up'></i> {{$like}} |
                                                <i class='fa fa-thumbs-down'></i> {{$dislike}}
                                                <br/>
                                                <a href="#" class="edit">Edit</a>
                                        <a href="{{ route('delete', $post->id )}}"><button type="button" class="btn btn-danger btn-sm" >Delete</button></a>
                                            <div class="comments{{$post->id}}">
                                                <?php  $comments = DB::table('comments')->wherePost_id($post->id)->get(); ?>
                                                <?php $x=1 ?>
                                                @foreach($comments as $comment)
                                                        <div class="panel-body" data-commentid="{{$comment->id}}">
                                                            <?php  $comment_by = DB::table('users')->whereId($comment->user_id)->first(); ?>
                                                            <span class="comment_by"> {{
                                                              $comment_by->fullname
                                                         }}: </span>
                                                          <span class="comment_body">
                                                        {!!
                                                        $comment->comment_body
                                                         !!}
                                                          </span>
                                                                <br/>
                                                                <?php  $reply = DB::table('comment_replies')->whereComment_id($comment->id)->first(); ?>
                                                                @if($reply)
                                                                <span class="reply_by">
                                                                    You:
                                                               </span>
                                                              <span class="reply_body">
                                                                    {{$reply->replyBody}}
                                                              </span>
                                                                @else
                                                                    <div  id="replybox{{$x}}" data-replybox="{{$x}}" >
                                                                        <input type="text" class="form-control replyComment" placeholder="reply">
                                                                    </div>
                                                                    <?php $x++ ?>
                                                                 @endif
                                                        </div>
                                                @endforeach
                                            </div>
                                        @else
                                            {!!
                                            Auth::User()->likes->where('post_id',$post->id)->first() ? Auth::User()->likes->where('post_id',$post->id)->first()->like=="true" ?
                                            "<a href='#' class='fa fa-thumbs-up like' id='up$post->id'></a>" : "<a href='#' class='fa fa-thumbs-o-up like' id='up$post->id'></a>" : "<a href='#' class='fa fa-thumbs-o-up like' id='up$post->id'></a>"
                                            !!}
                                            <span id="likesamount{{$post->id}}">{{$like}}</span> |
                                            {!!
                                              Auth::User()->likes->where('post_id',$post->id)->first() ? Auth::User()->likes->where('post_id',$post->id)->first()->like=="false" ?
                                               "<a href='#' class='fa fa-thumbs-down like' id='down$post->id'></a>" : "<a href='#' class='fa fa-thumbs-o-down like' id='down$post->id'></a>" : "<a href='#' class='fa fa-thumbs-o-down like' id='down$post->id'></a>"
                                             !!}
                                            <span id="dislikesamount{{$post->id}}">{{$dislike}}</span>
                                            <div class="comments{{$post->id}}">
                                              <?php  $comments = DB::table('comments')->wherePost_id($post->id)->get(); ?>
                                                    @foreach($comments as $comment)
                                                      <div class="panel-body">
                                                          <?php  $comment_by = DB::table('users')->whereId($comment->user_id)->first(); ?>
                                                         <span class="comment_by">
                                                              {{ $comment_by->fullname }}
                                                         : </span>
                                                          <span class="comment_body">
                                                        {!!
                                                        $comment->comment_body
                                                         !!}
                                                          </span>
                                                              <br/>
                                                              <?php  $reply = DB::table('comment_replies')->whereComment_id($comment->id)->first(); ?>
                                                              @if($reply)
                                                                  <span class="reply_by">
                                                                      {{$post->user->fullname}}
                                                                   </span>
                                                                  <span class="reply_body">
                                                                    {{$reply->replyBody}}
                                                              </span>
                                                              @endif
                                                      </div>
                                                  @endforeach
                                            </div>
                                              <input type="text" class="form-control commentInput" placeholder="write a comment" id="inputComment{{$post->id}}">
                                        @endif
                                    </div>
                            </div>
                        </div>
                        </article>
                    @endforeach
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
