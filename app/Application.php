<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model {
    
	public function author () {
		return $this->belongsTo('App\User');
	}

	public function estate () {
		return $this->belongsTo('App\Estate');
	}

	public function traces () {
		return $this->hasMany('App\Answer');
	}

	public function picture () {
		return $this->morphOne('App\Picture', 'pictureable');
	}

	public static function boot () {
		parent::boot();

		static::deleting(function (Application $app) {
			$app->answers()->delete();
			if ($app->picture) $app->picture->delete();
		});
	}

}
