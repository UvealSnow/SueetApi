<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model {
    
	public function picture () {
		return $this->morphOne('App\Picture', 'pictureable');
	}	

	public function unit () {
		return $this->belongsTo('App\Unit');
	}

	public static function boot () {
		parent::boot();

		static::deleting(function (Pet $pet) {
			if ($pet->picture) $pet->picture->delete();
		});
	}

}
