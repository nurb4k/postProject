<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PostController extends Controller
{

    public function index(): View
    {
        $allPosts = Post::all();
        return view('posts.index', ['posts' => $allPosts]);
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'img' => 'required|image|mimes:jpg,jpeg,png,gif,svg| max:2048',
        ]);
        $fileName = time() . $request->file('img')->getClientOriginalName();
        $image_path = $request->file('img')->storeAs('posts', $fileName, 'public');
        $validated['img'] = '/storage/' . $image_path;
        Auth::user()->posts()->create($validated);
//        Post::create($validated + ['user_id' => Auth::user()->id]);
        return redirect()->route('posts.index')->with('message', 'Post created!');
    }

    public function show(Post $post): View
    {
        return view('posts.show', ['post' => $post]);
    }


    public function edit(Post $post): View
    {
        return view('posts.edit', ['post' => $post]);
    }


    public function update(Request $request, Post $post): RedirectResponse
    {
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.index');
    }


    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('posts.index');
    }


}
