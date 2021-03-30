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

    protected $fillable = [
        'title','description','content','published_at','image'
    ];


    public function DeleteImage(){
        Storage::delete($this->image);
    }

}
