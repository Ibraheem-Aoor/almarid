<?php

namespace App\Models;

class ProductOption extends BaseModel
{

    protected $table = 'product_options';


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

    public function optionCategory(){
        return $this->belongsTo(\App\Models\Category::class, 'option_category_id', 'id');
    }

    public function option(){
        return $this->belongsTo(\App\Models\Option::class, 'option_id', 'id');
    }

}
