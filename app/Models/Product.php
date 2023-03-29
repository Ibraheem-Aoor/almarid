<?php

namespace App\Models;

class Product extends BaseModel
{

    protected $table = 'products';


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

    public function category(){
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id')->where('type','CAR');
    }
    public function brand(){
        return $this->belongsTo(\App\Models\Brand::class, 'brand_id', 'id');
    }
    public function model(){
        return $this->belongsTo(\App\Models\Model::class, 'model_id', 'id');
    }
    public function offer(){
        return $this->belongsTo(\App\Models\Offer::class, 'offer_id', 'id');
    }
    public function colors(){
        return $this->hasMany(\App\Models\ProductColor::class, 'product_id', 'id');
    }
    public function images(){
        return $this->hasMany(\App\Models\ProductImage::class, 'product_id', 'id');
    }
    public function web_colors(){
        return $this->hasMany(\App\Models\WebProductColor::class, 'product_id', 'id');
    }
    public function options(){
        return $this->hasMany(\App\Models\ProductOption::class, 'product_id', 'id');
    }

}
