<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function show(Post $post){

        return view('blog.show')->with('post',$post);

    }

    public function category(Categories $category){


         //x guna sbb dh guna scope method
        /*  $search = request()->query('search');

        if($search){
            $posts = $category->posts()->where('title','LIKE','%{$search}%')->simplePaginate(2);
        }else{
            $posts = $category->posts()->simplePaginate(2);
        } */

        return view('blog.category')
        ->with('category', $category)
        ->with('posts' , $category->posts()->searched()->simplePaginate(2))
        ->with('categories' , Categories::all())
        ->with('tags', Tag::all());
    }


    public function tag(Tag $tag){

         //x guna sbb dh guna scope method
        /* $search = request()->query('search');

        if($search){
            $posts = $tag->posts()->where('title','LIKE','%{$search}%')->simplePaginate(2);
        }else{
            $posts = $tag->posts()->simplePaginate(2);
        } */

        return view('blog.tag')
        ->with('tag', $tag)
        ->with('posts' , $tag->posts()->searched()->simplePaginate(2))
        ->with('categories' , Categories::all())
        ->with('tags', Tag::all());
    }
}
