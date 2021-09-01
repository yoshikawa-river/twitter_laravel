<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Auth;
use App\Models\Like;

class Post extends Model
{
    public function user()
    {   
        return $this->belongsTo(User::class);
    }
 
    public function likes() 
    {
        return $this->hasMany(Like::class);
    }

    public function fetchPost () 
    {
        $post = Post::orderBy('created_at', 'DESC')->get();
        return $post;  
    }

    public function fetchMyPost () 
    {
        $user = Auth::user();
        $post = Post::where('user_id', $user['id'])->orderBy('created_at', 'DESC')->get();
        return $post;  
    }

    public function fetchUserPost ($id)
    {
        $post = Post::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        return $post;
    }

    public function combineLike()
    {
        $user = \Auth::user();
        $post = Post::select('posts.id as id', 'posts.user_id as user_id', 'content', 'posts.updated_at', 'image', 'posts.reply_id', 'like', 'status', 'posts.created_at')
        ->join('likes', 'posts.id', '=', 'likes.post_id')
        ->where('likes.user_id', $user['id'])
        ->orderBy('likes.created_at', 'DESC')
        ->get();

        return $post;
    }

    public function userNewPost($post, $data, $path)
    {
        $post->user_id = $data['user_id'];
        $post->content = $data['content'];
        $post->image = $path[1];
        $post->like = 0;
        $post->status = 1;
        $post->save();
    }

    public function editMyPost($id)
    {
        $user = \Auth::User();
        $post = Post::where('id', $id)->where('user_id', $user['id'])->first();
        return $post;
    }

    public function serchWordFromPost($keyword)
    {
        $post = Post::where('content', 'like', "%$keyword%")->orderBy('created_at', 'DESC')->get();
        return $post;
    }

    public function PostPage($id)
    {
        $post = Post::where('id', $id)->first();
        return $post;
    }

    public function allReplyToPost($id) {
        $reply = Post::where('reply_id', $id)->orderBy('created_at', 'ASC')->get();
        return $reply;
    }

    public function userNewReply($post, $data, $path, $id)
    {
        $post->user_id = $data['user_id'];
        $post->content = $data['content'];
        $post->image = $path[1];
        $post->reply_id = $id;
        $post->like = 0;
        $post->status = 1;
        $post->save();
    }

    public function checkdate($post) 
    {
        $is_like = false;
        $user = Auth::user();
        $like = new Like;
        $like = Like::where('post_id', $post['id'])->where('user_id', $user['id'])->first();
        if ($like != null) {
            $is_like = true;
        };

        return $is_like;
    }

    public function checkreply($post) {
        $is_reply = false;
        $user = Auth::user();
        $reply = Post::where('reply_id', $post['id'])->where('user_id', $user['id'])->first();
        if ($reply != null) {
            $is_reply = true;
            // dd($is_reply);
        };

        return $is_reply;
    }

    public function countreply($post) {
        $reply = Post::where('reply_id', $post['id'])->get();
        $reply = count($reply);
        return $reply;
    }

    public function allreply($post) {
        $is_reply = false;
        if ($post->reply_id != null) {
            $is_reply = true;
        };
        return $is_reply;
    }

    public function reply_user($post) {
        $is_user = false;
        if ($post->reply_id != null) {
            $is_reply = true;
        };
        return $is_reply;
    }

    // public function 



    // public function replies() 
    // { 
    //    return $this->hasMany(Reply::class);
    // }
    
}
