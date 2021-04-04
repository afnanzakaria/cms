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
    @if($posts->count() > 0)
     <table class="table">
                <thead>
                <th>Image</th>
                <th>Description</th>
                <th>Category</th>
                <th></th>
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
                      <a href="{{route('categories.edit' , $post->category->id)}}">{{$post->category->name}}</a>
                        </td>

                        @if(!$post->trashed())
                        <td>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info">Edit</a>
                        </td>
                        @else
                        <form action="{{route('restore-post' , $post->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <td>
                        <button type="submit" class="btn btn-info">Restore</button>
                        </td>
                        </form>
                        @endif

                        <td>
                            <form action="{{route('posts.destroy' , $post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                 @if($post->trashed())
                                <button type="submit" class="btn btn-danger">Trashed</button>

                                @else
                                <button type="submit" class="btn btn-danger">Delete</button>
                                @endif
                            </form>
                        </td>


                    </tr>
                    @endforeach
                    </tbody>
                </table>
      @else
        <h3 class="text-center">No Post Yet.</h3>

@endif
         </div>

</div>


@endsection
