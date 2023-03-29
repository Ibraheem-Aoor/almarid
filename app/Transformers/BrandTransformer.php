<?php namespace App\Transformers;

use App\Models\Brand;

class BrandTransformer extends ParentTransformer{

    public $key = 'brands';

    public function transform(Brand $brand){

        $brandArray = [
            'id' => (int)$brand->id,
            'name' => $brand->name,
            'image'=> $this->baseUrl.'brands/'.$brand->image,
            'created_at'=> $brand->created_at,
            'updated_at'=> $brand->updated_at,
        ];

        return $brandArray;
    }

}