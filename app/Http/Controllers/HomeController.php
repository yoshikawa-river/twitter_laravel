<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
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
    public function index()
    {
        $user = \Auth::user();
        $post = new Post();
        $post = $post->fetchPost();
        return view('home', compact('user', 'post'));
    }

    public function home() 
    {
        $user = \Auth::user();
        $post = new Post();
        $post = $post->fetchPost();
        return view('home', compact('user', 'post'));
    }

    public function mypage() 
    {
        $user = \Auth::user();
        $post = new Post();
        $post = $post->fetchMyPost();
        return view('mypage', compact('user', 'post'));
    }

    public function edit_prof() 
    {
        $user = \Auth::user();
        return view('edit_prof', compact('user'));
    }

    public function prof_up(Request $request) 
    {
        $data = $request->all();
        $image = $request->file('image');

        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }

        $user->updateProfile($data, $path);
        return redirect()->route('mypage')->with('success', '更新しました！');
    }


    public function user_all() {
        $user = User::All();
        return view('user_all', compact('user'));
    } 

    public function mylike() 
    {
        $user = User::All();
        $post = new Post();
        $post = $post->combineLike() ;
        return view('mylike', compact('user', 'post'));
    }

    public function myreply() 
    {
        $user = \Auth::user();
        $post = Post::where('user_id', $user['id'])->orderBy('created_at', 'DESC')->get();
        return view('myreply', compact('user', 'post'));
    }

    public function post()
    {
        $user = \Auth::user();
        return view('post', compact('user'));
    }

    public function store(Request $request) 
    {
        $data = $request->all();
        $image = $request->file('image');

        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }

        $post = new Post();
        $post->userNewPost($post, $data, $path);

        return redirect()->route('home')->with('success', '投稿しました！');
    }

    public function edit($id) {
        $user = \Auth::User();
        $post = new Post();
        $post = $post->editMyPost($id);

        return view('edit', compact('post', 'user'));
    }

    // 画像がない時の分岐を書く必要あり
    // モデルへの移行は未完了 //////////////

    public function update(Request $request, $id) {
        $data = $request->all();
        Post::where('id', $id)->update(['content' => $data['content'], 'image' => $data['image']]);

        return redirect()->route('mypage')->with('success', '編集しました！');
    }

    public function delete(Request $request, $id) {
        $user = \Auth::User();
        $post = Post::where('id', $id)->where('user_id', $user->id)->delete();
        
        return redirect()->route('mypage')->with('success', '投稿を消しました！');
    }

    //////////////////////////////////////////////////////////

    public function user_page($id) 
    {
        $post = new Post();
        $post = $post->fetchUserPost($id); 
        $user = new User();
        $user = $user->getUserId($id);

        return view('user_page', compact('post', 'user'));
    }

    public function serch_screen() 
    {
        $user = \Auth::user();
        $post = new Post();
        $post = $post->fetchPost();
        $keyword = '';

        return view('serch_screen', compact('post', 'keyword'));
    }

    public function serch(Request $request) 
    {
        $keyword = $request->input('keyword');
        $post = new Post;
        // $post = Post::where('content', 'like', "%$keyword%")->orderBy('created_at', 'DESC')->get();
        $post = $post->serchWordFromPost($keyword);

        return view('serch_screen', compact('keyword', 'post'));
    }

    public function reply_page($id) 
    {
        $user = \Auth::User();
        $post = new Post();
        $post = $post->postPage($id);
        $reply = $post->allReplyToPost($id);

        return view('reply', compact('post', 'user', 'reply'));
    }

    public function reply(Request $request, $id) 
    {
        $data = $request->all();
        $image = $request->file('image');

        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }

        $post = new Post();
        $post->userNewReply($post, $data, $path, $id);

        return back()->with('success', 'リプライしたよ！');
    }
    
}
