<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
//
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|max:255',
            'post_id' => 'required',
            'img' => 'required|image|mimes:jpg,jpeg,png,gif,svg | max:2048',

        ]);
        //            'user_id' => Auth::user()->id,
        $fileName = time() . $request->file('img')->getClientOriginalName();
        $image_path = $request->file('img')->storeAs('comments', $fileName, 'public');
        $validated['img'] = '/storage/' . $image_path;
        Auth::user()->comments()->create($validated);
//        Comment::create
        return redirect()->route('posts.show', [$request->post_id, 'comment' => Comment::all()]);
    }


    public function edit(Comment $comment)
    {
        return view('posts.editcom', ['comment' => $comment]);
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
        ]);
        return redirect(route('posts.show', [$comment->post_id]));
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect(route('posts.show', [$comment->post_id]));
    }
}
