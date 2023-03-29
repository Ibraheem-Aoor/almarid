<?php namespace App\Transformers;

use App\Models\Guide;

class GuideTransformer extends ParentTransformer{

    public $key = 'guides';

    public function transform(Guide $guide){

        $guideArray = [
            'id' => (int)$guide->id,
            'name' => $guide->name,
            'text'=> $guide->text,
            'lang'=> $guide->lang,
            'sort'=> $guide->sort,
            'file'=> ($guide->file_type == 'YOUTUBE') ? $guide->file : $this->baseUrl.'categories/'.$guide->file,
            'file_type'=> $guide->file_type,
            'created_at'=> $guide->created_at,
            'updated_at'=> $guide->updated_at,
        ];

        return $guideArray;
    }

}