<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function tags(){
        return $this->hasMany(Tag::class);

    }
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
