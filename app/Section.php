<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {
    
    protected $guarded = [];

	public function amenities () {
		return $this->hasMany('App\Amenity');
	}

	public function estate () {
		return $this->belongsTo('App\Estate');
	}

	public function manager () {
		return $this->belongsTo('App\User', 'manager_id');
	}

	public function picture () {
		return $this->morphOne('App\Picture', 'picturable');
	}

	public function units () {
		return $this->hasMany('App\Unit');
	}

	public static function boot () {
		parent::boot();

		static::deleting(function (Section $section) {
			$section->units()->delete();
		});
	}

}
