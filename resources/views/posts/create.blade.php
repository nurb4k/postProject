@extends('layouts.app')
@section('title' , 'Create post')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">Go back</a>
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titleInput">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput"
                               name="title" placeholder="Enter title">
                        @error('title')
                        <div class="alert alert-danger">{{$message}} </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contentInput">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="contentInput" rows="3"
                                  name="content"></textarea>
                        @error('content')
                        <div class="alert alert-danger">{{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" required name="img" type="file" id="formFile">
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-outline-success" type="submit">Save post</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

