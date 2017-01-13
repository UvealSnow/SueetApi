<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    
	public function amenities () {
		return $this->hasMany('App\Amenity');
	}

	public function employees () {
		return $this->belongsToMany('App\Employee');
	}

	public function events () {
		return $this->hasMany('App\Event');
	}

	public function fees () {
		return $this->hasMany('App\Fee');
	}

	public function folders () {
		return $this->hasMany('App\Folder');
	}

	public function invitations () {
		return $this->hasMany('App\Invitation');
	}

	public function manager () {
		return $this->belongsTo('App\User', 'manager_id');
	}

	public function maintenance_requests () {
		return $this->hasMany('App\Mainteinance');
	}

	public function organisation () {
		return $this->belongsTo('App\Organisation');
	}

	public function posts () {
		return $this->hasMany('App\Post');
	}

	public function residents () {
		return $this->hasMany('App\Resident');
	}

	public function sections () {
		return $this->hasMany('App\Section');
	}

}
