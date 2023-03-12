@extends('layouts.app')
@section('title' , 'Edit post')
@section('content')
    <div class="container">
        <form class="form-control" action="{{ route('comments.update', $comment->id) }}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="forCont">Content:</label>
            <textarea class="form-control" rows="3" name="content" id="forCont">{{$comment->content}}
            </textarea>
            <label for="formFile" class="form-label">Image</label>
            <div class="mb-3">
                <input class="form-control" required name="img" type="file" id="formFile">
            </div>
            <input type="hidden" name="post_id" value="{{$comment->post_id}}">
            <button class="btn btn-primary" type="submit">Update comment</button>
        </form>
    </div>
@endsection

