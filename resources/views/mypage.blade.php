@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイページ</div>

                <div class="card-body">
                @foreach($post AS $post)
                  <article>
                    <header>
                      <div>
                        {{$user['name']}}
                        <p>{{ $post['updated_at']}}</p>
                      </div>
                    </header>
                    <div>
                        <p>{{ $post['content'] }}</p>
                    </div>
                    <img src="{{ '/storage/' . $post['image']}}" class='w-100 mb-3'/>
                    <div>
                      <div>
                        <button class='p-1 mr-0' style='border:none;'><i class="far fa-heart"></i></button>
                        <button class='p-1 mr-0' style='border:none;'><i class="fas fa-reply"></i></button>
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
