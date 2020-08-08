<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    public function submodulos(){
    	return $this->belongsToMany(Submodulo::class);
    }

    public function subtemas(){
    	return $this->hasMany(Subtema::class);
    }

    public function bibliografias(){
    	return $this->belongsToMany(Bibliografia::class);
    }

}
