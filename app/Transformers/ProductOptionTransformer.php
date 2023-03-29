<?php namespace App\Transformers;

use App\Models\ProductOption;

class ProductOptionTransformer extends ParentTransformer{

    public $key = 'productoption';

    public function transform(ProductOption $productOption){

        $productOptionArray = [
            'id' => (int)$productOption->id,
            'option_category_id' => $productOption->option_category_id,
            'option_id'=> $productOption->option_id,
            'other'=> $productOption->other,
            'type'=> (intval($productOption->option_id) > 0 && empty($productOption->other)) ? 'select' : 'text',
            'created_at'=> $productOption->created_at,
            'updated_at'=> $productOption->updated_at,
        ];

        return $productOptionArray;
    }

    protected $availableIncludes = ['option','optioncategory'];
    protected $defaultIncludes = ['option','optioncategory'];

    public function includeOption(ProductOption $productOption)
    {
        if(isset($productOption->option) && !empty($productOption->option)){
            $option = $productOption->option;
            return $this->item($option, new OptionTransformer());
        }else{
            return null;
        }
    }

    public function includeOptioncategory(ProductOption $productOption)
    {
        if(isset($productOption->optionCategory) && !empty($productOption->optionCategory)){
            $option = $productOption->optionCategory;
            return $this->item($option, new CategoryTransformer());
        }else{
            return null;
        }
    }

}