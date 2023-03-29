<?php

namespace App\Transformers;

use App\Models\Product;

class AccessoriesTransformer extends ParentTransformer{

	public $key = 'accessories';

	public function transform(Product $product){

		$productArray = [
			'id' 				=>	(int)$product->id,
			'type' 				=>	$product->type,
			'name' 				=>	$product->name,
			'name_en' 			=>	$product->name_en,
			'description' 		=>	$product->description,
			'description_en' 	=>	$product->description_en,
			'image'				=>	($product->image != '')? \URL::asset('/uploads/accessories/' . $product->image) : \URL::asset('/assets/logo.png'),//$this->baseUrl.'accessories/'.$product->image,

			'price'				=>	$product->price,
			'quantity'			=>	$product->quantity,
			'deposit'			=>	$product->deposit,
			'is_new'			=>	(bool)$product->is_new,

			'is_offer'			=>	(bool)$product->is_offer,
			'offer_price'		=>	$product->offer_price,
			'offer_id'			=>	$product->offer_id,
			'offer'				=>	$product->offer ? $product->offer : null,

			'status'			=>	$product->status,

			'created_at'		=>	$product->created_at,
			'updated_at'		=>	$product->updated_at,
		];

		return $productArray;
	}

	protected $availableIncludes = [];
	protected $defaultIncludes = [];

}