@extends('layouts.app')
@section('title', 'List All Posts')
@section('content')
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
        .pagination
        {
            font-size: 0.9rem;
        }

        .pagination > li > a,
        .pagination > li > span
        {
            padding: 0.3rem 0.6rem;
        }
    </style>
</head>
<div class="container my-5">
    <a href="/posts/create" class="btn btn-primary mb-3">Create</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
                <th>Posted By</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post['body'] }}</td>
                <td>{{ $post->user->name }}</td>
                <td><img src="{{ asset('storage/' . $post->image) }}" width="100" height="100"></td>
                <td>
                    <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">Show</a>
                    <a class="btn btn-success" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

{{ $posts->links('pagination::bootstrap-4') }}
</div>

@endsection
