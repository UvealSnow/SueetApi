<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {
    
	public function picture () {
		return $this->morphOne('App\Picture', 'pictureable');
	}	

	public function unit () {
		return $this->belongsTo('App\Unit');
	}

	public static function boot () {
		parent::boot();

		static::deleting(function (Vehicle $vehicle) {
			if ($vehicle->picture) $vehicle->picture->delete();
		});
	}

}
