<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    
	public function estate () {
		return $this->belongsTo('App\Estate');
	}

	public function unit () {
		return $this->belongsToMany('App\Unit');
	}

	public function user () {
		return $this->belongsTo('App\User');
	}

}
