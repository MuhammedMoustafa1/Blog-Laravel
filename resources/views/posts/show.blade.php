{{-- <ul>
@foreach ($posts as $data)
    <li>{{ $data }}</li>
@endforeach
</ul> --}}

@extends('layouts.app')
@section('title', 'Display Posts')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container my-5">
<table class="table table-striped table-hover">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>
        <th>Posted By</th>
        <th>Image</th>
    </tr>

    <tr>
        <td>{{ $posts['id'] }}</td>
        <td>{{ $posts['title'] }}</td>
        <td>{{ $posts['body'] }}</td>
        <td>{{ $posts->user->name }}</td>
        <td><img src="{{ asset('storage/' . $posts->image) }}" width="100" height="100"></td>
                <td>
    </tr>

</table>
</div>

<div class="card mt-3">
                <div class="card-header">
                    Comments
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($posts->comments as $comment)
                        <li class="list-group-item">{{$comment['pivot']['body']}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    Write a Comment
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $posts->id }}">
                        <div class="form-group">
                            <label for="content">Comment:</label>
                            <textarea class="form-control" id="content" name="body" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

@endsection
