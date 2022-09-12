<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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

    public ?string $type = null;

    //  public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            [
                'type' => $this->type,
                'date' => $this->created_at->format('d.m.Y'),
                'category' => new CategoryResource($this->category),

            ],
            parent::toArray($request)
        );
    }
}
