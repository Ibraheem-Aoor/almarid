<?php namespace App\Transformers;

use App\Models\Color;
use App\Models\ProductColor;

class ProductColorTransformer extends ParentTransformer{

    public $key = 'productcolor';

    public function transform(ProductColor $productColor){

        $productColorArray = [
            'id' => (int)$productColor->id,
            'color_id'=> $productColor->color_id,
            'created_at'=> $productColor->created_at,
            'updated_at'=> $productColor->updated_at,
        ];
        return $productColorArray;
    }

    protected $availableIncludes = ['color'];
    protected $defaultIncludes = ['color'];

    public function includeColor(ProductColor $productColor)
    {
        $color = $productColor->color;

        return $this->item($color, new ColorTransformer());
    }

}