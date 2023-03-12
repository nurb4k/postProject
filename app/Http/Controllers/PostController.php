<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PostController extends BaseController
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
        $this->service->store($request);
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


    public function update(Request $request): RedirectResponse
    {
        $this->service->update($request);
        return redirect()->route('posts.index');
    }


    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('posts.index');
    }


}
