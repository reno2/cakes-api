<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;


class MenusController extends Controller
{
    public function frontMenu(){
        $items = new CategoryRepository();
        $data = $items->forFrontPage();

//        $url = '/';
//        $data = $data->toArray();
//        $cnt = 0;
//        $limit = 4;
//        $lastItem = [
//            'title' => 'Ещё',
//            'CHILDREN' => [],
//            'is_active' => false,
//            'url' => '',
//            'is_more' => true,
//        ];
//        foreach ($data as $key => &$item) {
//            $item['url'] = implode('/', ['', 'category', $item['slug'], '']);
//            if ($cnt > $limit) {
//                $lastItem['CHILDREN'][] = $item;
//                unset($data[$key]);
//            }
//            $cnt++;
//        }
//        if (count($lastItem['CHILDREN'])) $data[] = $lastItem;

        return response()->json([
            'menu' => ($data) ? $data->toArray(): []
        ]);

    }
}
