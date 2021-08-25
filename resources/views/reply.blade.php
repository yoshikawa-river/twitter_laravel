@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header">新規投稿</div>
            <div class="card-body">

                      @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                      @endif
                <article>
                    <header>
                      <div>
                        <a href="{{route('user_page', $post->user->id )}}">{{ $post->user->name }}</a>
                        <p>{{ $post['updated_at']}}</p>
                        
                      </div>
                    </header>
                    <div>
                        <p>{{ $post['content'] }}</p>
                    </div>
                    @if ($post['image'] != null)
                      <img src="{{ '/storage/' . $post['image']}}" class='w-100 mb-3'/>
                    @endif
                    <div>
                        <div>                        
                          <div class="d-inline float-left">
	                        @if($post->checkdate($post))
                            <a href="{{route('nolike',$post) }}"><i class="fas fa-heart fa-2x heart_red"></i></a>
	                        @else
                            <a href="{{route('like',$post) }}"><i class="fas fa-heart fa-2x heart_gray"></i></a>
	                        @endif
	                        </div>
                          <div>{{ $post->like }}</div>
                        
                        </div>
                      <hr>
                    </div>
                </article>  
            </div>
                <div class="card-body">
                @foreach($reply AS $reply)
                  <article>
                    <header>
                      <div>
                        <a href="{{route('user_page', $reply->user->id )}}">{{ $reply->user->name }}</a>
                        <p>{{ $reply['updated_at']}}</p>
                      </div>
                    </header>
                    <div>
                        <p>{{ $reply['content'] }}</p>
                    </div>
                    @if ($reply['image'] != null)
                      <img src="{{ '/storage/' . $reply['image']}}" class='w-100 mb-3'/>
                    @endif
                      <div>
                        <div>                        
                          <div class="d-inline float-left">
                          @if($post->checkdate($reply))
                            <a href="{{route('nolike',$reply) }}"><i class="fas fa-heart fa-2x heart_red"></i></a>
	                        @else
                            <a href="{{route('like',$reply) }}"><i class="fas fa-heart fa-2x heart_gray"></i></a>
	                        @endif
                          </div> 
                          <!-- <div class="d-inline float-left">
	                        @if($post->checkreply($reply))
                            <a href="{{route('reply_page', $reply) }}"><i class="fas fa-reply fa-2x re_blue"></i></a>
	                        @else
                            <a href="{{route('reply_page', $reply) }}"><i class="fas fa-reply fa-2x heart_gray"></i></a>
	                        @endif
	                        </div> -->
                          <div>{{ $reply->like }}</div>
                        </div>
                      </div>
                      <hr>
                  </article>
                @endforeach
                </div>
                    <!-- <div>返信先<a href="{{route('user_page', $post->user->id)}}">{{$post->user->name}}</a>さん</div> -->
                    <form method='POST' action="{{ route('reply', $post ) }}" enctype="multipart/form-data">
                        <!-- <div>返信先<a href="{{route('user_page', $post->user->id)}}">{{$post->user->name}}</a>さん</div> -->
                      
                      <!-- <div class="form-group">送信先
                      <select class='form-control' name='reply_user'>
                      @foreach($user AS $user)
                        <option value="{{ $user['name'] }}" >{{$user['name']}}</option>
                      @endforeach
                      </select>さん
                      </div> -->
                      @csrf
                      <input type='hidden' name='user_id' value="{{ Auth::user()->id }}">
                      <input type='hidden' name='to_user' value="{{ $post['user_id'] }}">
                        <div class="form-group">
                          <textarea name='content' class="form-control"rows="2"></textarea>
                        </div>
                        <div>
                          <label for="image">画像登録</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <button type='submit' class="btn btn-primary btn-lg">送信</button>
                    </form>
          </div>
    </div>
</div>
@endsection