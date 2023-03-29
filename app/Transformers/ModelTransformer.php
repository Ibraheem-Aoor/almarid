<?php namespace App\Transformers;

use App\Models\Model;

class ModelTransformer extends ParentTransformer{

    public $key = 'models';

    public function transform(Model $model){

        $modelArray = [
            'id' => (int)$model->id,
            'name' => $model->name,
            'created_at'=> $model->created_at,
            'updated_at'=> $model->updated_at,
        ];

        return $modelArray;
    }

}