<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/','WelcomeController@index')->name('welcome');

Route::get('/blog/posts/{post}' ,[App\Http\Controllers\blog\PostsController::class,'show'])->name('blog.show');

Auth::routes();

//Route::resource('posts', 'PostsController')->middleware(['auth','verifyCategoriesCount']);

//buat group
Route::middleware(['auth'])->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('categories', 'CategoriesController');

    Route::resource('posts', 'PostsController');

    Route::get('trashed-post' , 'PostsController@trashed')->name('trashed-post.index');

    Route::put('restore-post/{post}','PostsController@restore')->name('restore-post');

    Route::resource('tags', 'TagsController');

});

Route::middleware(['auth','admin'])->group(function(){

    Route::get('users','UsersController@index')->name('users.index');
    Route::get('users/edit','UsersController@edit')->name('users.edit-profile');
    Route::put('users/profile','UsersController@update')->name('users.update-profile');
    Route::post('users/{user}/make-admin' , 'UsersController@makeAdmin')->name('users.make-admin');
});
