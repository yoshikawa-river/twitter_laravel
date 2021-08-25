@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー一覧</div>

                
                @foreach($user AS $user)
                <div class="card-body">
                  <article>
                    <header>
                      <img src="{{ '/storage/' . $user['prof_img']}}" class='w-10 mb-3'/>
                      <h1>
                      <a href="{{route('user_page', $user->id )}}">{{ $user->name }}</a>
                      </h1>
                      <h2>{{$user->comment}}</h2>
                    </header>
                  </article>
                  </div>
                  <hr>
                @endforeach
                
            </div>
        </div>
    </div>
</div>
@endsection
