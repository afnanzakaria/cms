<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){


        //x guna sbb dh guna scope method
        /* $search = request()->query('search');

        if($search){

            $posts = Post::where('title','LIKE',"%{$search}%")->simplePaginate(2);
        }else{

            $posts = Post::simplePaginate(2);
        } */


        return view('welcome')
        ->with('categories' , Categories::all())
        ->with('tags' , Tag::all())
        //->with('posts' , Post::all());
        ->with('posts' , Post::searched()->simplePaginate(2));
    }
}
