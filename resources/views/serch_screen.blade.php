@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('検索') }}</div>

                <div class="col-sm-4" style="padding:10px 0; padding-left:5px;">
                  <form class="form-inline" action="{{route('serch')}}" method='GET'>
                  <div class="form-group">
                    <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="キーワードを入力">
                    <input type="submit" value="検索">
                  </div>
                  <!-- <a href="{{route('serch')}}" type="submit"><i class="fas fa-search"></i></a> -->
                  </form>
                </div>
            </div>

            @if ( count($post) === 0 )
                  <div class="alert alert-success" role="alert">
                    該当ワードはありません
                  </div>

            <br>
            @else
            <div class='card'>
            <div class="card-body">
                @foreach($post AS $post)
                @if($post->allreply($post) == false)
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
                @endif
                @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
