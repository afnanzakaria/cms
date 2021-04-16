<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Post;
//use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create','store']);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories' , Categories::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        //upload image to storage   //upload path(local) to : storage/posts    //upload to public : set FILESYSTEM_DRIVER to public first
        $image=$request->image->store('posts');

        Post::create([

            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=> $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category
        ]);

        session()->flash('success','Post succesfully inserted');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('posts' , $post)->with('categories' , Categories::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        //'only' : get specific attr.
        $data = $request->only(['title','description','published_at','content']);

        //check if new image
        if($request->hasFile('image')){
            //upload it
            $image = $request->image->store('posts');

            //delete old one
           // Storage::delete($post->image);    -> refactor (change move to model)
            $post->DeleteImage();   //call function in model


            $data['image'] = $image;
        }



        //update attributes
        $post->update($data);

        //flash message
        session()->flash('success', 'Post update successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()){

            //delete image
                 //delete old one
                // Storage::delete($post->image);    -> refactor (change move to model)
            $post->DeleteImage();

            //permenant delete
            $post->forceDelete();
        }else{

            //soft delete
            $post->delete();
        }

        session()->flash('success','Delete succesfully');

        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        //get all trashed
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts',$trashed);
    }

    public function restore($id){

        $restore = Post::onlyTrashed()->where('id',$id)->firstOrFail();

        //restore image
        $restore->restore();

        session()->flash('success','Restore successfully');

        //return to where previous user from
        return redirect()->back();

    }
}

