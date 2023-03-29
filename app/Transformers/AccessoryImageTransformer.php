<?php

namespace App\Transformers;

use App\Models\ProductImage;

class AccessoryImageTransformer extends ParentTransformer{

	public $key = 'productimage';

	public function transform(ProductImage $productimage){

		$productimageArray = [
			'id'			=>	(int)$productimage->id,
			'image'			=>	($productimage->image != '')? \URL::asset('/uploads/accessories/' . $productimage->image) : \URL::asset('/assets/logo.png'),
			'created_at'	=>	$productimage->created_at,
			'updated_at'	=>	$productimage->updated_at,
		];

		return $productimageArray;
	}

}