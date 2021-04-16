<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable=['name'];

    use HasFactory;

    //tags has many posts (M to M)
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
