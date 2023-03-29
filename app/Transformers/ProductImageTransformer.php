<?php namespace App\Transformers;

use App\Models\ProductImage;

class ProductImageTransformer extends ParentTransformer{

    public $key = 'productimage';

    public function transform(ProductImage $productimage){

        $productimageArray = [
            'id' => (int)$productimage->id,
            'image'=> $this->baseUrl.'products/'.$productimage->image,
            'created_at'=> $productimage->created_at,
            'updated_at'=> $productimage->updated_at,
        ];

        return $productimageArray;
    }

}