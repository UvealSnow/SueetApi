<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model {

	public function charges () {
		return $this->hasMany('App\Charge');
	}
    
    public function estate () {
    	return $this->belongsTo('App\Estate');
    }

    public function units () {
    	return $this->belongsToMany('App\Unit');
    }

    public static function boot () {
    	parent::boot();

    	static::deleting(function (Fee $fee) {
    		$fee->units()->detach();
    	});
    }

}
