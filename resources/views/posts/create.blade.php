@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        Create Post
        </div>
    <div class="card-body">

    <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" cols="5" rows="3" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea type="text" name="content" id="content" cols="5" rows="3" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="published_at">Published At</label>
            <input type="text" name="published_at" id="published_at" class="form-control">
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Insert Post">
        </div>

        </form>

    </div>
</div>

@endsection
