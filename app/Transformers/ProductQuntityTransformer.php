<?php namespace App\Transformers;

use App\Models\ProductQuntity;

class ProductQuntityTransformer extends ParentTransformer{

    public $key = 'productquntity';

    public function transform(ProductQuntity $productQuntity){

        $productQuntityArray = [
            'id' => (int)$productQuntity->id,
            'name' => $productQuntity->name,
            'image'=> $productQuntity->image,
            'created_at'=> $productQuntity->created_at,
            'updated_at'=> $productQuntity->updated_at,
        ];

        return $productQuntityArray;
    }

}