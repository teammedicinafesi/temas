<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtema extends Model
{
    public function tema(){
    	return $this->belongsTo(Tema::class);
    }

    public function apuntes(){
    	return $this->morphMany(Apunte::class, 'apunte');
    }

    public function elementos(){
    	return $this->hasMany(Elemento::class);
    }
}
