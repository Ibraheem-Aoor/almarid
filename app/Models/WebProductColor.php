<?php

namespace App\Models;

class WebProductColor extends BaseModel
{

    protected $table = 'web_product_colors';


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

    public function color(){
        return $this->belongsTo(\App\Models\Color::class, 'color_id', 'id');
    }

    
    public function product(){
        return $this->belongsTo(\App\Models\Product::class, 'product_id', 'id');
    }

    public function images(){
        return $this->hasMany(\App\Models\ProductColorImage::class, 'web_product_color_id', 'id');
    }

}
