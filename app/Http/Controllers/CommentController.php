<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;

class CommentController extends Controller
{
    public function postComment(Request $request, Comment $comment){
        if(Comment::create(
            [
                'user_id' => Auth::User()->id,
                'post_id' => $request->get('postId'),
                'comment_body' => $request->get('comment_body')
            ])){
            $comments = $comment->leftjoin('users','users.id','=','comments.user_id')->leftjoin('comment_replies','comment_replies.comment_id','=','comments.id')->where('comments.post_id',$request->get('postId'))->distinct()->get(['comments.id','comment_body','fullname','replyBody']);
            return response()->json(['commentshere'=>$comments],200);
        }
    }
}
