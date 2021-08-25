@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">みんなの投稿</div>

                @if (session('success'))
                  <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                  </div>
                @endif

                
                @foreach($post AS $post)
                @if ($post->checkreply($post))
                <div class="card-body">
                 
                
                    <article>
                    
                    <header>
                      <div>
                        <a href="{{route('user_page', $post->user_id )}}">{{  $user[$post->user_id - 1]->name  }}</a>
                        
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

                          <div class="d-inline float-left">
	                        @if($post->checkreply($post))
                          <a href="{{route('reply_page', $post) }}"><i class="fas fa-reply fa-2x re_blue"></i></a>
	                        @else
                          <a href="{{route('reply_page', $post) }}"><i class="fas fa-reply fa-2x heart_gray"></i></a>
	                        @endif
	                        </div>

                        <div>{{ $post->countreply($post) }}</div>
                        
                        </div>
                      <hr>
                    </div>

                    </article>
                  
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
