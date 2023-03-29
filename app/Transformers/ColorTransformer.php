<?php namespace App\Transformers;

use App\Models\Color;

class ColorTransformer extends ParentTransformer{

    public $key = 'colors';

    public function transform(Color $color){

        $colorArray = [
            'id' => (int)$color->id,
            'name' => $color->name,
            'code'=> $color->code,
            'created_at'=> $color->created_at,
            'updated_at'=> $color->updated_at,
        ];

        return $colorArray;
    }

}