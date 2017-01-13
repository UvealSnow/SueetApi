<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    
	public function estates () {
		return $this->belongsToMany('App\Estate');
	}

	public function organisation () {
		return $this->belongsTo('App\Organisation');
	}

	public function role () {
		return $this->belongsToMany('App\Role');
	}

	public function user () {
		return $this->belongsTo('App\User');
	}

}
