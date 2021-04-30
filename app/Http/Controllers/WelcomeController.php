<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){

        return view('welcome')
        ->with('categories' , Categories::all())
        ->with('tags' , Tag::all())
        //->with('posts' , Post::all());
        ->with('posts' , Post::simplePaginate(1));
    }
}
