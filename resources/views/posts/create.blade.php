@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
       {{ isset($posts) ? 'Edit Post' : 'Create Post' }}

        </div>
    <div class="card-body">

    <form action="{{ isset($posts) ? route('posts.update' , $posts->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

        @if(isset($posts))
        @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{isset($posts) ? $posts->title : '' }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" cols="5" rows="3" class="form-control">{{isset($posts) ? $posts->description : '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="content">Content</label>

            <!-- <textarea type="text" name="content" id="content" cols="5" rows="3" class="form-control"></textarea> -->
            <input id="content" type="hidden" name="content" value="{{isset($posts) ? $posts->content : '' }}">
            <trix-editor input="content"></trix-editor>

        </div>

        <div class="form-group">
            <label for="published_at">Published At</label>
            <input type="text" name="published_at" id="published_at" class="form-control" value="{{isset($posts) ? $posts->published_at : '' }}">
        </div>

        <div class="form-group">
            <img src="{{asset('storage/'.$posts->image)}}" alt="" style="width:100%">
        </div>


        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-group">
        @if(isset($posts))
            <input type="submit" class="btn btn-success" value="Update Post">
            @else
            <input type="submit" class="btn btn-success" value="Insert Post">
            @endif
        </div>


        </form>

    </div>
</div>

@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>flatpickr('#published_at',{
        enableTime:true
    })

</script>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
