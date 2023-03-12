@extends('layouts.app')
@section('title' , 'Edit post')
@section('content')
    <div class="container-sm mb-2">
        <a class="btn btn-outline-primary" href="{{ route('posts.index') }}">Home</a>
    </div>
    <div class="container border p-2">
        <div class="form-group">
            <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="forTitle">Title:</label>
                <input type="text" class="form-control" value="{{$post->title}}" name="title" id="forTitle">
                <label for="forCont">Content:</label>
                <textarea class="form-control" rows="6" name="content" id="forCont">{{$post->content}}
                </textarea>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" required name="img" type="file" id="formFile">
                </div>
                <button class="btn btn-primary mt-2" type="submit">Update post</button>
            </form>
        </div>
    </div>
@endsection
