@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">プロフィール編集</div>


                <div class="card-body">
                  <article>
                    <header>
                      <img src="{{ '/storage/' . $user['prof_img']}}" class='w-1 mb-3'/>
                      <h1>
                      <a href="{{route('user_page', $user->id )}}">{{ $user->name }}</a>
                      </h1>
                      <h2>{{ $user->comment }}</h2>
                    </header>
                  </article>
                
                <hr>



              <form method='POST' action="{{ route('prof_up', ['id' => $user['id'] ] ) }}" enctype="multipart/form-data">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">

                <div class="form-group">
                <label >名前編集</label>
                    <textarea name='name' class="form-control"rows="1" ></textarea>
                </div>
                <br>
                <div>
                <label >コメント編集</label>
                  <textarea name='comment' class="form-control"rows="3" ></textarea>
                </div>
                <br>

                <div>
                  <label for="image">プロフィール画像登録</label>
                  <input type="file" class="form-control-file" id="image" name="image">
                </div>

                <button type='submit' class="btn btn-primary btn-lg">更新</button>
              </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
