<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    use SoftDeletes;

    //identify published_at as date
    protected $dates =[
        'published_at'
    ];

    protected $fillable = [
        'title','description','content','published_at','image','category_id'
    ];


    public function DeleteImage(){
        Storage::delete($this->image);
    }

    //post belong to category
    public function category(){
        return $this->belongsTo(Categories::class);
    }

    //post has many tags(M to M)
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //check tag_id
    public function hasTag($tagId){
        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }

    //author
    public function user(){
        return $this->belongsTo(User::class);
    }

    //query date published
    public function scopePublished($query){
        return $query->where('published_at' , '<=' , now());
    }

    //search function
    public function scopeSearched($query){

        $search = request()->query('search');

        if(!$search){
            return $query->published();
        }

        return $query->published()->where('title','LIKE',"%{$search}%");
    }

}
