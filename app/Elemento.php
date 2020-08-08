<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    public function subtema(){
    	return $this->belongsTo(Subtema::class);
    }

    public function apuntes(){
    	return $this->morphMany(Apunte::class, 'apunte');
    }
}
