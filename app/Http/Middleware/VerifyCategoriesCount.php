<?php

namespace App\Http\Middleware;

use App\Models\Categories;
use Closure;
use Illuminate\Http\Request;

class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        //redirect if category none
        if(Categories::all()->count()== 0){

            session()->flash('error','You need to add categories to be able to create post');

            return redirect(route('categories.create'));
        }

        return $next($request);
    }

}
