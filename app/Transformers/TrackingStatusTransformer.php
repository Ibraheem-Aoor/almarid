<?php namespace App\Transformers;

use App\Models\TrackingStatus;

class TrackingStatusTransformer extends ParentTransformer{

    public $key = 'tracking_status';

    public function transform(TrackingStatus $trackingStatus){

        $trackingStatusArray = [
            'id' => (int)$trackingStatus->id,
            'name' => $trackingStatus->name,
            'name_en' => $trackingStatus->name_en,
            'image'=> $this->baseUrl.'tracking/'.$trackingStatus->image,
            'sort'=> $trackingStatus->sort,
            'created_at'=> $trackingStatus->created_at,
            'updated_at'=> $trackingStatus->updated_at,
        ];

        return $trackingStatusArray;
    }

}