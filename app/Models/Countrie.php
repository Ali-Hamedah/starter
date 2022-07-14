<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countrie extends Model
{
    protected $table = "countries";
    protected   $fillable = ['name'];
    //protected $hidden = ['created_at', 'updated_at',];
    public $timestamps = false;

    // has one through
    public function doctors()
    {
        return $this->hasManyThrough('App\Models\Doctor', 'App\Models\Hospital', 'countrie_id', 'hospital_id',);
    }

     // has many through
	public function hospitals(){
		return $this->hasMany('App\Models\Hospital','countrie_id','id');
    }

}
