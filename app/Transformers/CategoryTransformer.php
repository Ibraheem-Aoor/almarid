<?php namespace App\Transformers;

use App\Models\Category;

class CategoryTransformer extends ParentTransformer{

    public $key = 'categories';

    public function transform(Category $category){

        $categoryArray = [
            'id' => (int)$category->id,
            'name' => $category->name,
            'name_en' => $category->name_en,
            'image'=> $this->baseUrl.'categories/'.$category->image,
            'type'=> $category->type,
            'status'=> $category->status,
            'sort'=> $category->sort,
            'created_at'=> $category->created_at,
            'updated_at'=> $category->updated_at,
        ];

        return $categoryArray;
    }

}