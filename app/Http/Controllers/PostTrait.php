<?php

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


trait PostTrait {




    public function getThePost($id)
    {
        $post = Post::find($id);

        $like = DB::table('likes')->wherePost_id($post->id)->whereLike("true")->count();
        $dislike = DB::table('likes')->wherePost_id($post->id)->whereLike("false")->count();

        $html = '<article class="post" id="post_'.$post->id.'"  data-postid="'.$post->id.'">';
        $html .= '<div class="panel panel-default">';
        $html .= '<div class="panel-body"><div class="img_holder">';

        if($post->img_name!=null){
            $html .= '<img src="post_image/'.$post->img_name.'" width="60px" height="30px">';
        }

        $html .= '<p class="small">'.$post->user->fullname.'</p>';
        $html .= '</div><div class="body_holder">'.$post->body.'</div>
                                <button class="showHide fa fa-plus btn pull-right">
                                </button>
                            </div>';
        $html .='<div class="panel-footer" id="underStatus'.$post->id.'" style="">
                                    <div class="interaction" id="target" data-postid="'.$post->user->fullname.'">';

                  if($post->user_id==Auth::User()->id){

                      $html .= '<i class="fa fa-thumbs-up"></i>'.$like.' | <i class="fa fa-thumbs-down"></i>'.$dislike.'<br/>';
                      $html .= '<a href="#" class="edit">Edit</a>';
                      $html .= '<a href="'.route('delete', $post->id ).'"><button type="button" class="btn btn-danger btn-sm" >Delete</button></a>';
                      $html .=  '<div class="comments'.$post->id.'">';
                      $comments = DB::table('comments')->wherePost_id($post->id)->get();
                      $x=1;
                      foreach ($comments as $comment){
                         $html .= '<div class="panel-body" data-commentid="'.$comment->id.'">';
                         $comment_by = DB::table('users')->whereId($comment->user_id)->first();
                         $html .= '<span class="comment_by">'.$comment_by->fullname .': </span>';

                         $html .= '<span class="comment_body">'.$comment->comment_body.'</span>';
                         $html .='<br/>';

                         $reply = DB::table('comment_replies')->whereComment_id($comment->id)->first();

                         if($reply){
                             $html .= '<span class="reply_by"> You: </span><span class="reply_body">';
                             $html .= $reply->replyBody;
                             $html .= '</span>';
                          }else{
                            $html .= '<div  id="replybox'.$x.'" data-replybox="'.$x.'" >';
                            $html .= '<input type="text" class="form-control replyComment" placeholder="reply"></div>';
                            $x++;
                          }

                          $html .= '</div>';
                    }
                        $html .= '</div>';
                  }else{
                        $html .= Auth::User()->likes->where('post_id',$post->id)->first() ? Auth::User()->likes->where('post_id',$post->id)->first()->like=="true" ?"<a href='#' class='fa fa-thumbs-up like' id='up$post->id'></a>" : "<a href='#' class='fa fa-thumbs-o-up like' id='up$post->id'></a>" : "<a href='#' class='fa fa-thumbs-o-up like' id='up$post->id'></a>";
                        $html .= '<span id="likesamount'.$post->id.'">'.$like.'</span> |';

                        $html .= Auth::User()->likes->where('post_id',$post->id)->first() ? Auth::User()->likes->where('post_id',$post->id)->first()->like=="false" ?"<a href='#' class='fa fa-thumbs-down like' id='down$post->id'></a>" : "<a href='#' class='fa fa-thumbs-o-down like' id='down$post->id'></a>" : "<a href='#' class='fa fa-thumbs-o-down like' id='down$post->id'></a>";
                        $html .= '<span id="dislikesamount'.$post->id.'">{{$dislike}}</span>';
                        $html .= '<div class="comments'.$post->id.'">';
                        $comments = DB::table('comments')->wherePost_id($post->id)->get();

                        foreach($comments as $comment){
                        $html .='<div class="panel-body">';
                        $comment_by = DB::table('users')->whereId($comment->user_id)->first();
                        $html .= '<span class="comment_by">';
                        $html .= $comment_by->fullname;
                        $html .= ': </span><span class="comment_body">';
                        $html .= $comment->comment_body;
                        $html .='</span><br/>';
                        $reply = DB::table('comment_replies')->whereComment_id($comment->id)->first();
                        if($reply){
                        $html .= '<span class="reply_by">'.$post->user->fullname.'</span><span class="reply_body">';
                        $html .=$reply->replyBody;
                        $html .= '</span>';
                        }
                        $html .='</div>';

                        }
                        $html .= '</div><input type="text" class="form-control commentInput" placeholder="write a comment" id="inputComment'.$post->id.'">';
                }

        $html .= '</div></div></div></article>';
    return $html;
    }
}
