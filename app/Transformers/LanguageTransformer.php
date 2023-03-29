<?php namespace App\Transformers;

use App\Models\Language;

class LanguageTransformer extends ParentTransformer{

    public $key = 'languages';

    public function transform(Language $language){

        $languageArray = [
            'id' => (int)$language->id,
            'name' => $language->name,
            'created_at'=> $language->created_at,
            'updated_at'=> $language->updated_at,
        ];

        return $languageArray;
    }

}