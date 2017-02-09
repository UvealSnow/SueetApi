<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
	
	protected $hidden = ['manager_id', 'updated_at'];
    
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

	public function picture () {
		return $this->morphOne('App\Picture', 'picturable');
	}

	public function roles () {
		return $this->hasMany('App\Role');
	}

	public static function boot () {
		parent::boot();

		static::deleting(function(Organisation $organisation) {
			$organisation->employees()->delete();
			$organisation->estates()->delete();
			$organisation->invitations()->delete();
			$organisation->roles()->delete();
		});
	}

}
