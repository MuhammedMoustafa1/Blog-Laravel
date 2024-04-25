<?php

namespace App\Http\Controllers\api;
use App\Http\Requests\StorePostRequest;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    function index(){
        $posts = Post::with('user')->paginate(5);
        // $posts = Post::all();

        return PostResource::collection($posts);
    }

      function store(StorePostRequest $request) {
    try {
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return "Post stored successfully";
    } catch (\Exception $e) {
        return "Failed to store post: " . $e->getMessage();
    }
}

    function show($id){
            // $post = Post::find($id);
            $post = Post::with('user')->findOrFail($id);
            return new PostResource($post);
    }
   public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'body' => 'required|min:2',
        'image' => 'image|mimes:jpg,jpeg,png|max:2048',
    ]);

    try {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        // Assuming user_id can be updated as well, you may remove this line if not needed
        $post->user_id = $request->user_id;

        // Check if a new image file has been uploaded
        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::delete($post->image);

            // Upload and store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();
        return "Post updated successfully";
    } catch (\Exception $e) {
        return "Failed to update post: " . $e->getMessage();
    }
}

    function destroy($id){
        $post = Post::findOrFail($id);
    if ($post->image) {
        Storage::disk('public')->delete($post->image);
    }
        Post::destroy($id);
        return "Post deleted sussefully";
    }
}
