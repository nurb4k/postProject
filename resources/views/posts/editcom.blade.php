<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>Create a post</title>
</head>
<body>


<form action="{{ route('comments.update', $comment->id) }}" method="post">
    @csrf
    @method('PUT')
    Comment : <input type="text" name="content" value="{{$comment -> content}}"> <br>
    <input type="hidden" name="post_id" value="{{$comment -> post_id}}">
    <button type="submit">Update comment</button>
</form>
</body>
</html>
