@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイページ</div>

                <div class="card-body">

                  <article>
                    <header>
                    <img src="{{ '/storage/' . $user['prof_img']}}" class='w-1 mb-3'/>
                      <div>
                      <h1>{{ $user->name }}</h1>
                      <h2>{{ $user->comment }}</h2>
                      </div>
                    </header>
                    <a href="{{route('edit_prof') }}"><i class="fas fa-2x fa-edit"></i></a>
                  </article>
                  <hr>
                </div>

                @foreach($post AS $post)
                @if($post->allreply($post) == false)
                <div class="card-body">
                  <article>
                    <header>
                    <a href="{{route('edit', $post) }}"><i class="fas fa-2x fa-edit"></i></a>
                      <div>
                        {{$user['name']}}
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

                        <!-- <a href="{{route('edit', $post) }}"><i class="fas fa-edit"></i></a> -->
                        
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
