<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'content','published_at', 'image'];

    use SoftDeletes;

    public function deletePostImage(){

        Storage::delete($this->image);

    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
