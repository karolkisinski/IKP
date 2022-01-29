<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['user_id', 'pet_name', 'service_date', 'service_type']; //service_type_id

    protected $with = ['users'];
    public $timestamps = false;
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
