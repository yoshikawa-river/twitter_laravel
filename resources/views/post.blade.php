@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header">新規投稿</div>
        <div class="card-body">

            <form method='POST' action="/store" enctype="multipart/form-data">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                    <textarea name='content' class="form-control"rows="10"></textarea>
                </div>
                <div>
                  <label for="image">画像登録</label>
                  <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <button type='submit' class="btn btn-primary btn-lg">投稿</button>
            </form>

            
        </div>
    </div>
</div>
@endsection