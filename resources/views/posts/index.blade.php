@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
    <a href="{{route('posts.create')}}" class="btn btn-success">Add Post</a>
    </div>

<div class="card card-default">
    <div class="card-header">
        Post
        </div>

     <div class="card-body">

     <table class="table">
                <thead>
                <th>Image</th>
                <th>Description</th>
                <th></th>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>
                        <!-- 'asset' use to give full path -->
                       <img src="{{asset('storage/'.$post->image)}}" width="120px" height="60px" alt="">
                        </td>

                        <td>
                        {{$post->description}}
                        </td>

                        <td>

                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>


         </div>

</div>


@endsection
