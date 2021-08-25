<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Auth;
use App\Models\Like;
use App\Models\User;

class Reply extends Model
{
    // use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
 
    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function checkdate($reply) {
        $is_like = false;
        $user = Auth::user();
        $like = new Like;
        $like = Like::where('reply_id', $reply['id'])->where('user_id', $user['id'])->first();
        if ($like != null) {
            $is_like = true;
        };

        return $is_like;
    }

    // public function checkdate($reply) {
    //     $count = 0;
    //     $_reply = Reply::where('post_id', $post_id);
    //     $like = new Like;
    //     $like = Like::where('reply_id', $reply['id'])->where('user_id', $user['id'])->first();
    //     if ($like != null) {
    //         $is_like = true;
    //     };

    //     return $count;
    // }


}
