<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function submodulos(){
    	return $this->hasMany(Submodulo::class);
    }
}
