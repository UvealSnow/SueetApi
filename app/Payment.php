<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

	public function charge () {
		return $this->belongsTo('App\Charge');
	}
    
	public function unit () {
		return $this->belongsTo('App\Unit');
	}

	public function user () {
		return $this->belongsTo('App\User');
	}

	public static function boot () {
		parent::boot();

		static::deleting(function (Payment $payment) {
			// $payment->
		});
	}

}
