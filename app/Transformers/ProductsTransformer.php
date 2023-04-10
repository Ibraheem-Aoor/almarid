<?php namespace App\Transformers;

use App\Models\Product;

class ProductsTransformer extends ParentTransformer{

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

            'model_id'=> $product->model_id,
            'model_name'=> $product->model ? $product->model->name : '' ,

            'brand_id'=> $product->brand_id,
            'brand_name'=> $product->brand ? $product->brand->name : '' ,

            'price'=> $product->price,
            'quantity'=> $product->quantity,
            'deposit'=> $product->deposit,
            'is_new'=> (bool)$product->is_new,

            'is_offer'=> (bool)$product->is_offer,
            'offer_price'=> $product->offer_price,
            'offer_id'=> $product->offer_id,

            'status'=> $product->status,

            'created_at'=> $product->created_at,
            'updated_at'=> $product->updated_at,
        ];

        return $productArray;
    }

    protected $availableIncludes = [];
    protected $defaultIncludes = [];

}
