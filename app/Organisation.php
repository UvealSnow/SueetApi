<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    
	public function employees () {
		return $this->hasMany('App\Employee');
	}

	public function estates () {
		return $this->hasMany('App\Estate');
	}

	public function invitations () {
		return $this->hasMany('App\Invitation');
	}

	public function manager () {
		return $this->belongsTo('App\User', 'manager_id');
	}

	public function roles () {
		return $this->hasMany('App\Role');
	}

}
