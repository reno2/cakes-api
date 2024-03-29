<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Element;
use phpDocumentor\Reflection\Types\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\File;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;



class Article extends Model implements HasMedia, Viewable
{
    use  HasFactory, Notifiable, InteractsWithMedia, SoftDeletes, InteractsWithViews;

    public  $not_need_moderate = '100';
    public  $need_moderate = '200';

    const MODERATE_AND_UPDATE = "Объявление обновленно и отправлено на модерацию";
    const UPDATE = "Объявление обновленно";

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        if (isset($_REQUEST['slug__change']) && !empty($value)) {
            $this->attributes['slug'] = Str::slug($value);
        } else {
            $this->attributes['slug'] = Str::slug($value);
        }

    }
    public $toModerate = [
        'title', 'description', 'price'
    ];
    protected $fillable = [
        'title',
        'slug',
        'sort',
        'up_post',
        'description_short',
        'description',
        'image',
        'image_show',
        'meta_title',
        'meta_description',
        'moderate',
        'published',
        'created_by',
        'modified_by',
        'on_front',
        'service',
        'product_type',
        'price',
        'weight',
        'deal_address',
        'delivery_self',
        'user_id',
        'deal'
    ];

    //plymorphe
    public function categories()
    {
        return $this->morphToMany('App\Models\Category', 'categoryable');
    }

    public function scopeLastArticles($query, $count)
    {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }

    public function tags()
    {
        return $this->belongsToMany('\App\Models\Tag');
    }

    //plymorphe
    public function filterGroups()
    {
        // Первым парметром передаём модель, с которой связь, вторым приставку полей
        return $this->morphToMany('App\Models\PropertyName', 'propertyable');
    }

    //plymorphe
    public function filterValues()
    {
        return $this->morphToMany('App\Models\PropertyValue', 'propertyvalueable');
    }

    // Связь с картинками
    public function images()
    {
        return $this->hasMany('App\Models\PostImage');
    }

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get all of the user's images.
     */
    public function media() : \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function registerMediaCollections(Media $media = null) : void
    {
        $this
            ->addMediaCollection('cover')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->fit('fill', 265, 265);
                    //->nonQueued();
            });
        $this
            ->addMediaCollection('cover')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('detail')
                    ->fit('fill', 677, 520);
                    //->nonQueued();
            });
    }

    public function favoritesProfiles()
    {
        return $this->belongsToMany('App\Models\Profile', 'favorites');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //plimorphe
    public function moderateComments(){
        // Первым параметром передаём модель, с которой связь, вторым приставку полей
        return $this->morphToMany('App\Models\Moderate', 'moderatesable');
    }
}
