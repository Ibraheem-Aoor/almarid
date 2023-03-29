<?php

namespace App\Transformers;

use App\Models\Slider;

class SliderTransformer extends ParentTransformer{

	public $key = 'slides';

	public function transform(Slider $slider){

		$sliderArray = [
			'id'	=>	(int)$slider->id,
			'type'	=>	$slider->type,
			'name'	=>	$slider->name,
			'file'	=>	$this->baseUrl.'sliders/'.$slider->file,
			// 'product_id'=> $slider->product_id,
			// 'created_at'=> $slider->created_at,
			// 'updated_at'=> $slider->updated_at,
			// 'deleted_at'=> $slider->deleted_at,
		];

		return $sliderArray;
	}

}