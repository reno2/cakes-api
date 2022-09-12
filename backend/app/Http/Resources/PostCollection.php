<?php

namespace App\Http\Resources;

use App\Repositories\CoreRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{

    public function __construct($resource, $type = null)
    {
        parent::__construct($resource);
        if($type) $this->type = $type;
    }

    public ?string $type = null;

    //public static $wrap = null;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

       $pagination = ($this->currentPage())  ? [
            "current_page" => $this->currentPage(),
            "first_page_url" =>  $this->getOptions()['path'].'?'.$this->getOptions()['pageName'].'=1',
            "prev_page_url" =>  $this->previousPageUrl(),
            "next_page_url" =>  $this->nextPageUrl(),
            "last_page_url" =>  $this->getOptions()['path'].'?'.$this->getOptions()['pageName'].'='.$this->lastPage(),
            "last_page" =>  $this->lastPage(),
            "per_page" =>  $this->perPage(),
            "total" =>  $this->total(),
            "path" =>  $this->getOptions()['path'],
            "nav_name" =>  $this->getOptions()['pageName'],
        ] : null;

        return [
            'tags' => (new TagRepository())->forFrontPage(),
            'list' => $this->collection,
            'type' => $this->type,
            'meta' => [
                'pagination' => $pagination,
            ],
        ];
    }
}
