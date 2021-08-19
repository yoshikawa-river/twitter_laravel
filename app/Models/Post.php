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
        if ($like != null) {
            $is_like = true;
        };

        return $is_like;
    }
    
}
