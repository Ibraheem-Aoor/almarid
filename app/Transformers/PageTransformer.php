<?php namespace App\Transformers;

use App\Models\Page;

class PageTransformer extends ParentTransformer{

    public $key = 'pages';

    public function transform(Page $page){

        $pageArray = [
            'id' => (int)$page->id,
            'name' => $page->name,
            'image'=> $this->baseUrl.'pages/'.$page->image,
            'text' => $page->text,
            'status' => $page->status,
            'lang' => $page->lang,
            'created_at'=> $page->created_at,
            'updated_at'=> $page->updated_at,
        ];

        return $pageArray;
    }

}