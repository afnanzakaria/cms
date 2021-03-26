<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $fillable = [
        'title','description','content','published_at','image'
    ];

}
