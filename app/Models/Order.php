<?php

namespace App\Models;

class Order extends BaseModel
{

    protected $table = 'orders';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function product(){
        return $this->belongsTo(\App\Models\Product::class, 'product_id', 'id')->withTrashed();
    }
    public function color(){
        return $this->belongsTo(\App\Models\Color::class, 'color_id', 'id')->withTrashed();
    }
    public function tracking(){
        return $this->belongsTo(\App\Models\TrackingStatus::class, 'status', 'id')->withTrashed();
    }
}
