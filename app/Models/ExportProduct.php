<?php

namespace App\Models;

class ExportProduct extends BaseModel
{

    protected $table = 'export_products';


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

    public function web_colors(){
        return $this->hasMany(\App\Models\WebExportProductColor::class, 'export_product_id', 'id');
    }
    
    
    public function services(){
        return $this->hasMany(\App\Models\ExportProductService::class, 'export_product_id', 'id');
    }

}
