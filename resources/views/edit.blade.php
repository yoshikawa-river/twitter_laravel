@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header">投稿を編集
           <form method='POST' action="/delete/{{$post['id']}}" id='delete-form'>
                @csrf
                <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-2x fa-trash"></i></button>
            </form>  
        
        </div>
        <div class="card-body">


            <form method='POST' action="{{ route('update', ['id' => $post['id'] ] ) }}" enctype="multipart/form-data">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                    <textarea name='content' class="form-control"rows="10">{{$post['content']}}</textarea>
                </div>
                <div>
                  <label for="image">画像登録</label>
                  <input type="file" class="form-control-file" id="image" name="image"　value="{{ '/storage/' . $post['image']}}">
                </div>
                <button type='submit' class="btn btn-primary btn-lg">投稿</button>
            </form>

            
        </div>
    </div>
</div>
@endsection