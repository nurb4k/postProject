@extends('layouts.app')


@section('title' , 'INDEX PAGE')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <a class="btn btn-outline-primary" href="{{ route('posts.create') }}"> Go to create page </a>

                @foreach($posts as $post)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="{{asset($post->img)}}" width="100" alt="">
                            <h5 class="card-title">{{$post -> title}}</h5>
                            <small>Author: {{$post->user->name}}</small>
                            <p class="card-text">{{$post->content}}</p>
                            <a href="{{route('posts.show' , $post->id)}}" class="btn btn-primary">Read More</a>
                            <form action="{{route('posts.destroy' , $post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">DELETE</button>
                            </form>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection





