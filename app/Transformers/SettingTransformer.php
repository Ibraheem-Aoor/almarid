<?php namespace App\Transformers;

use App\Models\Setting;

class SettingTransformer extends ParentTransformer{

    public $key = 'settings';

    public function transform(Setting $setting){

        $settingArray = [
            'id' => (int)$setting->id,
            'key' => $setting->key,
            'value'=> $setting->value,
            'other'=> $setting->other,
            'created_at'=> $setting->created_at,
            'updated_at'=> $setting->updated_at,
        ];
        
        if(in_array($setting->key,['app_logo','splash_image'])){
            $settingArray['value'] = $this->baseUrl.'settings/'.$setting->value;
        }

        return $settingArray;
    }

}