<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleRating extends Model
{
    protected $fillable = [
        'author_name',
        'author_url',
        'language',
        'rating',
        'relative_time_description',
        'text',
        'profile_photo_url',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

}
