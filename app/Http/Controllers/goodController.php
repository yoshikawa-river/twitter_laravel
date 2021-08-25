<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class goodController extends Controller
{
    public function like(Post $post, Request $request){
        $like = New Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::user()->id;
        $like->save();

        $_post = Post::where('id', $post->id)->first();
        $_post->like += 1;
        $_post->update();

        return back()->with('success', 'いいね！');
    }

    public function nolike(Post $post, Request $request){
        $user = Auth::user()->id;
        $like = like::where('post_id', $post->id)->where('user_id', $user)->delete();

        $_post = Post::where('id', $post->id)->first();
        $_post->like -= 1;
        $_post->update();

        return back()->with('success', 'いいね消したよ！');
    }

    

    
}
