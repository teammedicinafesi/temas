<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apunte extends Model
{
	protected $fillable = ['apunte'];

    public function apunte(){
    	return $this->morphTo();
    }
}
