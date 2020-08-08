<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submodulo extends Model
{
    public function modulo(){
    	return $this->belongsTo(Modulo::class);
    }
    public function temas(){
    	return $this->belongsToMany(Tema::class);
    }
}
