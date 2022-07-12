<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected   $fillable = [
        'price', 'photo', 'created_at', 'updated_at', 'name_ar', 'name_en', 'details_ar','details_en', 'name_de', 'details_de',
    ];

    protected $hidden = [

    ];
}
