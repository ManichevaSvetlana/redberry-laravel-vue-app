<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|exists:posts,id'
        ]);
        return response()->json(Comment::where('post_id', $request->post_id)->with('user')->orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id'
        ]);
        auth()->user()->comments()->create($request->only(['message', 'post_id']));

        return response()->json(['message' => 'The resource was successfully created.']);
    }
}
