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
    public function index(Post $post)
    {
        $user = \Auth::user();
        $post = Post::orderBy('created_at', 'DESC')->get();
        return view('home', compact('user', 'post'));
    }

    public function home(Post $post) 
    {
        $user = \Auth::user();
        $post = Post::orderBy('created_at', 'DESC')->get();
        return view('home', compact('user', 'post'));
    }

    public function mypage() 
    {
        $user = \Auth::user();
        $post = Post::where('user_id', $user['id'])->orderBy('created_at', 'DESC')->get();
        // dd($user['comment']);
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
        // dd($data);
        $user = \Auth::user();
        // dd($user->name);

        $image = $request->file('image');

        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }

        // dd($data['comment']);

        $user->name = $data['name'];
        $user->prof_img = $path[1];
        $user->comment = $data['comment'];
        $user->save();

        // dd($user->comment);

        return redirect()->route('mypage')->with('success', '更新しました！');
    }


    public function user_all() {
        $user = User::All();
        
        return view('user_all', compact('user'));
    } 

    public function mylike() 
    {
        $user = \Auth::user();

        $post = Post::select('posts.id as id', 'posts.user_id as user_id', 'content', 'posts.updated_at', 'image', 'posts.reply_id', 'like', 'status', 'posts.created_at')
        ->join('likes', 'posts.id', '=', 'likes.post_id')
        ->where('likes.user_id', $user['id'])
        ->orderBy('likes.created_at', 'DESC')
        ->get();
        // $user = User::where('id', )->first();
        // dd($post);
        $user = User::All();

        return view('mylike', compact('user', 'post'));
    }

    public function myreply() 
    {
        $user = \Auth::user();
        $post = Post::where('user_id', $user['id'])->orderBy('created_at', 'DESC')->get();
        // dd($post);
        return view('myreply', compact('user', 'post'));
    }

    public function post()
    {
        // ログインしているユーザー情報をViewに渡す・
        $user = \Auth::user();
        // compactメソッドで渡す
        return view('post', compact('user'));
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

    public function edit($id) {
        $user = \Auth::User();
        $post = Post::where('id', $id)->where('user_id', $user['id'])->first();

        return view('edit', compact('post', 'user'));
    }

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

    public function user_page($id) {
        $post = Post::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        
        $user = User::where('id', $id)->first();
        // $user_name = $user->name;

        return view('user_page', compact('post', 'user'));
    }

    public function serch_screen() {

        $post = new Post;
        $user = \Auth::user();
        $post = Post::orderBy('created_at', 'DESC')->get();
        $keyword = '';

        return view('serch_screen', compact('post', 'keyword'));
    }

    public function serch(Request $request) {
        // dd($request);
        $keyword = $request->input('keyword');
        $post = new Post;
        $post = Post::where('content', 'like', "%$keyword%")->orderBy('created_at', 'DESC')->get();

        return view('serch_screen', compact('keyword', 'post'));
    }

    public function reply_page($id) {
        $user = \Auth::User();
        $post = Post::where('id', $id)->first();
        // dd($post);
        $reply = Post::where('reply_id', $id)->orderBy('created_at', 'ASC')->get();

        // $reply = Post::where('reply_id', $id)->orderBy('created_at', 'ASC')->first();
        // dd($reply);
        // if ()
        // $user = User::select('name', $reply['reply_user'])->first();
        // dd($user->reply_user);
        // $user = User::All();
        
        return view('reply', compact('post', 'user', 'reply'));
    }

    public function reply(Request $request, $id) {

        $data = $request->all();
        // dd($data['user_id']);
        $user = \Auth::user();
        $image = $request->file('image');
        $post = Post::where('id', $id)->first();
        // dd($image);
        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }
        // dd($data['reply_user']);/

        $post_id = Post::insertGetId([ 
            'content' => $data['content'],
            'image' => $path[1],
            'user_id' => $data['user_id'], 
            'reply_id' => $id,
            'like' => 0,
            'status' => 1,
        ]);
        // dd($post['reply_user']);
        // dd($post_id->reply_user);
        // $reply_id = Reply::insertGetId([ 
        //     'content' => $data['content'],
        //     'image' => $path[1],
        //     'user_id' => $data['user_id'], 
        //     'post_id' => $id,
        //     'likes' => 0,
        // ]);

        return back()->with('success', 'リプライしたよ！');
    }
    
}
