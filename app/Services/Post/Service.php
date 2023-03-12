<?php

namespace App\Services\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Service
{
    public function store(Request $request)
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
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'img' => 'required|image|mimes:jpg,jpeg,png,gif,svg| max:2048',
        ]);
        $fileName = time() . $request->file('img')->getClientOriginalName();
        $image_path = $request->file('img')->storeAs('posts', $fileName, 'public');
        $validated['img'] = '/storage/' . $image_path;
        Auth::user()->posts()->update($validated);
    }
}
