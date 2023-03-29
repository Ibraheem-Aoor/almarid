<?php namespace App\Transformers;

use App\Models\Option;

class OptionTransformer extends ParentTransformer{

    public $key = 'options';

    public function transform(Option $option){

        $optionArray = [
            'id' => (int)$option->id,
            'name' => $option->name,
            'name_en' => $option->name_en,
            'image'=> $this->baseUrl.'options/'.$option->image,
            'category_id'=> $option->category_id,
            'category_name_ar'=> $option->category ? $option->category->name : '' ,
            'category_name_en'=> $option->category ? $option->category->name_en : '' ,
            'category_image'=> $option->category ? $this->baseUrl.'categories/'.$option->category->image : '' ,
            'category'=> $option->category ? $option->category : null,
            'created_at'=> $option->created_at,
            'updated_at'=> $option->updated_at,
        ];

        return $optionArray;
    }

}