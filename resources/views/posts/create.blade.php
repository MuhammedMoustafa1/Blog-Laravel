@extends('layouts.app')
@section('title', 'Create a new Post')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container my-5">
    <h1>Create a new Post</h1>
<form action="/posts" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title') }}">

    <label for="" class="form-label">Body</label>
    <input type="text" name="body" class="form-control" value="{{ old('body') }}">

    <label for="" class="form-label">Image</label>
    <input type="file" name="image" class="form-control">

    <button type="submit" class="btn btn-primary my-4">Submit</button>
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
