<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    // Display a listing of the comments.
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', ['comments' => $comments]);
    }

    // Show the form for creating a new comment.
    public function create($postID)
    {
        // Your code to display the form for creating a new comment
        return view('comments.create',['id'=>$postID]);
    }

    // Store a newly created comment in storage.
    public function store(Request $request)
    {
        Comment::create([
            'post_id' => $request->post_id,
            'body' => $request->body,
            'user_id' => Auth::id(),

        ]);
        return redirect("/posts/$request->post_id");
    }

    // Display the specified comment.
    public function show($id)
    {
        $comment = Comment::find($id);
        return view('comments.show', ['comment' => $comment]);
    }

    // Show the form for editing the specified comment.
    public function edit(Comment $comment)
    {
        // Your code to display the form for editing the comment
    }

    // Update the specified comment in storage.
    public function update(Request $request, Comment $comment)
    {
        // Your code to update the comment
    }

    // Remove the specified comment from storage.
    public function destroy(Comment $comment)
    {
        // Your code to delete the comment
    }
}
