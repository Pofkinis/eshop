<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{

    public function user(){
        $this->belongsTo('App\User');
    }

    public function images(){
      return $this->hasMany('App\Models\Image');
    }
    public function setStatusAttribute($status)
{
    $this->attributes["status"] = (int)$status;
}

}
