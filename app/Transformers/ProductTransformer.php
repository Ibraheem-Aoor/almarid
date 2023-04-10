<?php namespace App\Transformers;

use App\Models\Product;
use PHPUnit\Util\Printer;

class ProductTransformer extends ParentTransformer{

    public $key = 'products';

    public function transform(Product $product){

        $productArray = [
            'id' => (int)$product->id,
            'name' => $product->name,
            'name_en' => $product->name_en,
            'description' => $product->description,
            'description_en' => $product->description_en,
            'image'=> $this->baseUrl.'products/'.$product->image,

            'category_id'=> $product->category_id,
            'category_name_ar'=> $product->category ? $product->category->name : '' ,
            'category_name_en'=> $product->category ? $product->category->name_en : '' ,
            'category'=> $product->category ? $product->category : null,

            'model_id'=> $product->model_id,
            'model_name'=> $product->model ? $product->model->name : '' ,
            'model'=> $product->model ? $product->model : null,

            'brand_id'=> $product->brand_id,
            'brand_name'=> $product->brand ? $product->brand->name : '' ,
            'brand'=> $product->brand ? $product->brand : null,

            'price'=> $product->price,
            'quantity'=> $product->quantity,
            'deposit'=> $product->deposit,
            'is_new'=> (bool)$product->is_new,

            'is_offer'=> (bool)$product->is_offer,
            'offer_price'=> $product->offer_price,
            'offer_id'=> $product->offer_id,
            'offer'=> $product->offer ? $product->offer : null,

            'status'=> $product->status,

            'created_at'=> $product->created_at,
            'updated_at'=> $product->updated_at,
        ];

        return $productArray;
    }

    protected $availableIncludes = [
        'colors','images','options'
    ];
    protected $defaultIncludes = [
        'colors','images','options'
    ];

    public function includeColors(Product $product)
    {
        $colors = $product->colors;

        return $this->collection($colors, new ProductColorTransformer());
    }
    public function includeImages(Product $product)
    {
        $images = $product->images;

        return $this->collection($images, new ProductImageTransformer());
    }
    public function includeOptions(Product $product)
    {
        $options = $product->options;

        return $this->collection($options, new ProductOptionTransformer());
    }

}
