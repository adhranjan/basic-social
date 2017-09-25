<?php

namespace App\Http\Controllers;

use App\Commentreply;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class CommentReplyController extends Controller
{
    public function index(Request $request, Commentreply $commentReply){
        if(Commentreply::create(
            [
                'user_id' => Auth::User()->id,
                'post_id' => $request->get('postId'),
                'comment_id' => $request->get('commentId'),
                'replyBody' => $request->get('replyBody')
            ])){
            $commentReplys = $commentReply->join('users', 'users.id', '=', 'comment_replies.user_id')->where('comment_id',$request->get('commentId'))->get(['comment_replies.id','replyBody','fullname']);
            return response()->json(['commentreplyshere'=>$commentReplys],200);
        }
    }
}
