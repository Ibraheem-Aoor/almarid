<?php namespace App\Transformers;

use App\Models\Order;

class OrderTransformer extends ParentTransformer{

    public $key = 'orders';

    public function transform(Order $order){

        $orderArray = [
            'id' => (int)$order->id,
            'name' => $order->name,
            'image'=> $order->image,
            'created_at'=> $order->created_at,
            'updated_at'=> $order->updated_at,
        ];

        return $orderArray;
    }

}