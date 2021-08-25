<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Auth;
use App\Models\Like;

class Post extends Model
{
    // use HasFactory;

    public function user()
    {
        
        return $this->belongsTo(User::class);
    }
 
    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function checkdate($post) {
        $is_like = false;
        $user = Auth::user();
        $like = new Like;
        $like = Like::where('post_id', $post['id'])->where('user_id', $user['id'])->first();
        // dd($like);
        if ($like != null) {
            $is_like = true;
        };

        // dd($post);

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
