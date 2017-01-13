<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    
	public function fees () {
		return $this->belongsToMany('App\Fee');
	}

	public function maintenance_requests () {
		return $this->hasMany('App\Maintenance');
	}

	public function observations () {
		return $this->hasMany('App\Observation');
	}

	public function payments () {
		return $this->hasMany('App\Payment');
	}

	public function pets () {
		return $this->hasMany('App\Pet');
	}

	public function sections () {
		return $this->hasMany('App\Employee');
	}

	public function vehicles () {
		return $this->hasMany('App\Vehicle');
	}

}
