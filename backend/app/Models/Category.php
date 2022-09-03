<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Mutators
    public function setSlugAttribute($value)
    {
        // Проверка для сидов
        if(!$_REQUEST) return $this->attributes['slug'] = $value;

        if(isset($_REQUEST['slug_change']) && !empty($value)){
            $this->attributes['slug'] = Str::slug($value);
        }else{
            if($_REQUEST)
                $this->attributes['slug'] = Str::slug($_REQUEST['title']);
        }
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function scopeLastCategories($query, $count)
    {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
