<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{

    public function __construct($resource, $type = null)
    {
        parent::__construct($resource);
        if($type) $this->type = $type;
    }

    public function setTpl($type): ArticleCollection
    {
        $this->type = $type;
        return $this;
    }
    public ?string $type = null;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'type' => $this->type,
        ];
    }
}
