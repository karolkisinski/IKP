<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    protected $fillable = ['user_id', 'name', 'race', 'age'];

    protected $with = ['user'];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
