<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bibliografia extends Model
{
    public function temas(){
    	return $this->belongToMany(Tema::class);
    }
}
