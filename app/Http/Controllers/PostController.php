<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(){
        $posts = Post::paginate(5);
        return view('posts.index',["posts"=>$posts]);
    }

    function create(){
        return view("posts.create");
    }
    function store(StorePostRequest $request){
        // return "Inserted Sussefully";
        // validation
        $request->validate([

            //'user_id' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'required',
            'body' => 'required|min:2',
        ],["title.required"=>"You must enter a title"]);
        $title = $request->old('title');
        $id = Auth::id();
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $id;
        // $post->image = $request->image;
        if ($request->hasFile('image')) {
    $imagePath = $request->file('image')->store('images', 'public');
    $post->image = $imagePath;
}


        $post->save();

        return redirect("/posts");
    }
    function show($id){
        $posts=Post::find($id);

        return view("posts.show" , ["posts"=>$posts]);

}

    function edit($id){
        $posts=Post::find($id);
        return view("posts.edit" , ["posts"=>$posts]);

}
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'body' => 'required|min:2',
        'image' => 'image|mimes:jpg,jpeg,png|max:2048',
    ]);
    $post = Post::find($id);
    $post->title = $request->title;
    $post->body = $request->body;

    // Check if a new image file has been uploaded
    if ($request->hasFile('image')) {
        // Delete the old image
        Storage::delete($post->image);

        // Upload and store the new image
        $imagePath = $request->file('image')->store('images', 'public');
        $post->image = $imagePath;
    }

    $post->save();
    return redirect("/posts");
}
    function destroy($id){
        $post = Post::findOrFail($id);
    if ($post->image) {
        Storage::disk('public')->delete($post->image);
    }
        Post::destroy($id);
        return redirect("/posts");
    }


}
