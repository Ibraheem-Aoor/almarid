<?php namespace App\Transformers;

use App\Models\Offer;

class OfferTransformer extends ParentTransformer{

    public $key = 'offers';

    public function transform(Offer $offer){

        $offerArray = [
            'id' => (int)$offer->id,
            'name' => $offer->name,
            'image'=> $this->baseUrl.'offers/'.$offer->image,
            'created_at'=> $offer->created_at,
            'updated_at'=> $offer->updated_at,
        ];

        return $offerArray;
    }

}