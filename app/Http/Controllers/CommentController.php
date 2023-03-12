<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CommentController extends Controller
{

    public function store(Request $request): RedirectResponse
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
        return redirect()->route('posts.show', [$request->post_id, 'comment' => Comment::all()]);
    }


    public function edit(Comment $comment): View
    {
        return view('comments.editcom', ['comment' => $comment]);
    }

    public function update(Request $request, Comment $comment): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required',
            'img' => 'required|image|mimes:jpg,jpeg,png,gif,svg| max:2048',
        ]);
        $fileName = time() . $request->file('img')->getClientOriginalName();
        $image_path = $request->file('img')->storeAs('comments', $fileName, 'public');
        $validated['img'] = '/storage/' . $image_path;
        Auth::user()->comments()->update($validated);

        return redirect(route('posts.show', [$comment->post_id]));
    }


    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return redirect(route('posts.show', [$comment->post_id]));
    }
}
