<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        // return response()->json($posts, 200);
        $posts = Post::where('user_id', '!=', null)->with('user', 'Likes')->get();
        foreach ($posts as $post) {
            return $post->user->profile;
        //     $post->auther = $post->user->profile;
        }
        // return response()->json($posts, 200);
        // return $posts;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'name' => $request->name,
            'body' => $request->body,
            'user_id' => $request->user()->id,
            'category_id' => $request->category,
        ]);
        if (!$post) {
            return response()->json(['status' => 'false', 'message' => 'create post woring!']);
        }
        return response()->json(['status' => 'success', 'message' => 'create posr seccessful']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'name' => $request->name,
            'category_id' => $request->category,
            'body' => $request->body,
        ]);
        if (!$post) {
            return response()->json(['status' => 'false'], 400);
        }
        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['status' => 'true'], 200);
    }
}
