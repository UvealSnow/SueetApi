<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model {
    
	public function payments () {
		return $this->hasMany('App\Payment');
	}

	public function fee () {
		return $this->hasMany('App\Fee');
	}

	public function unit () {
		return $this->belongsTo('App\Unit');
	}

	public static function boot () {
		parent::boot();

		static::deleting(function (Charge $charge) {
			// 
		});
	}

}
