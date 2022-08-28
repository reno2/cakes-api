<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Comment;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->belongsToMany(Comment::class);
    }
}
