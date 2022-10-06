<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $id = auth()->user();
        return Inertia::render('Posts/Index', ['user' => $id]);
    }

    public function get(Request $request)
    {
        return response()->json(Post::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        return response()->json(Post::create([
            'body' => $request->body,
            'title' => $request->title,
            'user_id' => auth()->user()->id
        ]));
    }

    public function update(Request $request, Post $post)
    {
        $this->validateRequest($request);

        $this->authorize('post-manage', $post);

        $post->update([
            'body' => $request->body,
            'title' => $request->title
        ]);

        return response()->json($post);
    }
    public function destroy(Post $post)
    {
        $this->authorize('post-manage', $post);

        Post::destroy($post->id);

        return response()->json(['message' => 'The resource was successfully deleted.']);
    }

    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'body' => 'nullable|string'
        ]);
    }
}
