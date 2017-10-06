<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use File;
use Carbon\Carbon;


class PostController extends Controller
{
    use PostTrait;

    public function index(Request $request)
    {
        $id =$request->id;
        $postHtml = $this->getThePost($id);
        return $postHtml;
    }

    public function postCreatePost(PostRequest $postRequest){
        if(Post::create([
            'body' => $postRequest->get('body'),
            'user_id'=>Auth::User()->id
        ])){
            $id=DB::getPdo()->lastInsertId();
            $post=Post::where('id','=',$id)->first();
            $file = Input::file('post_image');
            if($file){
                $filename = $id."_".$file->getClientOriginalName();
                $destinationPath = base_path() . '/public/post_image/';

                $file->move($destinationPath, $filename);
                $post->img_name=$filename;
                $post->Update();
            }

            $data['post'] = $this->getThePost($id);
            $this->pusher->trigger('my-channel', 'my-event', $data);
            $message="Post created successfully. Wait till somebody responds you.";
            $status='success';
        }else{
            $message="Failed Making post.";
            $status='fail';
        }
        return redirect('/dashboard')->with($status, $message);
    }
    public function dashboard(){
        $posts=Post::orderBy('id', 'asc')->get();
        DB::table('posts')->where('created_at','<',Carbon::today()->toDateString())->delete();
        return view('Authenticate/dashboard',['posts'=>$posts]);
    }

    public function edit(PostRequest $request){
        $post=Post::where('id','=',$request['postId'])->first();
        $post->body=$request['body'];
        $post->Update();
        return response()->json(['new_body'=>$post->body],200);
    }
    public function deletePost($id){
        $post=Post::where('id','=',$id)->first();
        if(Auth::USER()->id!=$post->user_id){
            return redirect()->back();
        }
        if(DB::table('posts')->where('id', $id)->delete()){
            if($post->img_name!=null){
                File::delete(base_path() . '/public/post_image/'.$post->img_name);
            }
        }
        $message="Post Deleted. Sorry nobody will get to see it.";
        $status='success';
        return redirect('/dashboard')->with($status, $message);
    }

    public function like(Request $request, Like $like){
        $post_id=$request['postId'];
        $isLike=$request['isLike'];
        $thePost = $like->whereUser_id(Auth::User()->id)->wherePost_id($post_id)->get();
        $count=count($thePost);

        if($count==0){
            Like::create(
                [
                    'user_id' => Auth::User()->id,
                    'post_id' => $request->get('postId'),
                    'like' => $request->get('isLike')
                ]);
            $totalLikes=count($like->wherePost_id($post_id)->whereLike("true")->get());
            $totalDisLikes=count($like->wherePost_id($post_id)->whereLike("false")->get());
            return response()->json(['insert'=>$isLike,'likes'=>$totalLikes,'dislike'=>$totalDisLikes],200);
        }else{
            $user=Auth::User();
            $like=$user->likes()->where('post_id',$post_id)->first();
            $lastEntry=$like->like;
            if($lastEntry==$isLike){
                $like->delete();
                $totalLikes=count($like->wherePost_id($post_id)->whereLike("true")->get());
                $totalDisLikes=count($like->wherePost_id($post_id)->whereLike("false")->get());
                return response()->json(['delete'=>$isLike,'likes'=>$totalLikes,'dislike'=>$totalDisLikes],200);
            }else{
                $like->like=$isLike;
                $like->update();
                $totalLikes=count($like->wherePost_id($post_id)->whereLike("true")->get());
                $totalDisLikes=count($like->wherePost_id($post_id)->whereLike("false")->get());
                return response()->json(['update'=>$isLike,'likes'=>$totalLikes,'dislike'=>$totalDisLikes],200);
            }
        }
    }

}
