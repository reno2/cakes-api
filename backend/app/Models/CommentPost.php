<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentPost extends Model
{
    protected $table = 'comment_post';
    use HasFactory;
    protected $fillable =  ['comment_id', 'post_id'];
}
