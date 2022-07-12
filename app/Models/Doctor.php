<?php

namespace App\Models;

use services;
use App\Models\Hospital;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctors";
    protected   $fillable = [ 'name', 'title', 'hospital_id', 'gender', 'created_at', 'updated_at' ];
    protected $hidden = ['created_at', 'updated_at',];
    public $timestamps = true;

    // one to many
    public function hospital(){

        return $this->belongsTo('App\Models\Hospital', 'hospital_id', 'id');
}

public function services(){
    return $this->belongsToMany('App\Models\Service', 'doctor_service');
}





}
