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

                <div class="card-body">
                @foreach($post AS $post)
                  <article>
                    <header>
                      <div>
                        {{ $post->user->name }}
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
                        
                        <button class='p-1 mr-10' style='border:none;'><i class="fas fa-reply"></i></button>
                        <button class='p-1 mr-0' style='border:none;'><i class="far fa-comment"></i></button>
                        <span>
                          <button class='p-1 mr-0' style='border:none;'><i class="fas fa-tag"></i></button>
                        </span>
                        </div>
                      <hr>
                    </div>

                  </article>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
