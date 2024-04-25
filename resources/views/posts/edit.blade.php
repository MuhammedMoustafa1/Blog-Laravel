@extends('layouts.app')
@section('title', 'Update Post')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<h1>Update Post</h1>
<div class="container my-5">
<form action="/posts/{{ $posts['id'] }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')




    <label for="" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ $posts['title'] }}">

    <label for="" class="form-label">Body</label>
    <input type="text" class="form-control" name="body" value="{{ $posts['body'] }}">

    <label for="" class="form-label">Image</label>
    <input type="file" name="image" class="form-control" value="{{ $posts['image'] }}">


    <button type="submit" class="btn btn-success my-4">UPDate</button>
</form>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
