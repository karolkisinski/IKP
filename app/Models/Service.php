<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['pet_id', 'date', 'service_type'];

    protected $with = ['pet'];
    public $timestamps = false;
    public function pet(){
        return $this->belongsTo(Pet::class);
    }

    public function serviceType(){
        return $this->hasOne(ServiceType::class);
    }
}
