<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\CategoryResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ArticleResource extends JsonResource
{
    public $resource;

    public function __construct($resource, $type = null)
    {
        $this->resource = $resource;
        parent::__construct($resource);
        if ($type) {
            $this->type = $type;
        }
    }

    private function getImages(){
        $images = env('APP_URL').'storage/images/hero/hero.jpg';
        if(count($this->getMedia('cover')) > 0){
            $images = $this->getMedia('cover');
        }

        return $images;
    }

    public ?string $type = null;
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge(
            [
                'type' => $this->type,
                'date' => $this->created_at->format('d.m.Y'),
                'title' => $this->title,
                'images' => $this->getImages(),
                'category' => CategoryResource::collection($this->categories),

            ],

        );
    }
}
