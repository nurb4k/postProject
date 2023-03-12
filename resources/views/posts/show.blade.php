@extends('layouts.app')
@section('title' , 'post')
@section('content')
    <div class="container-sm mb-2">
        <a class="btn btn-outline-primary" href="{{ route('posts.index') }}">Go back</a>
    </div>
    <div class="container border p-4 mb-4">
        <div class="container-lg mt-4 align-content-lg-center">
            <p class="small">title:</p>
            <h3 class="text-uppercase fw-bolder">{{$post->title}}</h3>
            <img src="{{asset($post->img)}}" width="100" alt="">
            <hr>
            <p class="small">content:</p>
            <p>{{$post->content }}</p>
            <hr>
            <a class="btn btn-primary" href="{{route('posts.edit', $post->id)}}">Edit</a>
        </div>
    </div>
    <div class="container">
        <div class="col-6">
            <div class="m-12">
                <div class="container-sm border mb-2 p-2">
                    <form action="{{ route('comments.store',[$post->id]) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="form-group">
                            <label for="contentInput">Publish your comment</label>
                            <textarea class="form-control" id="contentInput"
                                      name="content">
                            </textarea>
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" required name="img" type="file" id="formFile">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-outline-success sm" type="submit">Save comment</button>
                        </div>
                    </form>
                </div>
                <div class="container mt-2">
                    <h3>Comments:</h3>
                    @foreach($post->comments as $com)
                        <div class="container-sm border">
                            <p>Author: {{$com->user->name}}</p>
                            <hr>
                            <p>{{$com->content}}</p>
                            <img src="{{asset($com->img)}}" width="100" alt="">
                            <hr>
                            <div class="d-flex p-1">
                                <a href="{{route('comments.edit', $com->id)}}" class="btn btn-warning mx-2">Edit</a>
                                <form action="{{route('comments.destroy',$com->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger " type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@endsection
