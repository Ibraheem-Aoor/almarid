<?php

namespace App\Models;

class Evaluation extends BaseModel
{

    protected $table = 'evaluations';


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

        public function country(){
            return $this->belongsTo(\App\Models\Country::class, 'country_id', 'id');
        }
}
