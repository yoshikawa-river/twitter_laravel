<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Post $post)
    {
        $user = \Auth::user();
        $post = Post::orderBy('updated_at', 'DESC')->get();
        return view('home', compact('user', 'post'));
    }

    public function home(Post $post) 
    {
        $user = \Auth::user();
        $post = Post::orderBy('updated_at', 'DESC')->get();
        return view('home', compact('user', 'post'));
    }

    public function post()
    {
        // ログインしているユーザー情報をViewに渡す・
        $user = \Auth::user();
        // compactメソッドで渡す
        return view('post', compact('user'));
    }

    public function mypage() 
    {
        $user = \Auth::user();
        $post = Post::where('user_id', $user['id'])->orderBy('updated_at', 'DESC')->get();
        return view('mypage', compact('user', 'post'));

    }

    public function store(Request $request) {
        
        $data = $request->all();
        $user = \Auth::user();
        // 'image'はname属性で指定したもの
        // $image = $request->file('image');
        $image = $request->file('image');
        // dd($image);
        // 画像がアップロードされていれば、storageに保存
        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }

        $post_id = Post::insertGetId([ 
            'user_id' => $data['user_id'], 
            'content' => $data['content'],
            'like' => 0,
            'image' => $path[1],
            'status' => 1
        ]);

        return redirect()->route('home')->with('success', '投稿しました！');
    }
    
}
